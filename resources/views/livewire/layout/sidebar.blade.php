<?php
use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    public $userName = '';

    public function mount() {
        $this->userName = auth()->user()->name;
    }

    #[\Livewire\Attributes\On('profile-updated')]
    public function updateUser($name) {
        $this->userName = $name;
    }

    public function logout(Logout $logout): void
    {
        $logout();
        $this->redirect('/', true);
    }
}; ?>

<div class="bh-screen flex-col max-w-sm w-full text-white relative overflow-hidden bg-primary/10 rounded-br-lg" @click.away="notificationsOpen = false" x-data="{ notificationsOpen: false }">
    <div class="flex justify-between items-center pt-6 px-6 relative">
        <div class="flex gap-4 flex-row-reverse">
            <a href="javascript:void(0)" class="z-[6]" @click="notificationsOpen = true" x-show="!notificationsOpen"><i class="fal fa-sharp fa-bell text-3xl"></i></a>
            <a href="javascript:void(0)" class="z-[6]" @click="notificationsOpen = false" x-show="notificationsOpen" x-cloak><i class="fal fa-sharp fa-times text-3xl"></i></a>
        </div>
        <div class="flex flex-col relative cursor-pointer z-[5]" @click.away="profileOpen = false" @click="profileOpen = !profileOpen" x-data="{ profileOpen: false }">
            <div class="flex gap-3 items-center">
                <div class="flex flex-col text-right text-accent-text">
                    <div class="text-lg font-bold">{{ $userName }}</div>
                    <div class="text-sm text-accent-text/90">{{ _('premium') }}</div>
                </div>
                <img src="{{ auth()->user()->avatar }}" class="rounded-full border-2 border-primary-accent/80 shadow-md shadow-primary object-center h-14" />
            </div>
            <div class="flex flex-col absolute top-16 right-0 gap-2 text-right bg-transparent z-[5] border-t-2 border-b-2 border-accent-text" x-show="profileOpen" x-collapse x-cloak>
                <a href="javascript:void(0)" wire:click="logout" class="text-accent-text font-semibold hover:text-accent-text/80 py-1">log out</a>
            </div>
        </div>
    </div>
    <div class="flex-col mt-12 relative z-[3] bg-transparent h-full">
        <a href="{{ route('profile') }}" wire:navigate class="text-2xl flex font-extrabold hover:text-primary-text hover:bg-gradient-to-r hover:from-primary/20 hover:to-transparent w-full px-6 py-4">{{ _('Your Account') }}</a>
        <a href="" class="text-2xl flex font-extrabold transition ease-in-out duration-500 hover:text-primary-text hover:bg-gradient-to-r hover:from-primary/20 hover:to-transparent w-full px-6 py-4">{{ _('Your Posts') }}</a>
        <a href="" class="text-2xl flex font-extrabold transition ease-in-out duration-500 hover:text-primary-text hover:bg-gradient-to-r hover:from-primary/20 hover:to-transparent w-full px-6 py-4">{{ _('Your Invites') }}</a>
    </div>
    <div class="absolute z-[3] bg-primary/30 border-primary-accent/10 to-transparent rounded-lg top-[-140px] right-[-170px] h-[500px] w-[320px] rotate-[134deg]"></div>
    <div class="absolute bg-primary/10  z-[3] rounded-lg bottom-[-200px] left-[-50px] h-[500px] w-[320px] rotate-[345deg]"></div>
    <div class="absolute top-0 left-0 z-[5] backdrop-blur-lg w-full h-full bg-primary/40 pt-24 px-6" x-show="notificationsOpen" x-cloak x-transition>
        <div class="text-xl font-extrabold">{{ _('Notifications') }}</div>
        <div class="text-sm">Keine Benachrichtigungen vorhanden...</div>
        <div class="flex flex-col">

        </div>
    </div>
</div>
