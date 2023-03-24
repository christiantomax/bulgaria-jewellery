<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BULGARIA Jewellery</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('template/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('template/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('template/dist/css/adminlte.min.css') }}">
  <!-- jQuery -->
  <script src="../../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../../dist/js/adminlte.min.js"></script>
  <!-- Icon -->
  <link rel="shortcut icon" href="{{ asset('template/dist/img/Logo.png') }}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <p class="h1"><b>Change Password</b></p>
    </div>
    <div class="card-body">

        @if(session()->has('Error'))
          <div class="alert alert-danger alert-dismissible"><i class="icon fas fa-info"></i>
            {{ session('Error') }}</div>
        @else
          <p class="login-box-msg">Please change your password!</p>
        @endif

        <form action="{{ route('changepasspost') }}" method="post">
        @csrf
        <div class="input-group mb-3">
            <input type="password" name="password1" class="form-control" placeholder="Password" required>
            <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-lock"></span></div>
            </div>
        </div>
        <div class="input-group mb-3">
            <input type="password" name="password2" class="form-control" placeholder="Confirm Password" required>
            <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-lock"></span></div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block"><b>CHANGE PASSWORD</b></button>
            </div>
        </div>
        </form>
  </div>
</div>

</body>
</html>
