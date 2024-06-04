@extends('layouts.app')
@section('content')
    <style>
        .select2-container--default .select2-selection--multiple {
            height: auto;
            overflow-y: auto;
        }
    </style>
    <div class="flex md:my-16 my-8 justify-center md:text-start text-center">
        <div class="bg-white flex flex-col gap-3 md:w-3/4 w-4/5 p-6">
            <h1 class="font-bold text-xl">Adicionar item ao portfólio</h1>
            <form action="{{ route('portfolio.update', $portfolio->id) }}" method="post" class="flex flex-col gap-3"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <div class="flex flex-col">
                    <label for="name">Titulo</label>
                    <input type="text" id="name" name="name" placeholder="Ex: Meu primeiro projeto pessoal"
                        class="rounded-lg border-neutral-400 @if ($errors->has('name')) input-error @endif"
                        value="{{ $portfolio->name }}">
                    @if ($errors->has('name'))
                        <span class="invalid-feedback">
                            <p>{{ $errors->first('name') }}</p>
                        </span>
                    @endif
                </div>
                <div class="flex flex-col">
                    <label for="description">Descrição</label>
                    <textarea type="text" id="description" name="description"
                        placeholder="Escreva aqui sobre seu projeto, qual papel você teve, como foi desenvolvido e etc..." rows="3"
                        class="rounded-lg border-neutral-400 resize-none @if ($errors->has('description')) input-error @endif">{{ $portfolio->description }}</textarea>
                    @if ($errors->has('description'))
                        <span class="invalid-feedback">
                            <p>{{ $errors->first('description') }}</p>
                        </span>
                    @endif
                </div>
                <div class="flex flex-col">
                    <label>Quais habilidades foram necessárias <small>(Limite de 10 habilidades)</small></label>
                    <div class="text-sm w-full">
                        <select multiple name="skills[]" id="skills">
                            @foreach ($skills as $s)
                                <option value="{{ $s->id }}" @if (in_array($s->id, $selectedSkills)) selected @endif>
                                    {{ $s->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if ($errors->has('skills'))
                        <span class="invalid-feedback">
                            <p>{{ $errors->first('skills') }}</p>
                        </span>
                    @endif
                </div>
                <div class="flex md:flex-row flex-col-reverse items-center justify-between w-full md:gap-0 gap-5">
                    <div class="flex flex-col md:w-4/5 w-full">
                        <label for="name">Imagem demonstrativa</label>
                        <x-input_image />
                    </div>
                    <div class="flex flex-col md:items-end items-center md:w-1/5 w-full">
                        <label>Imagem atual</label>
                        <img class="h-24 w-24 object-cover" src="{{ asset($portfolio->image) }}" alt="">
                    </div>
                </div>
                <div class="flex flex-col">
                    <label for="url">Link do Projeto <small>(opcional)</small></label>
                    <input type="text" id="url" name="url" placeholder="Ex: http://www.meuprojeto.com.br"
                        class="rounded-lg border-neutral-400 @if ($errors->has('url')) input-error @endif"
                        @if ($portfolio->url) value="{{ $portfolio->url }}" @else value="{{ old('url') }}" @endif>
                    @if ($errors->has('url'))
                        <span class="invalid-feedback">
                            <p>{{ $errors->first('url') }}</p>
                        </span>
                    @endif
                </div>
                <div class="flex md:flex-row flex-col justify-between items-center">
                    <x-back_button />
                    <button
                        class="flex items-center  justify-center gap-2 h-fit bg-emerald-400 hover:bg-emerald-500 transition-all p-1 rounded-lg md:w-1/4 w-full"
                        type="submit">
                        Atualizar
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
        $('#skills').select2({
            multiple: true,
            maximumSelectionLength: 10,
            width: '100%',
        });
    </script>
@endsection
