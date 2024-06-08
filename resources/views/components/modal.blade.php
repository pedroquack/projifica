@props(['width' => 'w-full','border' => ''])

<div x-data="{ modal: false }" class="{{ $width }}">
    <button type="button" @click="modal = !modal"
        class="bg-emerald-400 hover:bg-emerald-500 transition-all {{ $border }} px-5 py-1 gap-4 text-base font-base w-full flex justify-center items-center">
        {{ $button }}
    </button>
    <div x-show="modal"
        class="fixed top-0 left-0 z-40 w-full h-full flex items-center justify-center overflow-auto bg-black bg-opacity-50">
        <div x-show="modal" class="md:w-1/2 w-3/4 bg-white p-8 rounded-lg relative"
            @click.away="modal = false" x-transition:enter="motion-safe:ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="motion-safe:ease-out duration-100"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-90">
            <button @click="modal = false" class="absolute right-10 text-neutral-500 hover:text-neutral-800">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                  </svg>
            </button>
            {{ $slot }}
        </div>
    </div>
</div>
