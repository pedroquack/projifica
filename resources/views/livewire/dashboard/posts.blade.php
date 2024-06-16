<div>
    <input type="text" wire:model.live="search" placeholder="Pesquisar postagens..." class="border-gray-300 rounded p-1 w-1/3">
    <table class="border-separate border w-full overflow-hidden">
        <thead>
            <tr>
                <th class="border">Id</th>
                <th class="border">Titulo</th>
                <th class="border">Criador da postagem</th>
                <th class="border">Comentários</th>
                <th class="border">Postado em</th>
                <th class="border w-fit">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $p)
            <tr>
                <td class="border">{{ $p->id }}</td>
                <td class="border">{{ $p->title }}</td>
                <td class="border">{{ $p->user->name }}</td>
                <td class="border">{{ $p->comments->count() }}</td>
                <td class="border">{{ $p->created_at->format('d/m/Y') }}</td>
                <td class="border flex gap-1 w-full">
                    <a href="{{ route('post.show',[$p->id]) }}"
                        class="bg-emerald-400 hover:bg-emerald-500 transition-all py-1 px-3 w-full text-center">Ver
                        postagem</a>
                    <x-modal width="w-full" color="bg-red-400 hover:bg-red-500">
                        <x-slot:button>
                            Excluir
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                              </svg>
                        </x-slot:button>
                        <div class="flex flex-col gap-4">
                            <div>
                                <h1 class="font-bold text-xl">Tem certeza que deseja excluir esta postagem?</h1>
                                <h2>Essa ação é irreversivel</h2>
                            </div>
                            <form action="{{ route('admin.post.destroy',$p->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-400 hover:bg-red-500 transition-all p-2 w-full text-center">Sim, quero excluir
                                    esta postagem</button>
                            </form>
                        </div>
                    </x-modal>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
