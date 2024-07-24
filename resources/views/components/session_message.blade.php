@if (Session::has('message'))
    <div x-data="{ notify: true }">
        <div x-cloak x-show="notify"
            class="fixed top-0 left-0 flex justify-center items-start w-full h-full bg-black bg-opacity-50 z-50"
            id="notification">
            <div class="bg-white md:w-1/2 w-11/12 rounded-lg p-4 flex justify-between items-center mt-6" @click.away="notify = false" x-show="notify" x-transition>
                {{ Session::get('message') }}
                <button type="button" @click="notify = false" class="text-neutral-600 hover:text-neutral-800">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
@endif
