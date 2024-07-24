@extends('layouts.app')
@section('content')
    <div class="flex md:my-16 my-8 justify-center md:text-start text-center">
        <div class="bg-white flex flex-col gap-3 md:w-3/4 w-11/12 p-6">
            <h1 class="font-bold text-xl">Editar projeto</h1>
            <form action="{{ route('project.update',$project->id) }}" method="post" class="flex flex-col gap-3"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <div class="flex flex-col">
                    <label for="title">Titulo</label>
                    <input type="text" id="title" name="title"
                        placeholder="Ex: Um sistema para meu projeto de mecânica"
                        class="rounded-lg border-neutral-400 @if ($errors->has('title')) input-error @endif"
                        value="{{ $project->title }}">
                    @if ($errors->has('title'))
                        <span class="invalid-feedback">
                            <p>{{ $errors->first('title') }}</p>
                        </span>
                    @endif
                </div>
                <div class="flex flex-col">
                    <label for="description">Descrição</label>
                    <textarea type="text" id="description" name="description"
                        placeholder="Escreva aqui a descrição do seu projeto, para facilitar o entendimento dos desenvolvedores e conseguir mais candidatos"
                        rows="3"
                        class="rounded-lg border-neutral-400 resize-none @if ($errors->has('description')) input-error @endif">{{ $project->description }}</textarea>
                    @if ($errors->has('description'))
                        <span class="invalid-feedback">
                            <p>{{ $errors->first('description') }}</p>
                        </span>
                    @endif
                </div>
                <div class="flex flex-col">
                    <label>Quais habilidades serão necessárias <small>(Limite de 5 habilidades)</small></label>
                    <div class="text-sm">
                        <select multiple name="skills[]" id="skills">
                            @foreach ($skills as $s)
                                <option value="{{ $s->id }}" @if (in_array($s->id, $selectedSkills)) selected @endif>{{ $s->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if ($errors->has('skills'))
                        <span class="invalid-feedback">
                            <p>{{ $errors->first('skills') }}</p>
                        </span>
                    @endif
                </div>
                <div class="grid grid-cols-4 md:gap-6 gap-4">
                    <div class="flex flex-col md:col-span-1 col-span-4">
                        <label for="modality">Modalidade</label>
                        <select name="modality" id=""
                            class="rounded-lg border-neutral-400 @if ($errors->has('modality')) input-error @endif">
                            <option value="Presencial" @if($project->modality === "Presencial") selected @endif>Presencial</option>
                            <option value="Remoto" @if($project->modality === "Remoto") selected @endif>Remoto</option>
                            <option value="Híbrido" @if($project->modality === "Híbrido") selected @endif>Híbrido</option>
                        </select>
                        @if ($errors->has('modality'))
                            <span class="invalid-feedback">
                                <p>{{ $errors->first('modality') }}</p>
                            </span>
                        @endif
                    </div>
                    <div class="flex flex-col md:col-span-2 col-span-4">
                        <label for="expiration">Aberto para inscrições até:</label>
                        <input type="date" id="expiration" name="expiration"
                            class="rounded-lg border-neutral-400 @if ($errors->has('expiration')) input-error @endif"
                            value="{{ $project->expiration->format('Y-m-d') }}">
                        @if ($errors->has('expiration'))
                            <span class="invalid-feedback">
                                <p>{{ $errors->first('expiration') }}</p>
                            </span>
                        @endif
                    </div>
                    <div class="flex flex-col md:col-span-1 col-span-4">
                        <label for="slots">Vagas</label>
                        <input type="number" id="slots" name="slots" min="1" placeholder="1" max="100"
                            class="rounded-lg border-neutral-400 @if ($errors->has('slots')) input-error @endif"
                            value="{{ $project->slots }}">
                        @if ($errors->has('slots'))
                            <span class="invalid-feedback">
                                <p>{{ $errors->first('slots') }}</p>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="flex md:flex-row flex-col justify-between items-center">
                    <x-back_button />
                    <button
                        class="flex items-center justify-center p-1 gap-2 bg-emerald-400 hover:bg-emerald-500 transition-all h-fit rounded-lg md:w-1/4 w-full"
                        type="submit">
                        Atualizar
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        ClassicEditor
            .create(document.querySelector('#description'), {
                toolbar: ['bold', 'link', 'bulletedList'],
            })
            .catch(error => {
                console.error(error);
            });

        $('#skills').select2({
            multiple: true,
            maximumSelectionLength: 5,
            width: '100%'
        });
    </script>
@endsection
