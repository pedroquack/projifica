<div x-data="{ isOpen: false }">
    <button @click="isOpen = !isOpen" type="button"
        class="transition-all p-1 md:hover:bg-neutral-100 hover:bg-neutral-300 md:bg-white bg-neutral-200 rounded-full">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
        </svg>

    </button>
    <div x-show="isOpen" @click.away="isOpen = false"
        class="absolute flex flex-col bg-white shadow-lg border border-neutral-100 rounded-lg p-1 z-20"
        x-transition>
        {{ $slot }}
    </div>
</div>
