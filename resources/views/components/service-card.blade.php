@props(['icon', 'title', 'desc', 'color'])

<div class="group relative p-8 rounded-[2rem]
            border border-white/40 bg-white/80
            backdrop-blur-sm shadow-md
            transition-all duration-500
            hover:-translate-y-4 hover:scale-[1.03]">

    <div class="absolute inset-0 rounded-[2rem]
                bg-gradient-to-br from-white/40 to-transparent
                opacity-0 group-hover:opacity-100 transition"></div>

    <div class="relative z-10 w-14 h-14 mx-auto mb-6
                flex items-center justify-center rounded-2xl
                {{ $color }} text-white">
        <i class="{{ $icon }}"></i>
    </div>

    <h4 class="relative z-10 text-lg font-bold text-kombu mb-2">
        {{ $title }}
    </h4>

    <p class="relative z-10 text-sm text-gray-500">
        {{ $desc }}
    </p>
</div>