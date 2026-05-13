<div class="w-full max-w-4xl bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">

    @isset($title)
        <div class="bg-primary text-white p-6">
            <h1 class="text-xl font-semibold text-center">
                {{ $title }}
            </h1>

            @isset($subtitle)
                <p class="text-sm text-center text-gray-200 mt-1">
                    {{ $subtitle }}
                </p>
            @endisset
        </div>
    @endisset

    <div class="p-6 md:p-8">
        {{ $slot }}
    </div>

</div>