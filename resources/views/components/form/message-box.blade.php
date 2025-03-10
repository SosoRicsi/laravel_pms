@props([
    'type' => 'error',
    'message',
])
@php
    $color = match ($type) {
        'error' => 'bg-red-500',
        'success' => 'bg-zinc-600',
        default => 'bg-orange-600',
    };
@endphp
<div>
    @if (isset($message) && !empty($message))
        <div {{ $attributes->merge(['class' => "{$color} text-white text-center text-lg max-w-md mx-auto p-2 m-2 rounded-2xl font-bold"]) }}>
            <p>{{ $message }}</p>
        </div>
    @endif
</div>
