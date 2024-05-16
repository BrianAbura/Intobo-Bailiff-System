@extends('layouts/main_layout')
@section('title', 'Intobo Auctioneers | Bank Details')
@section('content-wrapper')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Bank Details</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Banks</li>
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
                  <h5 class="text-bold text-primary text-uppercase">{{$bank->bank_name}}
                    <span class="float-right">
                        <a title="Edit" data-toggle="modal" data-target="#modal-lg" class="btn btn-info btn-sm"><i class="fas fa-edit"></i> </a>
                        <a title="Delete" data-toggle="modal" data-target="#modal-del" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> </a>
                    </span>
                </h5>
                    </div>
                <div class="card-body">
                  <div class="row">
                      <div class="col-sm-4">
                          <p class="text-md text-uppercase">Write Off Commission
                              <b class="d-block text-primary">{{$bank->writeoff_comm}}</b>
                          </p>
                      </div>
                      <div class="col-sm-4">
                          <p class="text-md text-uppercase">Active Loan Commission
                              <b class="d-block text-primary">{{$bank->active_loan_comm}}</b>
                          </p>
                      </div>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              {{-- Instruction under the Bank --}}
              <div class="card" id="printInstruction">
                <!-- /.card-header -->
                <div class="card-header">
                    <h5>Instructions</h5>
                    </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                        <table id="example2" class="table table-bordered table-striped">
                            <thead>
                            <tr>
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
                                    <td> {{$instruction->branch}} </td>
                                    <td> {{$instruction->debtor_name}} </td>
                                    <td> {{$instruction->debtor_tell}} </td>
                                    <td> {{number_format($instruction->loan_amount)}} </td>
                                    <td> {{$instruction->loan_status}} </td>
                                    <td> {{date('d-m-Y', strtotime($instruction->instruction_date))}} </td>
                                    <td> {{$instruction->responsible_officer}} </td>
                                    <td> <a href="{{route('instructions.show', $instruction->id )}}" class="btn btn-primary btn-xs"> <i class="fas fa-search"></i> View Details</a></td>
                                  </tr>
                              @endforeach
                            </tbody>
                          </table>
                    </div>

                  </div>
                </div>


                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
          <!-- /.modal -->
        <div class="modal fade" id="modal-lg">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Edit Bank Details</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="{{route('banks.update', $bank->id )}}" method="post">
                  @csrf
                  @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label>Bank Name</label>
                              <input type="text" class="form-control" name="bank_name" placeholder="ABC Bank" value="{{$bank->bank_name}}">
                                @error('bank_name')
                                  <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label>Write Off Commission(%)</label>
                              <input type="number" class="form-control" name="write_off_commission" min="0" max="100" value="{{$bank->writeoff_comm}}">
                                @error('write_off_commission')
                                  <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label>Active Loan Commission(%)</label>
                              <input type="number" class="form-control" name="active_loan_commission" min="0" max="100" value="{{$bank->active_loan_comm}}">
                                @error('active_loan_commission')
                                  <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Bank Details</button>
                      </div>
                </form>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- /.modal -->

             <!-- /.Delete Modal -->
        <div class="modal fade" id="modal-del">
            <div class="modal-dialog modal-md">
              <div class="modal-content">
                <div class="modal-header bg-danger">
                  <h5 class="modal-title">Delete Bank Details</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="{{route('banks.update', $bank->id )}}" method="post">
                  @csrf
                  @method('DELETE')
                    <div class="modal-body">
                        <p>Are you sure you want to delete this bank? <br><br>
                        Note: If instructions exist you will be required to delete them first.</p>
                      </div>
                      <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Confirm Delete</button>
                      </div>
                </form>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- /.modal -->
        </div>
        <!-- /.container-fluid -->
      </section>
    <!-- /.content -->
  </div>
@endsection
