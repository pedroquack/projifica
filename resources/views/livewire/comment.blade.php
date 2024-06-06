<div>
    <h1 class="font-bold text-lg">{{ $post->comments->count() }} comentários</h1>
    <form wire:submit.prevent="store" method="post" class="flex flex-col gap-2">
        <div class="flex flex-col">
            <textarea wire:model="body" id="body" class="resize-none  @if ($errors->has('body')) input-error @endif"
                placeholder="Deixe seu comentário..."></textarea>
            @if ($errors->has('body'))
                <span class="invalid-feedback">
                    <p>{{ $errors->first('body') }}</p>
                </span>
            @endif
        </div>
        <div class="flex md:justify-end">
            <button type="submit"
                class="bg-emerald-400 hover:bg-emerald-500 md:p-1 p-2 md:w-1/4 w-full shadow-sm shadow-neutral-600">
                Comentar
            </button>
        </div>
    </form>
</div>
