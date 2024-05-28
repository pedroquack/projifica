<div class="flex flex-col {{$class}}">
    <label for="{{$id}}" class="font-bold">{{$label}}</label>
    <input id="{{$id}}" type="{{$type}}" name="{{$name}}" placeholder="{{$placeholder}}" value="{{old($name)}}"
        class="rounded-lg text-black @if($errors->has($name)) input-error @endif">
    @if ($errors->has($name))
    <span class="invalid-feedback">
        <p>{{ $errors->first($name)}}</p>
    </span>
    @endif
</div>