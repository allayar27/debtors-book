@extends('layouts.app')

@section('title', 'users')
 
@section('content')

    <div class="bg-light p-4 rounded">
      
        <h4>Список пользователей</h4>
    
        <section class="content-header">
            <div class="container-fluid">
              @livewire('user-pagination')
            </div><!-- /.container-fluid -->
          </section>

    </div>		
    

@endsection