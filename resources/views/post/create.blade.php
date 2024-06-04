@extends('layouts.app')
@section('content')
    <div class="flex md:my-16 my-8 justify-center md:text-start text-center">
        <div class="bg-white flex flex-col gap-3 md:w-3/4 w-4/5 p-6">
            <h1 class="font-bold text-xl">Criar postagem</h1>
            <form action="{{ route('post.store') }}" method="post" class="flex flex-col gap-3" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <div class="flex flex-col">
                    <label for="title">Titulo</label>
                    <input type="text" id="title" name="title" placeholder="Titulo da postagem"
                        class="rounded-lg border-neutral-400 @if ($errors->has('title')) input-error @endif" value="{{ old('title') }}">
                    @if ($errors->has('title'))
                        <span class="invalid-feedback">
                            <p>{{ $errors->first('title') }}</p>
                        </span>
                    @endif
                </div>
                <div class="flex flex-col">
                    <label for="body">Descrição</label>
                    <textarea type="text" id="body" name="body"
                        placeholder="Escreva aqui sua postagem" rows="3"
                        class="rounded-lg border-neutral-400 resize-none @if ($errors->has('body')) input-error @endif">{{ old('body') }}</textarea>
                    @if ($errors->has('body'))
                        <span class="invalid-feedback">
                            <p>{{ $errors->first('body') }}</p>
                        </span>
                    @endif
                </div>
                <div class="flex flex-col">
                    <label for="name">Imagem <small>(opcional)</small></label>
                    <x-input_image />
                </div>
                <div class="flex md:flex-row flex-col justify-between items-center">
                    <x-back_button/>
                    <button class="flex items-center justify-center p-1 gap-2 bg-emerald-400 hover:bg-emerald-500 transition-all h-fit rounded-lg md:w-1/4 w-full" type="submit">
                        Criar postagem
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                          </svg>

                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
