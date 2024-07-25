<a {{ $attributes->merge([
    'class' => 'block w-full px-4 py-2 bg-secondary text-start text-sm leading-5 text-white hover:bg-primary focus:outline-none focus:bg-primary transition duration-150 ease-in-out'
]) }}>
    {{ $slot }}
</a>
