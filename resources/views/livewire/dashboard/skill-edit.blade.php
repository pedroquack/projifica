<div class="flex flex-col gap-4">
    <div>
        <h1 class="font-bold text-xl">Editar habilidade</h1>
    </div>
    <form wire:submit.prevent="update">
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
            class="bg-green-400 hover:bg-green-500 transition-all p-2 w-full text-center">Editar</button>
    </form>
</div>
