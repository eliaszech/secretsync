<?php
    new class extends \Livewire\Volt\Component {
        public $currentTheme = '';

        public function switchTheme($theme) {
            $this->dispatch('switched-theme', $theme);
        }
    }
?>

<div class="flex flex-col justify-end fixed right-6 bottom-8 z-10 items-end border-2 rounded-lg border-primary-accent shadow-lg shadow-primary-accent" @click.away="collapsed = false" x-data="{ collapsed: false }">
    <div class="bg-accent rounded-lg" x-show="collapsed" x-collapse x-cloak
        :class="collapsed ? 'rounded-br-none' : ''">
        <div class="flex flex-col divide-y-2 divide-primary-accent border-b-2 border-primary-accent">
            <a href="javascript:void(0);" class="flex items-center rounded-t-md justify-center bg-theme-default hover:bg-theme-default/80 h-14 w-14 text-white" wire:click="switchTheme('')"><i class="fal fa-sharp fa-droplet text-xl"></i></a>
            <a href="javascript:void(0);" class="flex items-center justify-center bg-theme-orange hover:bg-theme-orange/80 h-14 w-14 text-white" wire:click="switchTheme('orange')"><i class="fal fa-sharp fa-droplet text-xl"></i></a>
            <a href="javascript:void(0);" class="flex items-center justify-center bg-theme-pink hover:bg-theme-pink h-14 w-14 text-white" wire:click="switchTheme('pink')"><i class="fal fa-sharp fa-droplet text-xl"></i></a>
            <a href="javascript:void(0);" class="flex items-center justify-center bg-theme-blue hover:bg-theme-blue/80 h-14 w-14 text-white" wire:click="switchTheme('blue')"><i class="fal fa-sharp fa-droplet text-xl"></i></a>
            <a href="javascript:void(0);" class="flex items-center justify-center bg-theme-teal hover:bg-theme-teal/80 h-14 w-14 text-white" wire:click="switchTheme('teal')"><i class="fal fa-sharp fa-droplet text-xl"></i></a>
            <a href="javascript:void(0);" class="flex items-center justify-center bg-theme-green hover:bg-theme-green/80 h-14 w-14 text-white" wire:click="switchTheme('green')"><i class="fal fa-sharp fa-droplet text-xl"></i></a>
            <a href="javascript:void(0);" class="flex items-center justify-center bg-theme-gray hover:bg-theme-gray/80 h-14 w-14 text-white" wire:click="switchTheme('gray')"><i class="fal fa-sharp fa-droplet text-xl"></i></a>
            <a href="javascript:void(0);" class="flex items-center justify-center bg-theme-white hover:bg-theme-white/80 h-14 w-14 text-black" wire:click="switchTheme('white')"><i class="fal fa-sharp fa-droplet text-xl"></i></a>
        </div>
     </div>
    <div @click="collapsed = !collapsed" class="flex rounded-md items-center justify-center w-14 h-14 bg-primary text-accent-text cursor-pointer"
        :class="collapsed ? 'rounded-t-none' : ''">
        <i class="fal fa-sharp fa-palette text-2xl" x-show="!collapsed"></i>
        <i class="fal fa-sharp fa-times text-2xl" x-show="collapsed" x-cloak></i>
    </div>

</div>
