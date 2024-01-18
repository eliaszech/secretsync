<?php
    new class extends \Livewire\Volt\Component {
        public $type = '';

        public function with() : array {
            $posts = collect([]);

            switch ($this->type) {
                case 'all':
                    $posts = \App\Models\Data\Post::all();
                    break;
                case 'new':
                    $posts = \App\Models\Data\Post::orderBy('created_at', 'DESC')->limit(10)->get();
                    break;
            }

            return compact('posts');
        }
    }
?>

<div class="flex flex-col divide-y-2 divide-primary/20">
    <a href="{{ route('post.create') }}" wire:navigate class="relative overflow-hidden bg-primary/10 rounded-t-lg w-full text-white hover:bg-primary/20 hover:shadow-md hover:shadow-primary-accent/20 transition ease-in-out duration-300">
        <div class="flex relative items-center gap-4 z-[3] px-4 py-3 font-bold"><i class="fal fa-sharp fa-plus"></i> Neuen Post erstellen</div>
    </a>
    @forelse($posts as $post)
        <a href="{{ route('post.view', ['post' => $post->id]) }}" wire:navigate class="relative overflow-hidden bg-primary/10 @if($loop->last) rounded-b-lg @endif w-full text-white hover:bg-primary/20 hover:shadow-md hover:shadow-primary-accent/20 transition ease-in-out duration-300">
            <div class="flex relative items-center gap-4 z-[3]">
                <div class="text-xl text-white font-extrabold uppercase bg-primary/10 px-4 py-4 w-[80px]">{{ $post->category }}</div>
                <div class="flex justify-between items-center w-full pr-4">
                    <div class="flex flex-col">
                        <div class="font-semibold">{{ $post->title }}</div>
                        <div class="text-xs">posted by <span class="text-primary-text">{{ $post->user->name }}</span></div>
                    </div>
                    <div class="text-sm text-gray-300 text-end">{{ $post->created_at->format('d.m.Y H:i') }}</div>
                </div>
            </div>
        </a>
    @empty
        <div class="text-white text-sm">Keine Posts vorhanden</div>
    @endforelse
</div>
