@extends('layouts.app')
@section('content')
<style>
    ul {
        list-style: inherit;
        list-style-position: inside;
    }
</style>
<div class="flex flex-col md:my-16 my-8 justify-center gap-6 items-center md:text-start text-center">
    <div class="md:w-3/5 w-4/5 flex flex-col gap-3 bg-white p-6">
        @if ($post->image)
        <div class="w-full max-h-96 overflow-hidden bg-cover" style="background-image: url({{ asset($post->image) }})">
            <img src="{{ asset($post->image) }}" alt="" class="max-h-96 w-full object-contain">
        </div>
        @endif
        <div class="flex justify-between">
            <h1 class="font-bold text-xl">{{ $post->title }}</h1>
            @auth
            <x-options_dropdown>
                @can('user_post',$post)
                <a class="hover:bg-neutral-200 transition-all p-2" href="{{ route('post.edit', $post->id) }}">Editar</a>
                <form action="{{ route('post.destroy', $post->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="hover:bg-neutral-200 transition-all p-2">Excluir</button>
                </form>
                @else
                    @can('post_already_reported', $post)
                        <x-modal color="bg-white hover:bg-neutral-100">
                            <x-slot:button>
                                Denunciar
                            </x-slot:button>
                            <div class="text-center">
                                <h1 class="font-bold text-lg mb-3">Fazer uma denúncia</h1>
                                <form action="{{ route('report.store','post') }}" method="post" class="flex flex-col gap-3">
                                    @csrf
                                    <input type="hidden" name="target_id" value="{{ $post->id }}">
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <button type="submit" class="bg-red-400 hover:bg-red-500 p-2">Denunciar</button>
                                </form>
                            </div>
                        </x-modal>
                    @else
                        <span class="text-red-500">Postagem denunciada por você</span>
                    @endcan
                @endcan
            </x-options_dropdown>
            @endauth
        </div>
        <div class="break-word break-words">{!! $post->body !!}</div>
        <div
            class="flex md:flex-row flex-col justify-center md:justify-between md:my-0 my-2 md:gap-0 gap-2 items-center">
            <a href="{{ route('profile.index', [$post->user->name, $post->user->id]) }}"
                class="md:w-1/4 w-full flex md:justify-start justify-center">
                <div class="flex items-center gap-3 hover:bg-neutral-100 rounded-full md:w-full">
                    <img class="rounded-full w-12 h-12 object-cover" src="{{ asset($post->user->image) }}" alt="">
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
            @livewire('comment', ['post' => $post, 'user_id' => Auth::user()->id])
            @else
            <h1 class="font-bold text-lg">{{ $post->comments->count() }} comentários</h1>
            <div class="flex flex-col justify-center items-center gap-1 bg-neutral-100 p-3">
                <span class="font-bold">Você precisa estar conectado para comentar</span>
                <a href="{{ route('login') }}"
                    class="bg-emerald-400 hover:bg-emerald-500 px-5 py-1 shadow-sm shadow-neutral-500 transition-all">Entrar</a>
            </div>
            @endauth
        </div>
        <div class="mt-4">
            @if ($post->comments->count() > 0)
            <hr>
            <div class="flex flex-col">
                @foreach ($post->comments->sortByDesc('created_at') as $c)
                <div class="flex flex-col gap-3 p-2">
                    <div class="flex md:flex-row flex-col justify-between items-center">
                        <a href="{{ route('profile.index', [$c->user->name, $c->user->id]) }}"
                            class="md:w-1/4 w-full flex md:justify-start justify-center">
                            <div class="flex items-center gap-3 hover:bg-neutral-100 rounded-full md:w-full">
                                <img class="rounded-full w-8 h-8 object-cover" src="{{ asset($c->user->image) }}"
                                    alt="">
                                <span>{{ explode(' ', $c->user->name)[0] }}</span>
                            </div>
                        </a>
                        <div class="flex items-center gap-2">
                            <small class="text-neutral-500">
                                Postado {{ $c->created_at->format('d/m/Y') }} ás
                                {{ $c->created_at->format('H:i') }}
                            </small>
                            @auth
                            <x-options_dropdown>
                                @can('user_comment',$c)
                                <form action="{{ route('comment.destroy', $c->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="hover:bg-neutral-200 transition-all p-2">Excluir</button>
                                </form>
                                @else
                                    @can('comment_already_reported', $c)
                                        <x-modal color="bg-white hover:bg-neutral-100">
                                            <x-slot:button>
                                                Denunciar
                                            </x-slot:button>
                                            <div class="text-center">
                                                <h1 class="font-bold text-lg mb-3">Fazer uma denúncia</h1>
                                                <form action="{{ route('report.store','comment') }}" method="post"
                                                    class="flex flex-col gap-3">
                                                    @csrf
                                                    <input type="hidden" name="target_id" value="{{ $c->id }}">
                                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                                    <button type="submit"
                                                        class="bg-red-400 hover:bg-red-500 p-2">Denunciar</button>
                                                </form>
                                            </div>
                                        </x-modal>
                                    @else
                                        <span class="text-red-500">Comentário denunciado por você</span>
                                    @endcan
                                @endcan
                            </x-options_dropdown>
                            @endauth
                        </div>
                    </div>
                    <p class="text-sm break-word break-words">{{ $c->body }}</p>
                    <hr>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
