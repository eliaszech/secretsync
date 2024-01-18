<?php

use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Livewire\Attributes\Validate;
use App\Providers\RouteServiceProvider;
use App\Models\User;

new #[Layout('layouts.guest')] class extends Component
{
    public string $invite;

    public function validateInvite() {
        $validated = $this->validate([
            'invite' => ['required', 'string', 'max:255'],
        ]);

        $invite = \App\Models\Invite::where('code', $this->invite)->first();

        if($invite == null || !$invite->valid) {
            $this->addError('invite', 'This invite code is not valid.');
            return false;
        }

        if($invite->used) {
            $this->addError('invite', 'This invite code has already been used.');
            return false;
        }

        \Illuminate\Support\Facades\Auth::user()->update([
            'invite' => $invite->id
        ]);

        $invite->update([
            'used' => true,
        ]);

        $this->redirect(RouteServiceProvider::HOME, navigate: true);
    }
}; ?>

<div class="flex flex-col">
    <span>{{ _('You have no access to this forum, enter a invite code to join.') }}</span>
    <form wire:submit="validateInvite" class="flex flex-col gap-2 mt-4">
        <input type="text" wire:model="invite" class="bg-background rounded-md border-none focus:ring-0"  placeholder="Invite code"/>
        <x-input-error :messages="$errors->get('invite')" class="mb-2" />
        <x-primary-button>{{ _('Validate') }}</x-primary-button>
    </form>
</div>
