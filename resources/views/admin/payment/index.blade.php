@extends('layouts.app')

@section('title', 'create debts')

@section('content')

<div class="bg-light p-4 rounded">
    <h4>Долги</h4>

    
    @if ($message = Session::get('success'))

    <div class="alert alert-success ">
    
        <button type="button" class="close" data-dismiss="alert">×</button>    
    
        <strong>{{ $message }}</strong>
    
    </div>
    
    @endif
       
    @livewire('payment')
   
</div>

    
@endsection
