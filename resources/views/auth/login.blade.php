@extends('layouts.app')
@section('content')
<div class="flex md:my-16 my-8 justify-center">
        <div
            class="bg-neutral-700 col-span-2 md:col-span-1 flex flex-col justify-center gap-4 px-8 shadow-sm text-white py-16 mx-4 md:mx-0 w-96">
            <div>
                <small class="font-thin">Ainda não tem uma conta?</small>
                <a href="{{route('register')}}"
                    class="text-emerald-400 hover:text-emerald-500 font-bold underline">Criar uma conta</a>
            </div>
            <h1 class="font-bold text-xl">Bem-vindo ao <span class="text-emerald-400">PROJIFICA</span></h1>
            <h2 class="font-bold text-base">Que bom te ter de volta</h2>
            <form action="{{route('login')}}" method="post" class="flex flex-col gap-3">
                @csrf
                <x-input :class="''" :id="'email'" :label="'E-Mail'" :type="'email'" :name="'email'" :placeholder="'exemplo@gmail.com'"/>
                <x-input :class="''" :id="'password'" :label="'Senha'" :type="'password'" :name="'password'" :placeholder="'***********'"/>
                <button type="submit"
                    class="bg-emerald-400 p-3 w-full text-center text-neutral-800 font-bold hover:bg-emerald-600 transition ease-linear rounded-xl">
                    Entrar
                </button>
            </form>
        </div>
</div>
@endsection
