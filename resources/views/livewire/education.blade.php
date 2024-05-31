<div>
    <form wire:submit.prevent="store" method="post" class="flex flex-col gap-5">
        @csrf
        <div class="flex flex-col">
            <label class="font-bold" for="school">Instituição de ensino</label>
            <input class="rounded-lg @if ($errors->has('school')) input-error @endif"
                type="text" wire:model="school" id="school" placeholder="Ex: Instituto Federal do Paraná">
            @if ($errors->has('school'))
                <span class="invalid-feedback">
                    <p>{{ $errors->first('school') }}</p>
                </span>
            @endif
        </div>
        <div class="flex flex-col">
            <label class="font-bold" for="course">Curso</label>
            <input class="rounded-lg @if ($errors->has('course')) input-error @endif"
                type="text" wire:model="course" id="course" placeholder="Ex: Técnico em Meio Ambiente">
            @if ($errors->has('course'))
                <span class="invalid-feedback">
                    <p>{{ $errors->first('course') }}</p>
                </span>
            @endif
        </div>
        <div class="grid grid-cols-2 gap-5">
            <div class="md:col-span-1 col-span-2 flex flex-col">
                <label class="font-bold" for="start_date">Inicio do curso (ano)</label>
                <input class="rounded-lg @if ($errors->has('start_date')) input-error @endif" placeholder="Ex: 2004"
                    type="number" wire:model="start_date" id="start_date" min="1950" max="2050" step="1">
                @if ($errors->has('start_date'))
                    <span class="invalid-feedback">
                        <p>{{ $errors->first('start_date') }}</p>
                    </span>
                @endif
            </div>
            <div class="md:col-span-1 col-span-2 flex flex-col">
                <label class="font-bold" for="end_date">Final do curso (ano)</label>
                <input class="rounded-lg @if ($errors->has('end_date')) input-error @endif" placeholder="Ex: 2010"
                    type="number" wire:model="end_date" id= "end_date" min="1950" max="2050" step="1">
                @if ($errors->has('end_date'))
                    <span class="invalid-feedback">
                        <p>{{ $errors->first('end_date') }}</p>
                    </span>
                @endif
            </div>
        </div>
        <button type="submit"
            class="bg-emerald-400 hover:bg-emerald-500 font-bold text-lg p-2 rounded-lg">Adicionar</button>
    </form>
</div>
