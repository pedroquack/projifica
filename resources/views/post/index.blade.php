@extends('layouts.app')
@section('content')
    <div class="flex md:my-16 my-8 justify-center md:text-start text-center">
        <div class="md:w-2/4 w-11/12 flex flex-col gap-6">
            @foreach ($posts as $p)
            <a href="{{ route('post.show',$p->id) }}">
                <div class="bg-white md:p-6 px-3 py-8 flex flex-col gap-4 hover:bg-neutral-100">
                    <div class="w-full max-h-64 overflow-hidden bg-cover" style="background-image: url({{ asset($p->image) }})">
                        <img src="{{ asset($p->image) }}" alt="" class="max-h-64 w-full object-contain">
                    </div>
                    <div class="flex md:flex-row flex-col justify-between items-center text-wrap break-all">
                        <h1 class="text-lg font-bold">{{ $p->title }}</h1>
                        <small class="text-neutral-500">Postado em {{ $p->created_at->format('d/m/Y')}} ás {{ $p->created_at->format('H:i')}}</small>
                    </div>
                    <div class="break-all overflow-ellipsis line-clamp-3">
                        {!! $p->body !!}
                    </div>
                    <div class="flex md:flex-row flex-col justify-end">
                        <span class="underline font-bold">{{ $p->comments->count() }} comentários</span>
                    </div>
                </div>
            </a>
            @endforeach
            {{ $posts->links() }}
        </div>
    </div>
@endsection
