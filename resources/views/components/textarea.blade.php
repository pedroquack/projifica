<div class="flex flex-col {{$class}}">
    <label for="{{$id}}" class="font-bold">{{$label}}</label>
    <textarea id="{{$id}}" name="{{$name}}" placeholder="{{$placeholder}}"
        class="rounded-lg text-black resize-none h-28 @if($errors->has($name)) input-error @endif"></textarea>
    @if ($errors->has($name))
    <span class="invalid-feedback">
        <p>{{ $errors->first($name)}}</p>
    </span>
    @endif
</div>