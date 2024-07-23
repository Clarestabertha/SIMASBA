@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-bold text-sm text-black dark:text-black']) }}>
    {{ $value ?? $slot }}
</label>
