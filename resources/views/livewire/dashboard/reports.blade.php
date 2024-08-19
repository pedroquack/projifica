<div>
    <table class="border-separate border w-full overflow-hidden">
        <thead>
            <tr>
                <th class="border">Id</th>
                <th class="border">Denunciado por</th>
                <th class="border">Motivo</th>
                <th class="border">Tipo da denúncia</th>
                <th class="border w-fit">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reports as $r)
            <tr>
                <td class="border">{{ $r->id }}</td>
                <td class="border">{{ $r->user->name }}</td>
                <td class="border">
                    <x-modal>
                        <x-slot:button>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
                              </svg>
                        </x-slot:button>
                        <div>
                            <h2 class="font-bold">Motivo da denúncia:</h2>
                            <p class="text-sm break-word break-words">{{ $r->reason }}</p>
                        </div>
                    </x-modal>
                </td>
                @switch($r->target_type)
                @case('App\Models\Post')
                <td class="border">Postagem </td>
                <td class="border flex gap-1 w-full justify-center">
                    @if ($r->target)
                    <a href="{{ route('post.show',$r->target->id) }}"
                        class="bg-emerald-400 hover:bg-emerald-500 transition-all py-1 px-3 w-full text-center">Ver
                        postagem</a>
                    <x-modal width="w-full" color="bg-red-400 hover:bg-red-500">
                        <x-slot:button>
                            Excluir postagem
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                            </svg>
                        </x-slot:button>
                        <div class="flex flex-col gap-4">
                            <div>
                                <h1 class="font-bold text-xl">Tem certeza que deseja excluir esta postagem?</h1>
                                <h2>Essa ação é irreversivel</h2>
                            </div>
                            <form action="{{ route('admin.post.destroy',$r->target->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-400 hover:bg-red-500 transition-all p-2 w-full text-center">Sim, quero
                                    excluir
                                    esta postagem</button>
                            </form>
                        </div>
                    </x-modal>
                    @else
                    <span class="text-center text-red-500">Postagem excluída!</span>
                    @endif
                </td>
                @break
                @case('App\Models\Project')
                <td class="border">Projeto </td>
                <td class="border flex gap-1 w-full justify-center">
                    @if ($r->target)
                    <a href="{{ route('project.show',$r->target->id) }}"
                        class="bg-emerald-400 hover:bg-emerald-500 transition-all py-1 px-3 w-full text-center">Ver
                        projeto</a>
                    <x-modal width="w-full" color="bg-red-400 hover:bg-red-500">
                        <x-slot:button>
                            Excluir projeto
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                            </svg>
                        </x-slot:button>
                        <div class="flex flex-col gap-4">
                            <div>
                                <h1 class="font-bold text-xl">Tem certeza que deseja excluir esse projeto?</h1>
                                <h2>Essa ação é irreversivel</h2>
                            </div>
                            <form action="{{ route('admin.project.destroy',$r->target->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-400 hover:bg-red-500 transition-all p-2 w-full text-center">Sim, quero
                                    excluir
                                    esse projeto!</button>
                            </form>
                        </div>
                    </x-modal>
                    @else
                    <span class="text-center text-red-500">Projeto excluído!</span>
                    @endif
                </td>
                @break
                @case('App\Models\User')
                <td class="border">Usuário </td>
                <td class="border flex gap-1 w-full justify-center">
                    @if ($r->target)
                    <a href="{{ route('profile.index',$r->target->id) }}"
                        class="bg-emerald-400 hover:bg-emerald-500 transition-all py-1 px-3 w-full text-center">Ver
                        perfil</a>
                    <x-modal width="w-full" color="bg-red-400 hover:bg-red-500">
                        <x-slot:button>
                            Banir usuário
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                            </svg>
                        </x-slot:button>
                        <div class="flex flex-col gap-4">
                            <div>
                                <h1 class="font-bold text-xl">Tem certeza que deseja banir esse usuário?</h1>
                                <h2>Essa ação é irreversivel</h2>
                            </div>
                            <form action="{{ route('admin.user.destroy',$r->target->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-400 hover:bg-red-500 transition-all p-2 w-full text-center">Sim, quero
                                    banir
                                    esse usuário</button>
                            </form>
                        </div>
                    </x-modal>
                    @else
                    <span class="text-center text-red-500">Usuário excluído!</span>
                    @endif
                </td>
                @break
                @case('App\Models\Comment')
                <td class="border">Comentário </td>
                <td class="border flex gap-1 w-full justify-center">
                    @if ($r->target)
                    <x-modal>
                        <x-slot:button>Ver comentário</x-slot:button>
                        <div class="flex flex-col gap-3 p-2">
                            <div class="flex md:flex-row flex-col justify-between items-center">
                                <a href="{{ route('profile.index', [$r->target->user->name, $r->target->user->id]) }}"
                                    class="md:w-1/4 w-full flex md:justify-start justify-center">
                                    <div class="flex items-center gap-3 hover:bg-neutral-100 rounded-full md:w-full">
                                        <img class="rounded-full w-8 h-8 object-cover"
                                            src="{{ asset($r->target->user->image) }}" alt="">
                                        <span>{{ explode(' ', $r->target->user->name)[0] }}</span>
                                    </div>
                                </a>
                            </div>
                            <p class="text-sm break-word break-words">{{ $r->target->body }}</p>
                            <hr>
                        </div>
                    </x-modal>
                    <x-modal width="w-full" color="bg-red-400 hover:bg-red-500">
                        <x-slot:button>
                            Excluir comentário
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                            </svg>
                        </x-slot:button>
                        <div class="flex flex-col gap-4">
                            <div>
                                <h1 class="font-bold text-xl">Tem certeza que deseja excluir esse comentário?</h1>
                                <h2>Essa ação é irreversivel</h2>
                            </div>
                            <form action="{{ route('admin.comment.destroy',$r->target->id) }}">
                                @csrf
                                @method('DELETE ')
                                <button type="submit"
                                    class="bg-red-400 hover:bg-red-500 transition-all p-2 w-full text-center">Sim, quero
                                    excluir
                                    esse comentário!</button>
                            </form>
                        </div>
                    </x-modal>
                    @else
                    <span class="text-center text-red-500">Comentário excluído!</span>
                    @endif
                </td>
                @break
                @default
                Erro
                @endswitch
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
