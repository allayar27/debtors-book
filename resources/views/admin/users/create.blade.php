@extends('layouts.admin_layout')

@section('title', 'create users')

@section('content')

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Создать пользователя</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('user.store')}}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Имя</label>
                    <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter name">
                </div>
                
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Пароль</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                
                <div class="form-group">
                    <label for="exampleInputPassword1">Потверждения пароля</label>
                    <input type="password" name="password_confirm" class="form-control" id="exampleInputPassword1" placeholder="Confirm Password">
                </div>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
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
