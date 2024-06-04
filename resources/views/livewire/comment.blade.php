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
    <div class="mt-4">
        @if ($post->comments->count() > 0)
            <hr>
            <div class="flex flex-col">
            @foreach ($post->comments->sortByDesc('created_at') as $c)
                <div class="flex flex-col gap-3 p-2">
                    <div class="flex justify-between items-center">
                        <a href="{{ route('profile.index', [$c->user->name, $c->user->id]) }}"
                            class="md:w-1/4 w-full flex md:justify-start justify-center">
                            <div class="flex items-center gap-3 hover:bg-neutral-100 rounded-full md:w-full">
                                <img class="rounded-full w-8 h-8 object-cover" src="{{ asset($c->user->image) }}"
                                    alt="">
                                <span>{{ explode(' ', $c->user->name)[0] }}</span>
                            </div>
                        </a>
                        <small class="text-neutral-500">
                            Postado {{ $c->created_at->format('d/m/Y') }} ás {{ $c->created_at->format('H:i') }}
                        </small>
                    </div>
                    <p class="text-sm">{{ $c->body }}</p>
                    <hr>
                </div>
            @endforeach
        </div>
        @endif
    </div>

    <script>
        const body = document.getElementById('body')
        window.addEventListener('commentAdded', (event) => {
            body.value = ''
        })
    </script>
</div>
