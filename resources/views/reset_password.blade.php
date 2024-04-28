
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Intobo Auctioneers | Reset Password</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>
<body class="hold-transition">

<section class="main-section">
    <div class="row">
        <div class="col-md-6 login-image">
            <h1>Welcome</h1>
        </div>

        <div class="col-md-4 login-box" style="margin: 8%">
            <div class="card card-outline card-primary">
              <div class="card-header text-center">
                <a href="#" class="h2"><b>Intobo Auctioneers</b></a>
              </div>
                <div class="card-body">

      {{-- Notification Message --}}
      @if (session('status_success'))
          <p class="text-success">
            {{ session('status_success') }}
      @endif

      @if ($errors->has('email'))
      <p class="text-danger">
          {{ $errors->first('email') }}
      </p>
      @endif
       {{-- Notification Message --}}

       <form action="{{route('password.update')}}" method="post">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}" >

        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" value="{{ $_REQUEST['email'] }}" autofocus readonly>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" autocomplete="off">
          @error('password')
          <div class="form-text text-danger">{{ $message }}</div>
          @enderror
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" autocomplete="off">
          @error('password_confirmation')
          <div class="form-text text-danger">{{ $message }}</div>
          @enderror
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Change password</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <p class="mt-4 mb-1">
        <a href="{{route('welcome')}}">Login</a>
      </p>
  </div>
  </div>
  </div>
  </div>
</section>

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>
