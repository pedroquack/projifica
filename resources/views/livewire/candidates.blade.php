<div class="flex flex-col gap-3 max-h-96 overflow-y-auto">
    <h1 class="font-bold text-2xl text-center">
        @if ($project->candidates->count() > 0) Candidatos do seu projeto @else Seu projeto ainda não obteve candidatos @endif
    </h1>
    <hr>
    @foreach ($project->candidates as $c)
        <a x-data="{ hover: false }" @mouseover="hover = true" @mouseout="hover = false"
            href="{{ route('profile.index', $c->user->id) }}"
            class="flex justify-between pr-4 items-center hover:bg-neutral-100 rounded-full">
            <div class="flex items-center gap-3">
                <img src="{{ asset($c->user->image) }}" alt=""
                    class="w-10 h-10 object-cover rounded-full border border-emerald-400">
                <span>{{ $c->user->name }}</span>
            </div>
            <span x-show="hover" x-transition class="font-bold">Ver perfil</span>
        </a>
        <div class="flex flex-col gap-2">
            <span class="font-semibold">Proposta:</span>
            <p class="break-words">
                {{ $c->proposal }}
            </p>
        </div>
        <hr>
    @endforeach
</div>
