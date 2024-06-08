<nav class="sticky top-0 bg-neutral-700 py-2 md:px-6 px-2">
    <div x-data="{mobileMenuIsOpen: false}" class="flex md:flex-row flex-col items-center justify-between md:gap-8 ">
        <div class="flex justify-between items-center w-full md:gap-10 gap-1">
            <div class="w-48">
                <a href={{route('home')}}><img src="{{asset('images/projifica_logo.png')}}" alt=""></a>
            </div>
            <form action="{{ route('project.search') }}" class="flex w-full">
                <input class="rounded-s-lg border-0 focus:outline-0 w-full text-sm md:text-sm" type="text" name="search_bar"
                    id="" placeholder="Pesquisar Projetos">
                <button class=" bg-emerald-400 rounded-e-lg w-10 flex justify-center items-center hover:bg-emerald-500"
                    type="submit"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </button>
            </form>
            <div class="flex md:hidden ">
                <button @click="mobileMenuIsOpen = !mobileMenuIsOpen" type="button"
                    class="text-emerald-400 hover:text-emerald-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-10">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
            </div>
        </div>
        <!-- Desktop Menu -->
        <div class="w-full">
            <div :class="mobileMenuIsOpen ? 'show' : 'hidden'"
                class="md:flex md:mt-0 mt-2 flex-col md:flex-row md:justify-evenly md:items-center md:gap-12 text-sm gap-4">
                <div x-data="{isOpen: false}" class="relative md:my-0 my-1">
                    <button type="button" @click="isOpen = ! isOpen"
                        class="md:hover:text-neutral-300 inline-flex cursor-pointer items-center gap-2 whitespace-nowrap text-white justify-between w-full md:bg-transparent bg-neutral-500 md:p-0 p-2">
                        Projetos
                        <svg aria-hidden="true" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" class="size-4 rotate-0">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>

                    <div x-cloak x-show="isOpen" x-transition @click.outside="isOpen = false"
                        class="absolute md:top-8 top-10 z-50 left-0 flex w-full min-w-[12rem] flex-col overflow-hidden rounded-lg border border-neutral-100 bg-white shadow-md">
                        <a href="{{route('project.index')}}" class="p-2 hover:bg-neutral-200">Todos os projetos</a>
                        <a href="{{route('project.popular')}}" class="p-2 hover:bg-neutral-200">Mais concorridos</a>
                        <a href="{{route('project.unpopular')}}" class="p-2 hover:bg-neutral-200">Menos concorridos</a>
                        @auth
                            <a href="{{route('user.projects',Auth::user()->id)}}" class="p-2 hover:bg-neutral-200">Meus projetos</a>
                            <a href="{{route('project.joined',Auth::user()->id)}}" class="p-2 hover:bg-neutral-200">Projetos inscritos</a>
                        @endauth
                    </div>
                </div>

                <div x-data="{isOpen: false}" class="relative md:my-0 my-1">
                    <button type="button" @click="isOpen = ! isOpen"
                        class="md:hover:text-neutral-300 inline-flex cursor-pointer items-center gap-2 whitespace-nowrap text-white justify-between w-full md:bg-transparent bg-neutral-500 md:p-0 p-2">
                        Postagens
                        <svg aria-hidden="true" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" class="size-4 rotate-0">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>

                    <div x-cloak x-show="isOpen" x-transition @click.outside="isOpen = false"
                        class="absolute md:top-8 top-10 left-0 flex w-full min-w-[12rem] flex-col overflow-hidden rounded-lg border border-neutral-100 bg-white shadow-md z-20">
                        <a href="{{route('post.index')}}" class="p-2 hover:bg-neutral-200">Mais recentes</a>
                        <a href="{{route('post.oldest')}}" class="p-2 hover:bg-neutral-200">Mais antigos</a>
                        <a href="{{route('post.more.comments')}}" class="p-2 hover:bg-neutral-200">Mais interações</a>
                        <a href="{{route('post.less.comments')}}" class="p-2 hover:bg-neutral-200">Menos interações</a>
                    </div>
                </div>

                <div x-data="{isOpen: false}" class="relative md:my-0 my-1">
                    <button type="button" @click="isOpen = ! isOpen"
                        class="md:hover:text-neutral-300 inline-flex cursor-pointer items-center gap-2 whitespace-nowrap text-white justify-between w-full md:bg-transparent bg-neutral-500 md:p-0 p-2">
                        Usuários
                        <svg aria-hidden="true" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" class="size-4 rotate-0">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>

                    <div x-cloak x-show="isOpen" x-transition @click.outside="isOpen = false"
                        class="absolute md:top-8 top-10 left-0 flex w-full min-w-[12rem] flex-col overflow-hidden rounded-lg border border-neutral-100 bg-white shadow-md z-20">
                        <a href="{{route('home')}}" class="p-2 hover:bg-neutral-200">Mais antigos</a>
                        <a href="{{route('home')}}" class="p-2 hover:bg-neutral-200">Mais recentes</a>
                        <a href="{{route('home')}}" class="p-2 hover:bg-neutral-200">Maior portfólio</a>
                    </div>
                </div>
                @auth
                <div class="flex flex-row items-center gap-2 max-w-full">
                    <img src="{{asset(Auth::user()->image)}}" alt="Foto de {{Auth::user()->name}}"
                        class="h-10 w-10 rounded-full object-cover md:block hidden">
                    <div x-data="{isOpen: false}" class="relative md:my-0 my-1 md:w-fit w-full">
                        <button type="button" @click="isOpen = ! isOpen"
                            class="md:hover:text-neutral-300 inline-flex cursor-pointer items-center gap-2 whitespace-nowrap md:text-white text-neutral-900 font-bold justify-between w-full md:bg-transparent bg-emerald-400 hover:bg-emerald-500 md:hover:bg-transparent md:p-0 p-2">
                            {{explode(' ',Auth::user()->name)[0]}}
                            <svg aria-hidden="true" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" class="size-4 rotate-0">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>

                        <div x-cloak x-show="isOpen" x-transition @click.outside="isOpen = false"
                            class="absolute md:top-8 top-10 right-0 flex w-full min-w-[12rem] flex-col overflow-hidden rounded-lg border border-neutral-100 bg-white shadow-md z-20">
                            <a href="{{route('profile.index',[Auth::user()->name,Auth::user()->id])}}" class="p-2 hover:bg-neutral-200">Meu perfil</a>
                            <form action="{{route('logout')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <button type="submit" class="p-2 w-full hover:bg-neutral-200 text-start">Sair</button>
                            </form>
                        </div>
                    </div>
                </div>
                @else
                <div class="flex md:flex-row flex-col md:gap-8">
                    <x-navbar_item>
                        <x-slot:title>Criar conta</x-slot:title>
                        <x-slot:route>{{route('register')}}</x-slot:route>
                    </x-navbar_item>
                    <x-navbar_item>
                        <x-slot:title>Entrar</x-slot:title>
                        <x-slot:route>{{route('login')}}</x-slot:route>
                    </x-navbar_item>
                </div>
                @endauth
            </div>
        </div>
    </div>
    </div>
</nav>
