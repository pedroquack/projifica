@extends('admin.dashboard')
@section('subcontent')
<h1 class="font-bold text-center text-lg">Usuários</h1>
<div class="h-96 overflow-auto">
    <h1>Total: <strong>{{ $users }}</strong></h1>
    @livewire('dashboard.users')
</div>
@endsection
