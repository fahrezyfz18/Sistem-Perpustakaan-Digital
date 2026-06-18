@props(['type' => 'submit'])

<button type="{{ $type }}"
    class="w-full bg-secondary text-white py-3 rounded-lg hover:bg-camel transition font-semibold">

    {{ $slot }}

</button>