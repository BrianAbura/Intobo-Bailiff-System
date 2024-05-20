
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">

  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{asset('plugins/toastr/toastr.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')}}">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.min.css')}}">
  <link rel='shortcut icon' type='image/x-icon' href='{{asset('dist/img/intobo_logo.png')}}'/>
  <style>
    .form-control{
        color:midnightblue;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{asset('dist/img/intobo_logo.png')}}" alt="IntoboLogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('home')}}" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-th-large"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <i class="fas fa-user mr-2"></i> My Profile
          </a>
          <div class="dropdown-divider"></div>
          <form action="{{route('logout')}}" method="post">
            @csrf
            <button type="submit" class="dropdown-item">
                <i class="fas fa-power-off mr-2"></i> Sign Out
            </button>
          </form>

          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('dist/img/intobo_logo.png')}}" alt="Intobo Logo" class="brand-image img-circle elevation-3">
      <span class="brand-text font-weight-light">Intobo Auctioneers</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('dist/img/avatar.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }} </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{route('home')}}" class="nav-link {{ (request()->is('home*')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item {{ (request()->is(['banks*', 'instructions*'])) ? 'menu-open' : '' }}">
            <a href="" class="nav-link {{ (request()->is(['banks*', 'instructions*'])) ? 'active' : '' }}">
              <i class="nav-icon fas fa-building"></i>
              <p>
                Banks
                <i class="fa fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item active">
                <a href="{{route('banks.index')}}" class="nav-link {{ (request()->is('banks*')) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Banks</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('instructions.index')}}" class="nav-link {{ (request()->is('instructions*')) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Instructions</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item {{ (request()->is(['payments*', 'fees*'])) ? 'menu-open' : '' }}">
            <a href="" class="nav-link {{ (request()->is(['payments*', 'fees*'])) ? 'active' : '' }}">
              <i class="nav-icon fas fa-money-bill"></i>
              <p>
                Payments
                <i class="fa fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item active">
                <a href="{{route('payments.index')}}" class="nav-link {{ (request()->is('payments*')) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Payments</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('fees.index')}}" class="nav-link {{ (request()->is('fees*')) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>View Fees</p>
                  </a>
                </li>
              </ul>
          </li>

          <li class="nav-item {{ (request()->is(['commitment*'])) ? 'menu-open' : '' }}">
            <a href="" class="nav-link {{ (request()->is(['commitment*'])) ? 'active' : '' }}">
              <i class="nav-icon fas fa-sticky-note"></i>
              <p>
                Commitments
                <i class="fa fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item active">
                <a href="{{route('commitment.index')}}" class="nav-link {{ (request()->is('commitment*')) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Commitments</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item {{ (request()->is(['demand_notice*'])) ? 'menu-open' : '' }}">
            <a href="" class="nav-link {{ (request()->is(['demand_notice*'])) ? 'active' : '' }}">
              <i class="nav-icon fas fa-volume-up"></i>
              <p>
                Demand Notices
                <i class="fa fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item active">
                <a href="{{route('demand_notice.index')}}" class="nav-link {{ (request()->is('demand_notice*')) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Demand Notices</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item {{ (request()->is(['adverts*'])) ? 'menu-open' : '' }}">
            <a href="" class="nav-link {{ (request()->is(['adverts*'])) ? 'active' : '' }}">
              <i class="nav-icon fas fa-ad"></i>
              <p>
                Adverts
                <i class="fa fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item active">
                <a href="{{route('adverts.index')}}" class="nav-link {{ (request()->is('adverts*')) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Adverts</p>
                </a>
              </li>
            </ul>
          </li>


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->

      @yield('content-wrapper')

  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>&copy; 2024.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">Product of
      <a href="https://www.lyptusventures.com/" target="_blank">Lyptus Ventures Limited</a>
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- bs-custom-file-input -->
<script src="{{asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<!-- Select2 -->
<script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('plugins/chart.js')}}/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- DataTables  & Plugins -->
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<!-- Toastr -->
<script src="{{asset('plugins/toastr/toastr.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('dist/js/pages/dashboard.js')}}"></script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
    theme: 'bootstrap4'
    })

    //Date picker
    $('.reservationdate').datetimepicker({
    format: 'MM/DD/YYYY'
    });

    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

<script>
    $('.InputAmount').keyup(function(event) {
      // skip for arrow keys
      if(event.which >= 37 && event.which <= 40) return;
      // format number
      $(this).val(function(index, value) {
        return value
        .replace(/\D/g, "")
        .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        ;
      });
    });
    </script>

{{-- Success Notifications --}}
@if (session('success'))
  <script>
     var msg = @json(session('success', ''));
     toastr.success(msg)
  </script>
@endif

{{-- Error Notification --}}
@if (session('error'))
  <script>
     var msg = @json(session('error', ''));
     toastr.error(msg)
  </script>
@endif

{{-- Any Error Notification --}}
@if ($errors->any())
  <script>
    toastr.error('There was an error processing your request. Please try again.')
  </script>
@endif

</body>
</html>
