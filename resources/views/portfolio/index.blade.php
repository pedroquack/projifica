@extends('layouts.app')
@section('content')
    <x-session_message />
    <div class="flex md:my-16 my-8 justify-center md:text-start text-center">
        <div class="md:w-3/4 w-11/12 flex flex-col gap-6">
            <x-profile_header>
                <x-slot:user_name>{{ $user->name }}</x-slot:user_name>
                <x-slot:user_id>{{ $user->id }}</x-slot:user_id>
            </x-profile_header>
            <div class="md:relative bg-white flex flex-col justify-center items-center py-4">
                <h1 class="font-bold text-xl">PORTFÓLIO DE {{ strtoupper(explode(' ', $user->name)[0]) }}</h1>
                <span>{{ $user->portfolios->count() }} itens encontrados</span>
                @can('user_profile', $user)
                    <a href="{{ route('portfolio.create') }}"
                        class="md:absolute fixed bg-emerald-400 hover:bg-emerald-500 transition-all md:right-10 right-4 md:bottom-auto bottom-10 md:p-1 p-2 rounded-full md:shadow-none shadow-sm shadow-neutral-800">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </a>
                @endcan
            </div>
            <div class="flex flex-col gap-3">
                @foreach ($user->portfolios as $p)
                    <div class="bg-white flex md:flex-row flex-col items-center p-6 gap-6">
                        <div class="h-48 min-w-48 max-w-48  border-emerald-400 border-2">
                            <img class="h-full w-full object-cover" src="{{ asset($p->image) }}" alt="">
                        </div>
                        <div class="flex flex-col justify-around h-full gap-3">
                            <div class="flex justify-evenly items-center md:justify-between">
                                <h1 class="font-bold text-lg">{{ $p->name }}</h1>
                                @can('user_profile', $user)
                                    <x-options_dropdown>
                                        <a class="hover:bg-neutral-200 transition-all p-2"
                                            href="{{ route('portfolio.edit', $p->id) }}">Editar</a>
                                        <form action="{{ route('portfolio.destroy', $p->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="hover:bg-neutral-200 transition-all p-2">Excluir</button>
                                        </form>
                                    </x-options_dropdown>
                                @endcan
                            </div>
                            <p class=" text-wrap break-all">{{ $p->description }}</p>
                            @if ($p->url != null)
                                <a href="{{ $p->url }}" class="underline text-blue-600" target="_blank">Link para o
                                    projeto</a>
                            @endif
                            <div class="flex flex-wrap md:justify-start justify-center items-center gap-3 gap-y-1">
                                @foreach ($p->skills as $s)
                                    <div class="bg-emerald-400 rounded-xl px-2 w-fit">
                                        <span>{{ $s->name }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>


        </div>
    </div>
@endsection
