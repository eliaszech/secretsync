@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'rounded-md shadow bg-primary/20 border-2 text-white focus:shadow-md focus:shadow-primary-accent focus:border-primary-accent focus:ring-0 border-primary-accent/20']) !!}>
