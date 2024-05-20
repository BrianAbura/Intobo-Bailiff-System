@extends('layouts/main_layout')
@section('title', 'Intobo Auctioneers | Commitments')
@section('content-wrapper')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Commitments</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Commitments</li>
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
              <div class="card-header">
                <a href="{{route('commitment.create')}}" class="btn btn-primary btn-sm float-right">Add New commitment</a>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Debtors Name</th>
                    <th>Bank</th>
                    <th>Loan Balance</th>
                    <th>Commitement Made</th>
                    <th>Commitment Date</th>
                    <th>Responsible Officer</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($commitments as $commitment)
                        <tr>
                          <td> <a href="{{route('instructions.show', $commitment->instruction->id)}}">{{$commitment->instruction->debtor_name }}</a> </td>
                          <td> {{$commitment->instruction->bank->bank_name.' - '.$commitment->instruction->branch}} </td>
                          <td> {{number_format($commitment->instruction->loan_balance)}} </td>
                          <td class="text-wrap" style="width: 20em;"> {{$commitment->description }}</td>
                          <td> {{date('d-m-Y', strtotime($commitment->commitment_date))}} </td>
                          <td> {{$commitment->responsible_officer }} </td>
                          <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown">
                                    <i class="fas fa-bars"></i>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                  <a class="dropdown-item" href="{{route('commitment.edit', $commitment->id )}}">Edit</a>
                                </div>
                              </div>
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
