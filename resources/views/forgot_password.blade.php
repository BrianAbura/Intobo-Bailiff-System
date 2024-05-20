
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Intobo Auctioneers | Forgot Password</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <link rel='shortcut icon' type='image/x-icon' href='{{asset('dist/img/intobo_logo.png')}}'/>
  <style>
    .login-image {
    background-image: url('dist/img/bg1.jpg');
    background-size: cover;
    display: flex;
    height: 100vh;
    align-items: center;
    justify-content: center;
    color: white;
    }
    .main-section{
      background: #F5F5F5;
    }
</style>
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
          </p>
      @elseif (session('status_error'))
          <p class="text-danger">
            {{ session('status_error') }}
          </p>
      @else
          <p class="login-box-msg">Enter your email to receive a password reset link.</p>
      @endif
       {{-- Notification Message --}}

       <form action="{{route('forgot_pwd_post')}}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email" autocomplete="off" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 mt-3">
            <button type="submit" class="btn btn-primary btn-block">Send Password Reset Link</button>
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
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.js')}}"></script>
</body>
</html>
