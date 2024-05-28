@extends('layouts.app')
@section('content')
<div class="flex md:my-16 my-8 justify-center">
    <div class="grid grid-cols-2">
        <div
            class="bg-neutral-700 col-span-2 md:col-span-1 flex flex-col justify-center gap-4 px-8 text-white py-16 md:py-0 mx-4 md:mx-0 w-96">
            <h1 class="font-bold text-2xl">Bem-vindo ao <span class="text-emerald-400">PROJIFICA</span></h1>
            <p class=" font-normal">Aqui suas melhores ideias ganham vida. Conecte-se com voluntários ou candidate-se
                para colaborar em projetos inovadores. Juntos, vamos alavancar seu portfólio e transformar sonhos em
                realidade.</p>
            <h2 class="font-bold text-base">Venha fazer parte dessa comunidade!</h2>
            <div class="flex flex-col items-center gap-3">
                <a href="{{route('register')}}"
                    class="bg-emerald-400 p-4 w-full text-center text-neutral-800 font-bold hover:bg-emerald-600 transition ease-linear rounded-xl">
                    Criar uma conta
                </a>
                <span class="font-thin">ou</span>
                <a href="{{route('login')}}"
                    class="bg-emerald-400 p-4 w-full text-center text-neutral-800 font-bold hover:bg-emerald-600 transition ease-linear rounded-xl">
                    Entrar
                </a>
            </div>
        </div>
        <div class="hidden md:block bg-neutral-400 md:col-span-1 w-96">
            <img src="{{asset('images/home_image.png')}}" alt="">
        </div>
    </div>
</div>
@endsection