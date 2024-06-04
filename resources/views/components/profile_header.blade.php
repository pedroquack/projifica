<div class="grid grid-cols-3 bg-white text-center w-full text-black md:text-lg text-sm">
    <a href="{{ route('profile.index', [$user_name,$user_id]) }}"
        class="hover:bg-neutral-300 transition-all md:col-span-1 col-span-3 p-3 @if (Route::getCurrentRoute()->getName() == 'profile.index') font-bold bg-neutral-300 @endif" >
        Perfil
    </a>
    <a href="{{ route('portfolio.index',[$user_name,$user_id]) }}"
        class="hover:bg-neutral-300 transition-all md:col-span-1 col-span-3 p-3 @if (Route::getCurrentRoute()->getName() == 'portfolio.index') font-bold bg-neutral-300 @endif">
        Portfólio
    </a>
    <a href="{{ route('post.user.index',[$user_name,$user_id]) }}"
        class="hover:bg-neutral-300 transition-all md:col-span-1 col-span-3 p-3 @if (Route::getCurrentRoute()->getName() == 'post.user.index') font-bold bg-neutral-300 @endif">
        Postagens
    </a>
</div>
