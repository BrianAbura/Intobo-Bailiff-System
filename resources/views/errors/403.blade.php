
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Intobo Auctioneers | 403 Error Page</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <style>
    .login-image {
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
    .content-header{
        background: #F5F5F5;
    }
</style>
</head>
<body class="hold-transition">

    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="text-primary">
                    <img src="{{asset('dist/img/intobo_logo.png')}}" alt="Intobo Logo" class="brand-image img-circle elevation-5">
                    <span class="brand-text font-weight-light">Intobo Auctioneers</span>
                  </h2>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item active">403 Error Page</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
<section class="main-section">
    <div class="row">
    <div class="login-image">
    </div>
    <div class="error-page">
        <h2 class="headline text-danger"> 403</h2>
        <div class="error-content">
            <h3><i class="fas fa-lock text-danger"></i> Access Forbidden.</h3>
            <p>
                You do not have permission to access this resource.<br>
            <a href="{{url()->previous()}}"><i class="fas fa-arrow-left"></i> Return to previous page</a>
            </p>
        </div>
        <!-- /.error-content -->
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
