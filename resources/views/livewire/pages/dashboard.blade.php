<?php

    use Livewire\Attributes\Layout;

    new #[Layout('layouts.app')] class extends \Livewire\Volt\Component {


    }
?>
<div class="w-full px-8 pb-20">
    <div class="flex justify-between items-center mt-8 mb-4">
        <div class="font-extrabold text-3xl text-white">New Posts</div>
        <a href="{{ route('posts') }}" wire:navigate class="text-sm text-primary-text hover:text-white">Alle Posts anzeigen</a>
    </div>
    <livewire:components.post-list :type="'new'"/>
</div>
