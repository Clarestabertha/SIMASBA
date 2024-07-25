@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-2 py-0.5 mx-2 my-1 h-10 rounded-full text-lg font-medium leading-5 text-white bg-primary focus:outline-none transition duration-150 ease-in-out'
            : 'inline-flex items-center px-2 py-0.5 mx-2 my-1 h-10 rounded-full text-lg font-medium leading-5 text-black dark:text-black hover:bg-primary hover:text-white focus:outline-none transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
