@props([
    'checked' => false,
    'element' => 0,
    'disabled' => false,
])

<div>
    <input type="checkbox" {{ $attributes->merge(['id' => "checkbox-{$element}", 'class' => 'hidden peer']) }}
        {{ $checked === false ? '' : 'checked' }} {{ $disabled ? 'disabled' : '' }}>
    <label
        {{ $attributes->merge(['for' => "checkbox-{$element}", 'class' => 'cursor-pointer inline-block w-5 h-5 border-2 border-zinc-300 rounded-md peer-checked:bg-zinc-200 peer-checked:border-zinc-200 peer-checked:ring-2 peer-checked:ring-zinc-200 dark:peer-checked:bg-zinc-500 dark:peer-checked:border-zinc-500 dark:peer-checked:ring-2 dark:peer-checked:ring-zinc-500 transition-all duration-200']) }}></label>
</div>
