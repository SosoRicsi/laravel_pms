@props([
    'type' => '',
])
@php
    $color = match ($type) {
        'error' => 'bg-red-500',
        'success' => 'bg-zinc-400 dark:bg-zinc-600',
        default => 'bg-orange-500',
    };
@endphp
<div>
    @if (isset($slot) && !empty($slot) && $slot != "")
        <div {{ $attributes->merge(['class' => "{$color} text-white text-center text-lg max-w-md mx-auto p-2 m-2 rounded-2xl font-bold"]) }}>
            <p>{{ $slot }}</p>
        </div>
    @endif
</div>
