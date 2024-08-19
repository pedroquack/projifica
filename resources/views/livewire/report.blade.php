<div class="text-center">
    <h1 class="font-bold text-lg mb-3">Fazer uma denúncia</h1>
    <form wire:submit.prevent="store" method="post" class="flex flex-col gap-3">
        @csrf
        <input type="hidden" wire:model="target_id" value="{{ $target_id }}">
        <input type="hidden" wire:model="user_id" value="{{ $user_id }}">
        <div class="flex flex-col text-start">
            <label for="reason">Motivo da denúncia</label>
            <textarea wire:model="reason" id="reason" class="resize-none @if ($errors->has('reason')) input-error @endif"
                placeholder="Escreva aqui o motivo da denúncia"></textarea>
            @if ($errors->has('reason'))
            <span class="invalid-feedback">
                <p>{{ $errors->first('reason') }}</p>
            </span>
            @endif
        </div>
        <button type="submit" class="bg-red-400 hover:bg-red-500 p-2">Denunciar</button>
    </form>
</div>
