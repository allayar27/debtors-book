@extends('layouts.app')

@section('title', 'create clients')

@section('content')

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Создать должника</h3>
        </div>
        
        <form action="{{route('debtor.store')}}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Имя</label>
                    <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter name">
                </div>
                
                <div class="form-group">
                    <label for="exampleInputEmail1">Телефон</label>
                    <input type="number" name="phone" class="form-control" id="exampleInputEmail1" placeholder="Enter phone number">
                </div>

            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            @if ($errors->any())
                <div style="text-align: center" class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li style="text-align: center">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>
    </div>
@endsection
