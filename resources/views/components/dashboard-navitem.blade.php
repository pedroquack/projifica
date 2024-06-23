<li class="w-full">
    <a href="{{ route($route) }}"
        class="flex justify-center cursor-pointer hover:text-neutral-200 items-center p-2 gap-2 @if($route === Route::getCurrentRoute()->getName()) md:border-b-2 border-0 md:bg-neutral-600 bg-neutral-500 border-white @endif">
        {{ $slot }}
    </a>
</li>
