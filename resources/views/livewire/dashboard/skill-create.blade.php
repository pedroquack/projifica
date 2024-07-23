<div>
    <x-modal width="w-full" color="bg-emerald-400 hover:bg-emerald-500">
        <x-slot:button>
            Adicionar Habilidade
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
        </x-slot:button>
        <form wire:submit.prevent="store">
            <div class="flex flex-col my-3">
                <label class="font-bold" for="name">Nome da habilidade</label>
                <input class="rounded-lg @if ($errors->has('name')) input-error @endif" type="text"
                    wire:model="name" id="name" placeholder="Ex: PHP">
                @if ($errors->has('name'))
                <span class="invalid-feedback">
                    <p>{{ $errors->first('name') }}</p>
                </span>
                @endif
            </div>
            <button type="submit"
                class="bg-green-400 hover:bg-green-500 transition-all p-2 w-full text-center">Criar</button>
        </form>
    </x-modal>
</div>
