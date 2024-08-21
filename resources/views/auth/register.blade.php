@extends('layouts.app')
@section('content')
<div class="flex md:my-16 my-8 justify-center md:text-start text-center">
    <div
        class="bg-neutral-700 flex flex-col justify-center gap-1 md:px-8 px-2 text-white py-16 md:py-8 md:mx-0 md:w-1/2 w-11/12 shadow-xl">
        <div class="mb-5">
            <div>
                <small class="font-thin">Já possui uma conta?</small>
                <a href="{{route('login')}}"
                    class="text-emerald-400 hover:text-emerald-500 font-bold underline">Entrar</a>
            </div>
            <h1 class="font-bold text-xl">Bem-vindo ao <span class="text-emerald-400">PROJIFICA</span></h1>
        </div>
        <form action="{{route('register')}}" method="post" id="register-form" class="grid grid-cols-2 gap-4" enctype="multipart/form-data">
            @csrf
            <x-input :class="'col-span-2 md:col-span-1'" :id="'name'" :label="'Nome Completo'" :type="'text'"
                :name="'name'" :placeholder="'Digite aqui seu nome completo'" />
            <x-input :class="'col-span-2 md:col-span-1'" :id="'email'" :label="'E-Mail'" :type="'email'" :name="'email'"
                :placeholder="'exemplo@gmail.com'" />
            <x-textarea :class="'col-span-2'" :label="'Biografia'" :name="'description'" :id="'description'"
                :placeholder="'Fale sobre você'" />
            <div class="flex flex-col md:col-span-1 col-span-2">
                <label for="tel" class="font-bold">Telefone</label>
                <input type="tel" name="phone" id="tel" pattern="\(\d{2}\)\s*\d{5}-\d{4}" class=" text-black rounded-lg
                @if($errors->has('phone')) input-error @endif" placeholder="(00) 00000-0000" value="{{old('phone')}}">
                @if ($errors->has('phone'))
                <span class="invalid-feedback">
                    <p>{{ $errors->first('phone')}}</p>
                </span>
                @endif
            </div>
            <x-input :class="'col-span-2 md:col-span-1'" :id="'password'" :label="'Senha'" :type="'password'"
                :name="'password'" :placeholder="'***********'" />
            <x-input_image />
            <button class="bg-emerald-400 hover:bg-emerald-500 text-black font-bold p-3 col-span-2 rounded-lg shadow"
                type="submit">Criar uma conta</button>

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
