<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Debt Notes | Log in </title> 

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/admin/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/admin/dist/css/adminlte.css" href="/admin/plugins/css/adminlte.min.css">
  <!--Toastr-->
  <link rel="stylesheet" type="text/css" href="{{ asset('/admin/plugins/toastr/toastr.min.css') }}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1"><b>Debt Note</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Войдите, чтобы начать сеанс</p>

      <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="input-group mb-3">
          <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Email">
          @if ($errors->has('email'))
          <span class="invalid-feedback">
              <strong>{{ $errors->first('email') }}</strong>
          </span>
          @endif
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
          @if ($errors->has('password'))
          <span class="invalid-feedback">
              <strong>{{ $errors->first('password') }}</strong>
          </span>
          @endif

        </div>
        <div class="row">
          <div class="col-8">
            <p class="mb-1">
              <a href="{{ route('forgot') }}" class="fw-bold text-body"><u>Забыли свой пароль ?</u></a>
            </p>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Вход</button><br>
          </div>
          <!-- /.col -->
        </div>
      </form>

     
      
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="/admin/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/admin/dist/js/adminlte.min.js"></script>
<!-- Toastr -->
<script type="text/javascript" src="{{ asset('/admin/plugins/toastr/toastr.min.js') }}"></script>

<script>
  $(document).ready(function() {
    toastr.options = {
      "positionClass": "toast-bottom-right",
    }

    @if(Session::has('success'))
      toastr.success('{{ Session::get('success') }}');
    @endif

  });
</script>
</body>
</html>
