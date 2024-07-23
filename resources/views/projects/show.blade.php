@extends('layouts.app')
@section('content')
<x-session_message />
<div class="flex justify-center my-12">
    <div class="bg-white grid grid-cols-4 p-6 md:w-4/5 w-4/5">
        <div class="md:col-span-3 col-span-4 flex flex-col gap-4">
            <div class="md:pr-5 flex flex-col gap-3">
                <div class="flex md:flex-row flex-col justify-between md:items-center items-start">
                    <h1 class="font-bold text-lg">{{ $project->title }}</h1>
                    <div class="flex items-center gap-3">
                        @if ($project->expiration < now()) <div class="bg-neutral-400 px-3 rounded-full">Fechado</div>
                    @else
                    <div class="bg-emerald-400 rounded-full h-fit px-3">
                        Aberto
                    </div>
                    @endif
                    <x-options_dropdown>
                        @can('update', $project)
                        <a class="hover:bg-neutral-200 transition-all p-2"
                            href="{{ route('project.edit', $project->id) }}">Editar</a>
                        <form action="{{ route('project.destroy', $project->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="hover:bg-neutral-200 transition-all p-2">Excluir</button>
                        </form>
                        @else
                            @can('project_already_reported', $project)
                            <x-modal color="bg-white hover:bg-neutral-100">
                                <x-slot:button>
                                    Denunciar
                                </x-slot:button>
                                <div class="text-center">
                                    <h1 class="font-bold text-lg mb-3">Fazer uma denúncia</h1>
                                    <form action="{{ route('report.store','project') }}" method="post"
                                        class="flex flex-col gap-3">
                                        @csrf
                                        <input type="hidden" name="target_id" value="{{ $project->id }}">
                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                        <button type="submit" class="bg-red-400 hover:bg-red-500 p-2">Denunciar</button>
                                    </form>
                                </div>
                            </x-modal>
                            @else
                            <span class="text-red-500">Projeto denunciado por você</span>
                            @endcan
                        @endcan
                    </x-options_dropdown>
                </div>
            </div>
            <div>
                <ul class="list-disc list-inside flex md:flex-row flex-col md:gap-4 gap-0">
                    @if ($project->expiration >= now())
                    <li>Acaba em {{ $diff }} dias</li>
                    @endif
                    <li>Postado {{ $project->created_at->format('d/m/Y') }}</li>
                    <li>{{ $project->candidates->count() }} candidatos</li>
                </ul>
            </div>
        </div>
        <hr>
        <div class="border-b md:border-b-0 md:pb-0 pb-4">
            <h2 class="font-bold">Descrição do projeto</h2>
            <div class="md:w-3/4 w-full break-words">
                {!! $project->description !!}
            </div>
        </div>
    </div>
    <div class="md:col-span-1 col-span-6 md:border-l flex flex-col items-start md:pl-5 md:pt-0 pt-4 gap-4">
        <div>
            <h2 class="font-bold">Sobre o dono do projeto</h2>
            <div class="flex flex-col">
                <h3>{{ explode(' ', $project->user->name)[0] }}</h3>
                <span>{{ $project->user->projects->count() }} projetos postados</span>
                <span>Membro desde {{ $project->user->created_at->format('Y') }}</span>
            </div>
            <a href="{{ route('profile.index', [$project->user->name, $project->user->id]) }}"
                class="flex w-full justify-center bg-emerald-400 hover:bg-emerald-500 transition-all shadow-md shadow-neutral-500 py-1">
                Ver perfil
            </a>
        </div>
        <div>
            <h2 class="font-bold">Sobre o projeto</h2>
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="size-6 text-emerald-400">
                    <path fill-rule="evenodd"
                        d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z"
                        clip-rule="evenodd" />
                </svg>
                <span class="text-sm">{{ $project->slots }} @if ($project->slots > 1)
                    vagas
                    @else
                    vaga
                    @endif
                </span>
            </div>
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="size-6 text-emerald-400">
                    <path fill-rule="evenodd"
                        d="m11.54 22.351.07.04.028.016a.76.76 0 0 0 .723 0l.028-.015.071-.041a16.975 16.975 0 0 0 1.144-.742 19.58 19.58 0 0 0 2.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 0 0-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 0 0 2.682 2.282 16.975 16.975 0 0 0 1.145.742ZM12 13.5a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"
                        clip-rule="evenodd" />
                </svg>
                <span class="text-sm">{{ $project->modality }}
                </span>
            </div>
        </div>
        <div>
            <h2 class="font-bold">
                Habilidades necessárias
            </h2>
            <div class="flex flex-wrap gap-3">
                @foreach ($project->skills as $s)
                <div class="bg-emerald-400 rounded-full px-3 text-sm">
                    {{ $s->name }}
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-span-4 mt-5">
        <hr>
        <div class="flex md:flex-row flex-col justify-between items-center">
            <x-back_button />
            @can('join', $project)
            <x-modal width="md:w-1/4 w-full" border="rounded-lg">
                <x-slot:button>
                    Quero me candidatar
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path
                            d="M5.25 6.375a4.125 4.125 0 1 1 8.25 0 4.125 4.125 0 0 1-8.25 0ZM2.25 19.125a7.125 7.125 0 0 1 14.25 0v.003l-.001.119a.75.75 0 0 1-.363.63 13.067 13.067 0 0 1-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 0 1-.364-.63l-.001-.122ZM18.75 7.5a.75.75 0 0 0-1.5 0v2.25H15a.75.75 0 0 0 0 1.5h2.25v2.25a.75.75 0 0 0 1.5 0v-2.25H21a.75.75 0 0 0 0-1.5h-2.25V7.5Z" />
                    </svg>
                </x-slot:button>
                @livewire('join-project', ['user' => Auth::user(), 'project' => $project])
            </x-modal>
            @elsecan('read_proposals',$project)
            <x-modal width="md:w-1/4 w-full" border="rounded-lg">
                <x-slot:button>
                    Ver candidatos
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path fill-rule="evenodd"
                            d="M8.25 6.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM15.75 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM2.25 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM6.31 15.117A6.745 6.745 0 0 1 12 12a6.745 6.745 0 0 1 6.709 7.498.75.75 0 0 1-.372.568A12.696 12.696 0 0 1 12 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 0 1-.372-.568 6.787 6.787 0 0 1 1.019-4.38Z"
                            clip-rule="evenodd" />
                        <path
                            d="M5.082 14.254a8.287 8.287 0 0 0-1.308 5.135 9.687 9.687 0 0 1-1.764-.44l-.115-.04a.563.563 0 0 1-.373-.487l-.01-.121a3.75 3.75 0 0 1 3.57-4.047ZM20.226 19.389a8.287 8.287 0 0 0-1.308-5.135 3.75 3.75 0 0 1 3.57 4.047l-.01.121a.563.563 0 0 1-.373.486l-.115.04c-.567.2-1.156.349-1.764.441Z" />
                    </svg>
                </x-slot:button>
                @livewire('candidates', ['project' => $project])
            </x-modal>
            @else
            <span class="text-center">Você já se candidatou a esse projeto!</span>
            @endcan
        </div>
    </div>
</div>
</div>
@endsection
