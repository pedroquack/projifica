@extends('admin.dashboard')
@section('subcontent')
<h1 class="font-bold text-center text-lg">Projetos</h1>
<div class="h-96 overflow-auto">
    <h1>Total: <strong>{{ $projects }}</strong></h1>
    @livewire('dashboard.projects')
</div>
@endsection
