@extends('layouts.app')
@section('content')
    <div class="flex md:my-16 my-8 justify-center md:text-start text-center">
        <div class="md:w-3/4 w-11/12 flex flex-col gap-6">
            <x-profile_header>
                <x-slot:user_name>{{ $user->name }}</x-slot:user_name>
                <x-slot:user_id>{{ $user->id }}</x-slot:user_id>
            </x-profile_header>
            <div class="md:relative bg-white flex flex-col justify-center items-center py-4">
                <h1 class="font-bold text-xl">POSTAGENS DE {{ strtoupper(explode(' ', $user->name)[0]) }}</h1>
                <span>{{ $user->posts->count() }} postagens encontradas</span>
                @can('user_profile', $user)
                    <a href="{{ route('post.create') }}"
                        class="md:absolute fixed bg-emerald-400 hover:bg-emerald-500 transition-all md:right-10 right-4 md:bottom-auto bottom-10 md:p-1 p-2 rounded-full md:shadow-none shadow-sm shadow-neutral-800">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </a>
                @endcan
            </div>
            @foreach ($user->posts->sortDesc() as $p)
            <a href="{{ route('post.show',$p->id) }}">
                <div class="bg-white md:p-6 px-3 py-8 flex flex-col gap-4 hover:bg-neutral-100 max-h-64">
                    <div class="flex md:flex-row flex-col justify-between items-center text-wrap break-all">
                        <h1 class="text-lg font-bold">{{ $p->title }}</h1>
                        <small class="text-neutral-500">Postado em {{ $p->created_at->format('d/m/Y')}} ás {{ $p->created_at->format('H:i')}}</small>
                    </div>
                    <div class="break-all overflow-ellipsis line-clamp-3">
                        {!! $p->body !!}
                    </div>
                    <div class="flex md:flex-row flex-col @if($p->image) md:justify-between @else justify-end @endif">
                        @if ($p->image)
                            <span class="font-bold">Contém imagem</span>
                        @endif
                        <span class="underline font-bold">{{ $p->comments->count() }} comentários</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
@endsection
