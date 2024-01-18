<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use App\Events\MessageReceived;

new #[Layout('layouts.app')] class extends \Livewire\Volt\Component {
    public $type;

    #[\Livewire\Attributes\Validate('required|string')]
    public $message = '';

    public function mount($type)
    {
        $this->type = $type;

        \Carbon\Carbon::setLocale(config('app.locale'));
    }

    public function with(): array
    {
        $messages = \App\Models\Data\Message::where('type', $this->type)->orderBy('created_at', 'DESC')->limit(20)->get();

        return compact('messages');
    }

    public function sendMessage()
    {
        $executed = \Illuminate\Support\Facades\RateLimiter::attempt('send-message:' . auth()->user()->id, 3, function () {
            auth()->user()->messages()->create([
                'message' => $this->message,
                'type' => $this->type
            ]);

            $this->message = '';
        });

        if (!$executed) {
            $seconds = \Illuminate\Support\Facades\RateLimiter::availableIn('send-message:' . auth()->user()->id);

            $this->addError('send-message', "Zu viele Nachrichten in einer kurzen Zeit, bitte warte $seconds Sekunden!");
        } else {
            broadcast(new MessageReceived($this->type));
        }
    }

    public function deleteMessage(string $messageId) {
        $this->authorize('delete', \App\Models\Data\Message::class);

        $m = \App\Models\Data\Message::find($messageId);

        if(!$m->deleted) {
            $m->update(['deleted' => true]);
        } else {
            $m->delete();
        }
    }

    public function getListeners(): array {
        return [
            "echo-presence:chat.$this->type,MessageReceived" => '$refresh'
        ];
    }
}

?>

<div class="w-full px-8 pb-20">
    <div class="text-white text-3xl font-extrabold mb-6">Shoutbox</div>
    <form wire:submit="sendMessage" class="rounded-lg text-white flex flex-col shadow">
        <div class="flex text-xl divide-x-2 divide-background">
            <a href="{{ route('shoutbox', ['type' => 'wts']) }}" wire:navigate
               class="rounded-tl-lg bg-primary/20 px-4 py-3 font-extrabold @if($type == 'wts') bg-primary/50 @endif">WTS</a>
            <a href="{{ route('shoutbox', ['type' => 'wtb']) }}" wire:navigate
               class="bg-primary/20 px-4 py-3 font-semibold @if($type == 'wtb') bg-primary/50 @endif">WTB</a>
            <a href="{{ route('shoutbox', ['type' => 'wtt']) }}" wire:navigate
               class="rounded-tr-lg bg-primary/20 px-4 py-3 font-semibold @if($type == 'wtt') bg-primary/50 @endif">WTT</a>
        </div>
        <div class="rounded-tr-lg rounded-bl-lg rounded-br-lg bg-background border-2 border-primary/50">
            <div
                class="flex flex-col px-4 py-4 max-h-[400px] scrollbar-thin scrollbar-thumb-primary/20 overflow-y-auto flex-col-reverse gap-0.5">
                @forelse($messages as $message)
                    <div class="flex gap-2">
                        <div class="text-primary-text font-semibold text-sm">{{ $message->user->name }}:</div>
                        <div class="flex text-sm items-start text-gray-200">
                            <span class="text-gray-400 text-sm shrink-0 mr-2">
                                (@if($message->updated_at != $message->created_at) <i class="fal fa-sharp fa-pen"></i> @endif {{ \Carbon\Carbon::make($message->created_at)->diffForHumans() }})
                            </span>
                            <p>
                                @if(!$message->deleted)
                                    @if($message->censored)
                                        <span class="bg-primary/20 rounded-md px-1 text-transparent hover:text-gray-200">{{ $message->message }}</span>
                                    @else
                                        <span>{{ $message->message }}</span>
                                    @endif
                                @else
                                    <div class="italic text-primary-text font-light">{{ _('Nachricht wurde von einem Administrator gelöscht...') }}</div>
                                @endif
                                @can('delete', \App\Models\Data\Message::class)
                                    <a href="javascript:void(0)" wire:click="deleteMessage('{{ $message->id }}')" class="ml-2 text-primary-text">
                                        @if($message->deleted)
                                            <i class="fal fa-sharp fa-trash"></i>
                                        @else
                                            <i class="fal fa-sharp fa-ban"></i>
                                        @endif
                                    </a>
                                @endcan
                            </p>
                        </div>
                    </div>
                @empty
                    <span class="text-sm text-gray-200">Hier ist es ganz leer, schreib die erste Nachricht :)</span>
                @endforelse
            </div>
            @error('send-message')
            <div class="bg-primary/50 text-xs px-4 py-1 text-accent-text">{{ $message }}</div>
            @enderror
            <div class="border-t-2 border-primary/50 flex" x-data="{ message: @entangle('message') }">
                <input type="text" x-model="message"
                       class="w-full rounded-bl-lg bg-background border-none focus:bg-primary/10 focus:ring-0"
                       placeholder="type your message in {{ $type }}"/>
                <button type="submit" class="px-3 py-2 bg-primary/20 rounded-br-lg text-sm font-semibold text-gray-200"
                        x-show="message != ''">senden
                </button>
            </div>
        </div>
    </form>
</div>
