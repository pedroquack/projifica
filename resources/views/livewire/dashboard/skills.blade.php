<div>
    <div class="flex md:flex-row flex-col-reverse gap-3">
        <input type="text" wire:model.live="search" placeholder="Pesquisar postagens..."
            class="border-gray-300 rounded p-1 w-full">
        @livewire('dashboard.skill-create')
    </div>
    <table class="border-separate border w-full overflow-hidden">
        <thead>
            <tr>
                <th class="border">Id</th>
                <th class="border">Nome</th>
                <th class="border">Quantos projetos</th>
                <th class="border">Postado em</th>
                <th class="border">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($skills as $s)
            <tr>
                <td class="border">{{ $s->id }}</td>
                <td class="border">{{ $s->name }}</td>
                <td class="border">{{ $s->projects->count() }}</td>
                <td class="border">{{ $s->created_at->format('d/m/Y') }}</td>
                <td class="border flex gap-1 w-full">
                    <x-modal width="w-full" color="bg-red-400 hover:bg-red-500">
                        <x-slot:button>
                            Excluir
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                            </svg>
                        </x-slot:button>
                        <div class="flex flex-col gap-4">
                            <div>
                                <h1 class="font-bold text-xl">Tem certeza que deseja excluir esta habilidade?</h1>
                                <h2>Essa ação é irreversivel</h2>
                            </div>
                            <form action="{{ route('admin.skills.destroy', $s->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-400 hover:bg-red-500 transition-all p-2 w-full text-center">Sim, quero
                                    excluir
                                    esta habilidade</button>
                            </form>
                        </div>
                    </x-modal>
                    <x-modal width="w-full" color="bg-emerald-400 hover:bg-emerald-500">
                        <x-slot:button>
                            Editar
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                            </svg>

                        </x-slot:button>
                        @livewire('dashboard.skill-edit', ['skill' => $s])
                    </x-modal>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
