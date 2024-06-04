@extends('layouts.app')
@section('content')
    <x-session_message />
    <div class="flex flex-col md:my-16 my-8 justify-center gap-6 items-center md:text-start text-center">
        <div class="md:w-3/5 w-4/5 flex flex-col gap-3 bg-white p-6">
            @if ($post->image)
                <div class="bg-neutral-400 flex justify-center">
                    <img src="{{ asset($post->image) }}" alt="" class="max-h-96 object-contain">
                </div>
            @endif
            <h1 class="font-bold text-xl">{{ $post->title }}</h1>
            <p class="break-all">{{ $post->body }}</p>
            <div
                class="flex md:flex-row flex-col justify-center md:justify-between md:my-0 my-2 md:gap-0 gap-2 items-center">
                <a href="{{ route('profile.index', [$post->user->name, $post->user->id]) }}"
                    class="md:w-1/4 w-full flex md:justify-start justify-center">
                    <div class="flex items-center gap-3 hover:bg-neutral-100 rounded-full md:w-full">
                        <img class="rounded-full w-12 h-12 object-cover" src="{{ asset($post->user->image) }}"
                            alt="">
                        <span>{{ explode(' ', $post->user->name)[0] }}</span>
                    </div>
                </a>
                <span class="text-neutral-500">
                    Postado {{ $post->created_at->format('d/m/Y') }} ás {{ $post->created_at->format('H:i') }}
                </span>
            </div>
        </div>
        <div class="md:w-3/5 w-4/5 flex flex-col gap-3 bg-white p-6">
            <div>
                @auth
                    @livewire('comment',['post' => $post ,'user_id' => Auth::user()->id])
                @else
                    <h1 class="font-bold text-lg">{{ $post->comments->count() }} comentários</h1>
                    <div class="flex flex-col justify-center items-center gap-1 bg-neutral-100 p-3">
                        <span class="font-bold">Você precisa estar conectado para comentar e ler comentários</span>
                        <a href="{{ route("login") }}" class="bg-emerald-400 hover:bg-emerald-500 px-5 py-1 shadow-sm shadow-neutral-500 transition-all">Entrar</a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
@endsection
