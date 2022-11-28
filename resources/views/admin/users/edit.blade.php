@extends('layouts.admin_layout')

@section('title', 'edit users')

@section('content')

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Редактирование</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('user.update', $user)}}" method="POST">
            @csrf
            @method('PATCH')
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Имя</label>
                    <input type="text" name="name" value="{{ $user->name }}" class="form-control" id="exampleInputEmail1" placeholder="Enter name">
                </div>
                
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" name="email" value="{{ $user->email }}" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                </div>
                
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <a href="{{ route('user.index') }}">
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
