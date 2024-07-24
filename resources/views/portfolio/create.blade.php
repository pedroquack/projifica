@extends('layouts.app')
@section('content')
    <div class="flex md:my-16 my-8 justify-center md:text-start text-center">
        <div class="bg-white flex flex-col gap-3 md:w-3/4 w-11/12 p-6">
            <h1 class="font-bold text-xl">Adicionar item ao portfólio</h1>
            <form action="{{ route('portfolio.store') }}" method="post" class="flex flex-col gap-3" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <div class="flex flex-col">
                    <label for="name">Titulo</label>
                    <input type="text" id="name" name="name" placeholder="Ex: Meu primeiro projeto pessoal"
                        class="rounded-lg border-neutral-400 @if ($errors->has('name')) input-error @endif" value="{{ old('name') }}">
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
                        class="rounded-lg border-neutral-400 resize-none @if ($errors->has('description')) input-error @endif">{{ old('description') }}</textarea>
                    @if ($errors->has('description'))
                        <span class="invalid-feedback">
                            <p>{{ $errors->first('description') }}</p>
                        </span>
                    @endif
                </div>
                <div class="flex flex-col">
                    <label>Quais habilidades foram necessárias <small>(Limite de 10 habilidades)</small></label>
                    <div class="text-sm">
                        <select multiple name="skills[]" id="skills">
                            @foreach ($skills as $s)
                                <option value="{{ $s->id }}">{{ $s->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if ($errors->has('skills'))
                        <span class="invalid-feedback">
                            <p>{{ $errors->first('skills') }}</p>
                        </span>
                    @endif
                </div>
                <div class="flex flex-col">
                    <label for="name">Imagem demonstrativa</label>
                    <x-input_image />
                </div>
                <div class="flex flex-col">
                    <label for="url">Link do Projeto <small>(opcional)</small></label>
                    <input type="text" id="url" name="url" placeholder="Ex: http://www.meuprojeto.com.br"
                        class="rounded-lg border-neutral-400 @if ($errors->has('url')) input-error @endif" value="{{ old('url') }}">
                    @if ($errors->has('url'))
                        <span class="invalid-feedback">
                            <p>{{ $errors->first('url') }}</p>
                        </span>
                    @endif
                </div>
                <div class="flex md:flex-row flex-col justify-between items-center">
                    <x-back_button/>
                    <button class="flex items-center justify-center p-1 gap-2 bg-emerald-400 hover:bg-emerald-500 transition-all h-fit rounded-lg md:w-1/4 w-full" type="submit">
                        Adicionar
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
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
            width:'100%'
        });
    </script>
@endsection
