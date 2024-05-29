@extends('layouts.app')
@section('content')
    <div class="flex md:my-16 my-8 justify-center md:text-start text-center">
        <div class="md:w-3/4 w-4/5 flex flex-col gap-12">
            <div class="grid grid-cols-3 bg-white text-center w-full text-black md:text-xl text-sm">
                <a href="{{ route('profile.index', [$user->name, $user->id]) }}"
                    class="hover:bg-neutral-300 md:col-span-1 p-4 @if (Route::getCurrentRoute()->getName() == 'profile.index') font-bold bg-neutral-300 @endif">
                    Perfil
                </a>
                <a href=""
                    class="hover:bg-neutral-300 md:col-span-1 p-4 @if (Route::getCurrentRoute()->getName() == 'portfolio.index') font-bold bg-neutral-300 @endif">
                    Portfólio
                </a>
                <a href=""
                    class="hover:bg-neutral-300 md:col-span-1 p-4 @if (Route::getCurrentRoute()->getName() == 'user.posts.index') font-bold bg-neutral-300 @endif">
                    Postagens
                </a>
            </div>
            <div class="grid grid-cols-3 gap-5">
                <div class="md:col-span-1 col-span-3 bg-white py-4">
                    <div class="relative w-full h-full flex justify-center items-center">
                        <img src="{{ asset($user->image) }}" alt="" class="w-64 max-h-64 object-cover rounded-full">
                        <div class="rounded-full w-64 h-64 absolute bg-neutral-300 bg-opacity-75 flex flex-col items-center justify-center opacity-0 hover:opacity-100 cursor-pointer transition ease-linear">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-12">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
                              </svg>
                            Editar imagem
                        </div>
                    </div>
                </div>
                <div class="md:col-span-2 col-span-3 p-12 bg-white flex flex-col gap-4 justify-between">
                    <div class="flex flex-col gap-4">
                        <h1 class="font-bold text-2xl">{{ $user->name }}</h1>
                        <p>{{ $user->description }}</p>
                    </div>
                    <div class="flex flex-wrap items-center md:justify-between md:flex-row flex-col text-sm md:text-lg">
                        <div class="flex gap-3 font-bold items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4 md:size-6">
                                <path fill-rule="evenodd" d="M1.5 4.5a3 3 0 0 1 3-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 0 1-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 0 0 6.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 0 1 1.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 0 1-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5Z" clip-rule="evenodd" />
                            </svg>
                            {{ $user->phone }}
                        </div>
                        <div class="flex gap-3 font-bold items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4 md:size-6">
                                <path d="M1.5 8.67v8.58a3 3 0 0 0 3 3h15a3 3 0 0 0 3-3V8.67l-8.928 5.493a3 3 0 0 1-3.144 0L1.5 8.67Z" />
                                <path d="M22.5 6.908V6.75a3 3 0 0 0-3-3h-15a3 3 0 0 0-3 3v.158l9.714 5.978a1.5 1.5 0 0 0 1.572 0L22.5 6.908Z" />
                              </svg>

                            {{ $user->email }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-3">
                <div x-data="{isOpen: true}" class="md:col-span-1 col-span-3">
                    <button type="button" @click="isOpen = ! isOpen"
                        class="flex justify-between items-center w-full bg-neutral-300 p-4 font-bold text-2xl">
                        Educação
                        <svg aria-hidden="true" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" class="size-4 rotate-0">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>

                    <div x-cloak x-show="isOpen" x-transition
                        class="bg-white flex flex-col p-3">
                        <div class="flex flex-col gap-3">
                            <div>
                                <h1 class="font-bold text-xl">Universidade Federal do Paraná</h1>
                                <h2 class="font-bold text-lg">Técnico em Informática</h2>
                            </div>
                            <span class="text-xl">2009 a 2013</span>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
