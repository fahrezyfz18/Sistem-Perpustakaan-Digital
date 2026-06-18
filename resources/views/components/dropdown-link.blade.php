@props(['active' => false])

<a {{ $attributes->merge([
    'class' => $active
        ? 'block w-full px-4 py-2 text-sm text-camel bg-olivine/10'
        : 'block w-full px-4 py-2 text-sm text-kombu hover:text-mustard hover:bg-olivine/10'
]) }}>
    {{ $slot }}
</a>