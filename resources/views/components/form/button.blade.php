@props([
    'variant' => 'filled',
    'size' => 'base'
])

@php
    $class = 'rounded-lg transition-all cursor-pointer p-1 py-1 h-auto ';

    $class .= match ($variant) {
        'filled' => 'bg-zinc-200 hover:bg-zinc-300 dark:bg-zinc-500 hover:dark:bg-zinc-600 text-zinc-900 dark:text-white',
        'outline' => 'bg-transparent hover:bg-zinc-200 hover:dark:bg-zinc-600 border border-zinc-200 dark:border-zinc-600',
        'primary' => 'bg-[var(--color-accent)] hover:bg-[color-mix(in_oklab,_var(--color-accent),_transparent_10%)] text-[var(--color-accent-foreground)]',
    }." ";

    $class .= match ($size) {
        'sm' => 'text-sm px-2',
        'base' => 'text-base px-3',
        'lg' => 'text-lg px-4',
    }." ";
@endphp

<button {{ $attributes->merge(['class' => $class]) }}>{{ $slot }}</button>
