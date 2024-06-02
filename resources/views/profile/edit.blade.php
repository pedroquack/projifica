@extends('layouts.app')
@section('content')
<div class="flex md:my-16 my-8 justify-center md:text-start text-center">
    <div
        class="bg-white flex flex-col justify-center gap-1 px-8 py-16 md:py-8 mx-4 md:mx-0 md:w-1/2 w-full shadow-xl">
        <h1 class="font-bold text-2xl mb-4 text-center md:text-start">Editar perfil</h1>
        <form action="{{route('profile.update',$user)}}" method="post" class="flex flex-col gap-4" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="flex flex-col">
                <label for="name" class="font-bold">Nome completo</label>
                <input type="text" name="name" id="name" class="rounded-lg @if($errors->has('name')) input-error @endif" value="{{ $user->name }}" placeholder="Ex: Usuário da Silva">
                @if ($errors->has('name'))
                <span class="invalid-feedback">
                    <p>{{ $errors->first('name')}}</p>
                </span>
                @endif
            </div>
            <div class="flex flex-col">
                <label for="description" class="font-bold">Biografia</label>
                <textarea name="description" id="description" class="resize-none rounded-lg @if($errors->has('description')) input-error @endif" rows="5" placeholder="Fale sobre você">{{ $user->description }}</textarea>
                @if ($errors->has('description'))
                <span class="invalid-feedback">
                    <p>{{ $errors->first('description')}}</p>
                </span>
                @endif
            </div>
            <div class="flex flex-col">
                <label for="tel" class="font-bold">Telefone</label>
                <input type="tel" name="phone" id="tel" pattern="\(\d{2}\)\s*\d{5}-\d{4}" class=" text-black rounded-lg
                @if($errors->has('phone')) input-error @endif"
                    placeholder="(00) 00000-0000" value="{{$user->phone}}">
                @if ($errors->has('phone'))
                <span class="invalid-feedback">
                    <p>{{ $errors->first('phone')}}</p>
                </span>
                @endif
            </div>
            <button class="bg-emerald-400 hover:bg-emerald-500 text-black font-bold p-3 col-span-2 rounded-lg shadow"
                type="submit">Atualizar</button>

        </form>
    </div>
</div>

<script>
    const tel = document.getElementById('tel') // Seletor do campo de telefone

    tel.addEventListener('keypress', (e) => mascaraTelefone(e.target.value)) // Dispara quando digitado no campo
    tel.addEventListener('change', (e) => mascaraTelefone(e.target.value)) // Dispara quando autocompletado o campo

const mascaraTelefone = (valor) => {
    valor = valor.replace(/\D/g, "")
    valor = valor.replace(/^(\d{2})(\d)/g, "($1) $2")
    valor = valor.replace(/(\d)(\d{4})$/, "$1-$2")
    tel.value = valor // Insere o(s) valor(es) no campo
    }
</script>
@endsection
