@extends('layouts/main_layout')
@section('title', 'Intobo Auctioneers | Payments')
@section('content-wrapper')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Payments</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Payments</li>
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
                <a href="{{route('payments.create')}}" class="btn btn-primary btn-sm float-right">Add New Payment</a>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Debtors Name</th>
                    <th>Bank</th>
                    <th>Loan Balance</th>
                    <th>Amount Paid</th>
                    <th title="Commission Loan Balance">Commission LB</th>
                    <th title="Fees Loan Balance">Fees LB</th>
                    <th>Payment Date</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($payments as $payment)
                        <tr>
                          <td> <a href="{{route('instructions.show', $payment->instruction->id)}}">{{$payment->instruction->debtor_name }}</a> </td>
                          <td> {{$payment->instruction->bank->bank_name.' - '.$payment->instruction->branch}} </td>
                          <td> {{number_format($payment->loan_balance)}} </td>
                          <td> {{number_format($payment->amount)}} </td>
                          <td> {{number_format($payment->commission_based_olb)}}</td>
                          <td> {{number_format($payment->fees_based_olb)}}</td>
                          <td> {{date('d-m-Y', strtotime($payment->payment_date))}} </td>
                          <td>
                            {{-- <a href="{{route('payments.edit', $payment->id )}}" class="btn btn-primary btn-xs"> <i class="fas fa-edit"></i></a>
                            <a href="{{route('payments.destroy', $payment->id )}}" class="btn btn-danger btn-xs"> <i class="fas fa-trash"></i></a> --}}
                            <div class="btn-group">
                                <button type="button" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown">
                                    <i class="fas fa-bars"></i>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                  <a class="dropdown-item" href="{{route('payments.edit', $payment->id )}}">Edit</a>
                                  <a class="dropdown-item" href="{{route('payments.show', $payment->id )}}">View</a>
                                  <a class="dropdown-item" href="#">Print Invoice</a>
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
