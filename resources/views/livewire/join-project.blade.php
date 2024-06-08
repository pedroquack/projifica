<div>
    <form wire:submit.prevent="store" method="post" class="text-center flex flex-col gap-4">
        @csrf
        <div class="flex flex-col">
            <label for="proposal" class="font-bold text-lg">Deseja fazer uma proposta para o dono do projeto? (opcional)</label>
            <textarea wire:model="proposal" id="proposal" class="resize-none rounded-lg border-neutral-400 @if($errors->has('proposal')) input-error @endif" rows="4"
                placeholder="Escreva sobre forma que você ajudaria a resolver o problema, algumas ideias de para incentivar o projeto... ">{{ old('proposal') }}</textarea>
            @if ($errors->has('proposal'))
                <span class="invalid-feedback">
                    <p>{{ $errors->first('proposal') }}</p>
                </span>
            @endif
        </div>
        <button type="submit"
            class="bg-emerald-400 hover:bg-emerald-500 rounded-lg transition-all p-2">Candidatar-se</button>
    </form>
</div>
