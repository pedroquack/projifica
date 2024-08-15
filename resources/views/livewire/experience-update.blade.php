<div>
    <form wire:submit.prevent="update" method="post" class="flex flex-col gap-5">
        @csrf
        @method('PUT')
        <div class="flex flex-col">
            <label class="font-bold" for="company">Empresa / Projeto</label>
            <input class="rounded-lg @if ($errors->has('company')) input-error @endif"
                type="text" wire:model="company" id="company" placeholder="Ex: Instituto Federal do Paraná">
            @if ($errors->has('company'))
                <span class="invalid-feedback">
                    <p>{{ $errors->first('company') }}</p>
                </span>
            @endif
        </div>
        <div class="flex flex-col">
            <label class="font-bold" for="role">Cargo</label>
            <input class="rounded-lg @if ($errors->has('role')) input-error @endif"
                type="text" wire:model="role" id="role" placeholder="Ex: Programador">
            @if ($errors->has('role'))
                <span class="invalid-feedback">
                    <p>{{ $errors->first('role') }}</p>
                </span>
            @endif
        </div>
        <div class="flex flex-col">
            <label class="font-bold" for="description">Descrição</label>
            <textarea wire:model="description" id="description" placeholder="Escreva aqui sobre essa experiência" rows="3" class="rounded-lg resize-none @if ($errors->has('description')) input-error @endif"></textarea>
            @if ($errors->has('description'))
                <span class="invalid-feedback">
                    <p>{{ $errors->first('description') }}</p>
                </span>
            @endif
        </div>
        <div class="grid grid-cols-2 gap-5">
            <div class="md:col-span-1 col-span-2 flex flex-col">
                <label class="font-bold" for="start_date">Inicio (ano)</label>
                <input class="rounded-lg @if ($errors->has('start_date')) input-error @endif" placeholder="Ex: 2004"
                    type="number" wire:model="start_date" id="start_date" min="1950" max="2050" step="1">
                @if ($errors->has('start_date'))
                    <span class="invalid-feedback">
                        <p>{{ $errors->first('start_date') }}</p>
                    </span>
                @endif
            </div>
            <div class="md:col-span-1 col-span-2 flex flex-col">
                <label class="font-bold" for="end_date">Final (ano)</label>
                <input class="rounded-lg @if ($errors->has('end_date')) input-error @endif" placeholder="Ex: 2010"
                    type="number" wire:model="end_date" id= "end_date" min="1950" max="2050" step="1">
                    <div class="flex flex-row my-1 items-center gap-1">
                        <input type="checkbox" wire:model="actual" id="actual">
                        <label for="actual">É meu emprego atual</label>
                    </div>
                @if ($errors->has('end_date'))
                    <span class="invalid-feedback">
                        <p>{{ $errors->first('end_date') }}</p>
                    </span>
                @endif
            </div>
        </div>
        <button type="submit"
            class="bg-emerald-400 hover:bg-emerald-500 font-bold text-lg p-2 rounded-lg">Atualizar</button>
    </form>
</div>
