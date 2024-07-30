@extends('layouts.app')
@section('content')
    <x-session_message />
    <div class="flex md:my-16 my-8 justify-center md:text-start text-center">
        <div class="md:w-3/4 w-11/12 flex flex-col gap-6">
            {{ $users->links() }}
            <div class="flex flex-col gap-3">
                @foreach ($users as $u)
                    <a href="{{ route('profile.index', $u->id) }}" class="bg-white hover:bg-neutral-100 flex md:flex-row flex-col items-center p-6 gap-6">
                        <div class="h-48 min-w-48  border-emerald-400 border-2">
                            <img class="h-full w-full object-cover" src="{{ asset($u->image) }}" alt="">
                        </div>
                        <div class="flex flex-col justify-around h-full gap-3">
                            <div class="flex justify-evenly items-center md:justify-between">
                                <h1 class="font-bold text-lg">{{ $u->name }}</h1>
                            </div>
                            <p class="text-wrap break-all">{{ $u->description }}</p>
                            <div class="flex gap-4">
                                <span><strong>{{ $u->posts->count() }}</strong> postagens</span>
                                <span><strong>{{ $u->portfolios->count() }}</strong> itens no portfólio</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            {{ $users->links() }}
        </div>
    </div>
@endsection
