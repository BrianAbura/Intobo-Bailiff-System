@extends('layouts/main_layout')
@section('title', 'Intobo Auctioneers | Fees')
@section('content-wrapper')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Fees</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Fees</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Payment ID</th>
                    <th>Narration</th>
                    <th>Amount</th>
                    <th>Date Added</th>
                    <th>Receipt</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($fees as $fee)
                    <tr>
                    <td class="text-center"><a href="{{route('payments.show',$fee->payments_id )}}">{{$fee->payments_id }}</a></td>
                    <td>{{$fee->narration}}</td>
                    <td>{{number_format($fee->amount)}}</td>
                    <td>{{date('d-M-Y', strtotime($fee->pay_date))}}</td>
                    <td>
                        @if (!empty($fee->receipt))
                        {
                            <a href="{{asset($fee->receipt)}}" target="_blank" alt=""><i class="fas fa-download"> View File</i></a>
                        }
                        @endif
                    </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
