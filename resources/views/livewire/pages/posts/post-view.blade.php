<?php
use Livewire\Attributes\Layout;
use App\Models\Data\Post;
use Faker\Factory;

new #[Layout('layouts.app')] class extends \Livewire\Volt\Component {
    public Post $post;

    public function mount(Post $post) {
        $this->post = $post;
        $this->post->likes = $this->post->likes();
    }

    public function with() : array {
        $hasLiked = auth()->user()->liked->contains($this->post->id);

        return compact('hasLiked');
    }

    public function delete() {
        $this->authorize('delete', Post::class);

        $this->post->delete();
        $this->redirect('/', navigate: true);
    }

    public function like() {
        $this->post->likes()->toggle(auth()->user()->id);
    }
}
?>
<div class="px-8 pb-20">
    <div class="rounded-lg relative bg-primary/10 shadow overflow-hidden" x-data="{ commentsOpen: false }">
        <div class="flex flex-col">
            <div class="text-white flex flex-col rounded-t-lg font-extrabold px-8 pt-3 pb-3 relative overflow-hidden bg-primary/5 shadow">
                <div class="flex items-center gap-10 z-[3]">
                    <div class="text-xl font-extrabold uppercase text-white">{{ $post->category }}</div>
                    <div class="flex justify-between items-center w-full">
                        <div class="flex flex-col text-lg">
                            {{ $post->title }}
                            <div class="text-sm font-normal text-gray-300">{{ $post->created_at->format('d.m.Y H:i') }}</div>
                        </div>
                        <div class="flex items-center gap-4 flex-shrink-0">
                            <div class="flex flex-col items-end">
                                <a href="javascript:void(0)" class="text-lg font-semibold h-6">{{ $post->user->name }}</a>
                                <div class="text-xs text-gray-300 font-normal">0 karma</div>
                            </div>
                            <img src="{{ $post->user->avatar }}" class="h-14 w-14 rounded-full border-2 border-primary-accent/80 shadow-md shadow-primary" />
                        </div>
                    </div>
                </div>
                <div class="absolute left-[-185px] top-[-150px] w-[300px] h-[300px] bg-primary/20 rotate-12 z-[2] pointer-events-none"></div>
                <div class="absolute right-[-160px] top-[-90px] w-[350px] h-[300px] bg-primary/20 rotate-[45deg] z-[2] pointer-events-none"></div>
            </div>
            <div class="px-8 pt-6 pb-6 text-white leading-6 tracking-wide [word-spacing:2px] text-sm z-[4]">
                {!! $post->description !!} <!-- output the lorem ipsum  text here -->
            </div>
        </div>
        <div class="px-8 py-1.5 flex justify-between relative bg-primary/10 text-white z-[4] items-center">
            <div class="flex gap-4">
                @if($hasLiked)
                    <a href="javascript:void(0)" wire:click="like" class="text-lg font-bold text-primary-text">{{ $post->likes->count() }} <i class="fas fa-sharp fa-thumbs-up"></i></a>
                @else
                    <a href="javascript:void(0)" wire:click="like" class="text-lg font-bold hover:text-primary-text">{{ $post->likes->count() }} <i class="fal fa-sharp fa-thumbs-up"></i></a>
                @endif
                <a href="javascript:void(0)" @click="commentsOpen = !commentsOpen" :class="commentsOpen ? 'text-primary-text' : ''" class="text-lg font-bold hover:text-primary-text">0 <i class="fas fa-sharp fa-comment"></i></a>
                <a href="javascript:void(0)" class="text-lg font-bold hover:text-primary-text">0 <i class="far fa-sharp fa-share"></i></a>
            </div>
            @can('delete', Post::class)
                <a href="javascript:void(0)" wire:click="delete" class="hover:text-primary-text"><i class="far fa-sharp fa-trash"></i></a>
            @endcan
        </div>
        <div class="px-8 py-4 text-white" x-show="commentsOpen" x-collapse>
            keine Kommentare
        </div>
    </div>
</div>
