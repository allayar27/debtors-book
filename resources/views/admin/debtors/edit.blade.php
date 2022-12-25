@extends('layouts.app')

@section('title', 'edit debtors')

@section('content')

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Редактирование</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('debtor.update', $debtor)}}" method="POST">
            @csrf
            @method('PATCH')
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Имя</label>
                    <input type="text" name="name" value="{{ $debtor->name }}" class="form-control" id="exampleInputEmail1" placeholder="Enter name">
                </div>
                
                <div class="form-group">
                    <label for="exampleInputEmail1">Телефон</label>
                    <input type="phone" name="phone" value="{{ $debtor->phone }}" class="form-control" id="exampleInputEmail1" placeholder="Enter phone">
                </div>
                
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <a href="{{ route('debtor.index') }}">
                    <button type="submit" class="btn btn-warning">назад</button>
                </a>
                <button type="submit" class="btn btn-primary">изменить</button>
            </div>
            @if ($errors->any())
                <div style="text-align: center" class="alert alert-danger">
                    <ul >
                        @foreach ($errors->all() as $error)
                            <li style="text-align: center">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>
    </div>
@endsection
