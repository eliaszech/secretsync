<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;

new #[Layout('layouts.app')] class extends \Livewire\Volt\Component {

    #[Validate('required|string')]
    public $description;

    #[Validate('required|string|max:100')]
    public $title;

    #[Validate('required')]
    public $channel = 'wts';

    public function createPost() {
        $this->validate();

        $post = auth()->user()->posts()->create([
           'title' => $this->title,
           'description' => $this->description
        ]);

        $this->redirect(route('post.view', ['post' => $post->id]), navigate: true);
    }
}

?>

@section('assets')
    <script src="https://cdn.tiny.cloud/1/h6uktvbmku9vx92hi54xzfljo7gcp11mvyoab0vfjwdi0u5m/tinymce/6/tinymce.min.js" data-navigate-track referrerpolicy="origin"></script>
@endsection

<div class="px-8 pb-20">
    <form wire:submit="createPost" wire:ignore>
        <div class="text-white text-2xl font-bold mb-6">Neuen Post erstellen</div>
        <div class="flex mb-4">
            <a href="" class="bg-primary/20 rounded-md text-white px-4 py-2 text-2xl font-extrabold shadow">WTS</a>
        </div>
        <x-text-input wire:model="title" class="w-full mb-4" placeholder="Titel eingeben"/>
        <textarea id="tinymce" wire:model="description"></textarea>
        <x-primary-button class="mt-4">Posten</x-primary-button>
    </form>
</div>

@script
    <script data-navigate-track>
        tinymce.remove('#tinymce')
        tinymce.init({
            selector: 'textarea#tinymce', // Replace this CSS selector to match the placeholder element for TinyMCE
            plugins: 'table lists',
            language: 'de',
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | table',
            content_style: "body { color: white }",
            setup: function (editor) {
                editor.on('init change', function () {
                    editor.save();
                });
                editor.on('change', function (e) {
                    @this.set('description', editor.getContent());
                });
            }
        });
    </script>
@endscript




