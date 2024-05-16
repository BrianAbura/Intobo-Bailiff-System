@extends('layouts/main_layout')
@section('title', 'Intobo Auctioneers | Home')
@section('content-wrapper')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h4>Dashboard</h4>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-2 col-6">
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3>{{$bank_count}}</h3>
                    <p>Banks</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-bag"></i>
                  </div>
                  <a href="{{route('banks.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        <!-- /.container-fluid -->
      </section>

    </div>
@endsection
