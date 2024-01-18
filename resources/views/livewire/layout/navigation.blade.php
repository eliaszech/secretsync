<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', true);
    }
}; ?>

<nav x-data="{ open: false }" class="bg-transparent sticky top-6 flex justify-between rounded-tl-lg px-8 mt-4 items-center mb-24 h-[55px] z-[5]">
    <div class="flex flex-col">
        <div class="pointer-events-none text-3xl font-extrabold text-accent-text hover:drop-shadow-xl transition ease-in-out duration-500ms z-[5]">SECRETSYNC</div>
        <div class="z-[5] text-accent-text pointer-events-none">with love <i class="fal fa-sharp fa-heart ml-1"></i></div>
    </div>
    <div class="flex text-white text-lg font-bold">
        <a href="{{ route('shoutbox', ['type' => 'wts']) }}" wire:navigate class="bg-primary/20 rounded-lg border-2 border-primary-accent/20 px-3 py-2 hover:bg-primary/80 hover:text-accent-text hover:shadow-lg hover:shadow-primary hover:transition hover:ease-in-out hover:duration-500">Shoutbox</a>
    </div>
    <a href="/" wire:navigate class="backdrop-blur-sm cursor-pointer absolute z-[4] w-[500px] left-[-180px] transition ease-in-out duration-500 hover:shadow-xl hover:shadow-primary top-[-205px] h-[300px] hover:bg-primary bg-gradient-to-r from-primary via-primary/80 to-transparent rotate-[-8deg] border-2 border-primary-accent/80 rounded-lg"></a>
</nav>
