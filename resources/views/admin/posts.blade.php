@extends('admin.dashboard')
@section('subcontent')
<h1 class="font-bold text-center text-lg">Postagens</h1>
<div class="h-96 overflow-auto">
    <h1>Total: <strong>{{ $posts }}</strong></h1>
    @livewire('dashboard.posts')
</div>
@endsection
