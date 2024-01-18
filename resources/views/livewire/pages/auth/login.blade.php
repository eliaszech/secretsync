<?php

use App\Livewire\Forms\LoginForm;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;
}; ?>

<div class="pb-2">
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <nav x-data="{ open: false }" class="bg-transparent relative flex flex-col rounded-tl-lg pl-2 pt-2 mb-16 h-[55px]">
        <div class="pointer-events-none text-3xl font-extrabold text-accent-text hover:drop-shadow-xl transition ease-in-out duration-500ms z-[4]">SECRETSYNC</div>
        <div class="text-accent-text z-[4] font-bold pointer-events-none">LOGIN</div>
        <a href="/" wire:navigate class="cursor-pointer absolute z-[3] w-full left-[-150px] transition ease-in-out duration-500 hover:shadow-xl hover:shadow-primary top-[-215px] h-[300px] bg-gradient-to-r from-primary/80 via-primary to-transparent rotate-[-8deg] border-2 border-primary-accent/80 rounded-lg"></a>
    </nav>

    <div class="mb-4">You are not logged in. Log in now with Discord.</div>

    <x-primary-link href="{{ route('discord.login') }}">{{ _('Loggin with Discord') }}</x-primary-link>
</div>
