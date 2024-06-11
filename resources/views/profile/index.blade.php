@extends('layouts.app')
@section('content')
    <div class="flex flex-col items-center md:my-16 my-8 justify-center md:text-start text-center">
        <div class="md:w-3/4 w-4/5 flex flex-col gap-12">
            <x-profile_header>
                <x-slot:user_name>{{ $user->name }}</x-slot:user_name>
                <x-slot:user_id>{{ $user->id }}</x-slot:user_id>
            </x-profile_header>
            <div class="grid grid-cols-3 gap-5">
                <div class="md:col-span-1 col-span-3 bg-white py-4">
                    <div class="relative w-full h-full flex justify-center items-center">
                        <img src="{{ asset($user->image) }}" alt="" class="w-64 h-64 object-cover rounded-full">
                        @can('user_profile', $user)
                            <div x-data="{ modal: false }" class="absolute w-full h-full flex justify-center items-center">
                                <button type="button" @click="modal = !modal"
                                    class="rounded-full w-64 h-64 absolute bg-neutral-300 bg-opacity-75 flex flex-col items-center justify-center opacity-0 hover:opacity-100 cursor-pointer transition ease-linear">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-12">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
                                    </svg>
                                    Editar imagem
                                </button>
                                <div x-clock x-show="modal"
                                    class="fixed top-0 left-0 z-40 w-full h-full flex items-center justify-center overflow-auto bg-black bg-opacity-50">
                                    <div x-cloak x-show="modal" class="md:w-1/2 w-11/12 bg-white md:p-8 p-4 rounded-lg"
                                        @click.away="modal = false" x-transition:enter="motion-safe:ease-out duration-300"
                                        x-transition:enter-start="opacity-0 scale-90"
                                        x-transition:enter-end="opacity-100 scale-100">
                                        <h1 class="font-bold md:text-2xl text-center text-lg pb-5">Editar foto do perfil</h1>
                                        @livewire('profile-image-update', ['user_id' => Auth::user()->id])
                                    </div>
                                </div>
                            </div>
                        @endcan
                    </div>
                </div>
                <div class="relative md:col-span-2 col-span-3 md:p-12 p-6 bg-white flex flex-col gap-4 justify-between">
                    @can('user_profile', $user)
                        <a href="{{ route('profile.edit', $user->id) }}"
                            class="md:absolute md:top-3 md:right-3 bg-emerald-400 hover:bg-emerald-500 transition-all p-1 drop-shadow-md">
                            Editar Perfil
                        </a>
                    @endcan
                    <div class="flex flex-col gap-4">
                        <h1 class="font-bold text-xl">{{ $user->name }}</h1>
                        <p class="text-base text-wrap break-words">{{ $user->description }}</p>
                    </div>
                    <div class="flex flex-wrap items-center md:justify-between md:flex-row flex-col text-sm md:text-base">
                        <div class="flex gap-3 font-bold items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="size-4 md:size-6">
                                <path fill-rule="evenodd"
                                    d="M1.5 4.5a3 3 0 0 1 3-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 0 1-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 0 0 6.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 0 1 1.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 0 1-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5Z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ $user->phone }}
                        </div>
                        <div class="flex gap-3 font-bold items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="size-4 md:size-6">
                                <path
                                    d="M1.5 8.67v8.58a3 3 0 0 0 3 3h15a3 3 0 0 0 3-3V8.67l-8.928 5.493a3 3 0 0 1-3.144 0L1.5 8.67Z" />
                                <path
                                    d="M22.5 6.908V6.75a3 3 0 0 0-3-3h-15a3 3 0 0 0-3 3v.158l9.714 5.978a1.5 1.5 0 0 0 1.572 0L22.5 6.908Z" />
                            </svg>

                            {{ $user->email }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-3 gap-5">
                <div x-data="{ isOpen: true }" class="md:col-span-1 col-span-3">
                    <button type="button" @click="isOpen = ! isOpen"
                        class="flex justify-between items-center w-full bg-neutral-300 hover:bg-neutral-400 transition-all p-3 font-bold text-xl">
                        Educação
                        <svg aria-hidden="true" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" class="size-4"
                            :class="isOpen ? 'rotate-0' : 'rotate-180'">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>

                    <div x-cloak x-show="isOpen" class="bg-white flex flex-col p-2" x-collapse>
                        <div class="flex flex-col gap-3">
                            @can('user_profile', $user)
                                <x-modal>
                                    <x-slot:button>
                                        Adicionar
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                        </svg>
                                    </x-slot:button>
                                    <h1 class="font-bold md:text-2xl text-lg pb-5">Adicionar educação</h1>
                                    @livewire('education')
                                </x-modal>
                                <hr>
                            @endcan
                            @if ($user->educations->count() == 0)
                                <h1>Nenhuma educação foi adicionada</h1>
                                <hr>
                            @endif
                            @foreach ($user->educations as $e)
                                <div class="flex flex-col gap-1">
                                    <div>
                                        <h1 class="font-bold text-lg">{{ $e->school }}</h1>
                                        <h2 class="font-bold text-base">{{ $e->course }}</h2>
                                    </div>
                                    <div
                                        class="flex  items-center @can('user_profile', $user) justify-between @else md:justify-between justify-center @endcan">
                                        <span class="text-base">{{ $e->start_date }} a {{ $e->end_date }}</span>
                                        @can('user_profile', $user)
                                            <form action="{{ route('education.destroy', $e->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="bg-red-400 hover:bg-red-500 p-1 rounded-full transition-all">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                        stroke-width="1.5" stroke="currentColor" class="size-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                    </svg>

                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                    <hr>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div x-data="{ isOpen: true }" class="md:col-span-2 col-span-3">
                    <button type="button" @click="isOpen = ! isOpen"
                        class="flex justify-between items-center w-full bg-neutral-300 hover:bg-neutral-400 transition-all p-3 font-bold text-xl">
                        Experiência
                        <svg aria-hidden="true" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" class="size-4"
                            :class="isOpen ? 'rotate-0' : 'rotate-180'">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>

                    <div x-cloak x-show="isOpen" class="bg-white flex flex-col p-2" x-collapse>
                        <div class="flex flex-col gap-3">
                            @can('user_profile', $user)
                                <x-modal>
                                    <x-slot:button>
                                        Adicionar
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                        </svg>
                                    </x-slot:button>
                                    <h1 class="font-bold md:text-2xl text-lg pb-5">Adicionar experiência</h1>
                                    @livewire('experience')
                                </x-modal>
                                <hr>
                            @endcan
                            @if ($user->experiences->count() == 0)
                                <h1>Nenhuma experiência foi adicionada</h1>
                                <hr>
                            @endif
                            @foreach ($user->experiences as $e)
                            <div>
                                <div class="flex flex-col gap-1">
                                    <div class="flex md:flex-row flex-col md:justify-between md:items-center">
                                        <h1 class="text-lg font-bold">{{ $e->company }}</h1>
                                        <div
                                            class="flex md:gap-5 gap-3 md:justify-start items-center justify-center relative">
                                            <span>{{ $e->start_date }} a {{ $e->end_date }}</span>
                                            @can('user_profile', $user)
                                                <x-options_dropdown>
                                                    <div x-data="{ modal: false }">
                                                        <button type="button" @click="modal = !modal"
                                                            class="p-2 hover:bg-neutral-200 transition-all w-full text-start">
                                                            Editar
                                                        </button>
                                                        <div x-show="modal"
                                                            class="fixed top-0 left-0 z-40 w-full h-full flex items-center justify-center overflow-auto bg-black bg-opacity-50">
                                                            <div x-show="modal" class="md:w-1/2 w-3/4 bg-white p-8 rounded-lg"
                                                                @click.away="modal = false"
                                                                x-transition:enter="motion-safe:ease-out duration-300"
                                                                x-transition:enter-start="opacity-0 scale-90"
                                                                x-transition:enter-end="opacity-100 scale-100">
                                                                <h1 class="font-bold md:text-2xl text-lg pb-5">Editar
                                                                    experiência</h1>
                                                                @livewire('experience-update', ['e' => $e])
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <form action="{{ route('experience.destroy', $e->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="p-2 hover:bg-neutral-200 transition-all">Remover</a>
                                                    </form>
                                                </x-options_dropdown>
                                            @endcan
                                        </div>
                                    </div>
                                </div>
                                <h2 class="text-base font-semibold">{{ $e->role }}</h2>
                                <p class="text-sm text-wrap break-words">{{ $e->description }}</p>
                                <hr>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
