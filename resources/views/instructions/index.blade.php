@extends('layouts/main_layout')
@section('title', 'Intobo Auctioneers | Instructions')
@section('content-wrapper')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Instructions</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Instructions</li>
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
                <a href="{{route('instructions.create')}}" class="btn btn-primary btn-sm float-right">Add New Instruction</a>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Bank Name</th>
                    <th>Branch</th>
                    <th>Debtors Name</th>
                    <th>Debtors Contact</th>
                    <th>Loan Amount</th>
                    <th>Loan Status</th>
                    <th>Instruction Date</th>
                    <th>Responsible Officer</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($instructions as $instruction)
                        <tr>
                          <td class="text-uppercase"> {{$instruction->bank->bank_name}} </td>
                          <td> {{$instruction->branch}} </td>
                          <td> {{$instruction->debtor_name}} </td>
                          <td> {{$instruction->debtor_tell}} </td>
                          <td> {{number_format($instruction->loan_amount)}} </td>
                          <td> {{$instruction->loan_status}} </td>
                          <td> {{date('d-m-Y', strtotime($instruction->instruction_date))}} </td>
                          <td> {{$instruction->responsible_officer}} </td>
                          <td> <a href="#" class="btn btn-primary btn-xs"> <i class="fas fa-search"></i> View Details</a></td>
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
