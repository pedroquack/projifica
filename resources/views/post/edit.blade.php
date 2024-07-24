@extends('layouts.app')
@section('content')
    <div class="flex md:my-16 my-8 justify-center md:text-start text-center">
        <div class="bg-white flex flex-col gap-3 md:w-3/4 w-11/12 p-6">
            <h1 class="font-bold text-xl">Editar postagem</h1>
            <form action="{{ route('post.update',$post->id) }}" method="post" class="flex flex-col gap-3" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="flex flex-col">
                    <label for="title">Titulo</label>
                    <input type="text" id="title" name="title" placeholder="Titulo da postagem"
                        class="rounded-lg border-neutral-400 @if ($errors->has('title')) input-error @endif"
                        value="{{ $post->title }}">
                    @if ($errors->has('title'))
                        <span class="invalid-feedback">
                            <p>{{ $errors->first('title') }}</p>
                        </span>
                    @endif
                </div>
                <div class="flex flex-col">
                    <label for="body">Descrição</label>
                    <textarea type="text" id="body" name="body" placeholder="Escreva aqui sua postagem"
                        class="rounded-lg border-neutral-400 resize-none @if ($errors->has('body')) input-error @endif">{{ $post->body }}</textarea>
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
                    <x-back_button />
                    <button
                        class="flex items-center justify-center p-1 gap-2 bg-emerald-400 hover:bg-emerald-500 transition-all h-fit rounded-lg md:w-1/4 w-full"
                        type="submit">
                        Editar postagem
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        ClassicEditor
            .create(document.querySelector('#body'), {
                toolbar: ['bold', 'link', 'bulletedList'],
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
