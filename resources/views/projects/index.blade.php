@extends('layouts.app')
@section('content')
    <style>
        #project:hover #project-button {
            display: block
        }
    </style>
    <div class="flex md:flex-row flex-col justify-between items-center bg-neutral-600 py-4 px-6">
        <h1 class="text-white text-2xl font-bold">PROJETOS</h1>
        <div class="flex md:flex-row flex-col items-center md:gap-4 gap-1">
            <span class="text-white">{{ $projects->count() }} encontrados</span>
            @auth
                <a href="{{ route('project.create') }}"
                    class="bg-emerald-400 hover:bg-emerald-500 transition-all py-2 px-6 shadow-md shadow-neutral-700">Criar um
                    projeto</a>
            @endauth
        </div>
    </div>
    {{ $projects->links('pagination::tailwind') }}
    <div class="flex flex-col">
        @foreach ($projects as $p)
            @php
                $today = new DateTime();
                $expiration = new DateTime($p->expiration);
                $diff = $today->diff($expiration);
                $diff = $diff->format('%d');
            @endphp
            <hr>
            <a href="{{ route('project.show',$p->id) }}" id="project"
                class="flex flex-col bg-white hover:bg-neutral-100
             transition-all p-8 gap-3 md:text-start text-center">
                <div class="flex md:flex-row flex-col md:justify-between items-center">
                    <h1 class="font-bold text-xl">{{ $p->title }}</h1>
                    <div
                        class="flex md:flex-col flex-row md:items-end md:justify-normal md:gap-0 gap-4 justify-evenly text-sm">
                        <span><strong>{{ $p->candidates->count() }}</strong> candidatos</span>
                        <span><strong>{{ $diff }}</strong> dias restantes</span>
                    </div>
                </div>
                <div class="break-word break-words line-clamp-3">
                    {!! $p->description !!}
                </div>
                <div class="flex md:flex-row h-full flex-col md:gap-0 gap-4 justify-between items-center">
                    <div class="flex flex-wrap md:justify-start justify-center items-center gap-3 gap-y-1">
                        @foreach ($p->skills as $s)
                            <div class="bg-emerald-400 rounded-xl px-2 w-fit">
                                <span>{{ $s->name }}</span>
                            </div>
                        @endforeach
                    </div>
                    <div class="bg-emerald-400 hidden md:w-fit w-2/3 shadow-sm text-sm p-1 md:px-7 px-0 md:p-0.5 shadow-neutral-600 transition-all"
                        id="project-button">
                        Tenho interesse
                    </div>
                </div>
            </a>
        @endforeach
        {{ $projects->links('pagination::tailwind') }}
    </div>
@endsection
