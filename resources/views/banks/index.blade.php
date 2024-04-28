@extends('layouts/main_layout')
@section('title', 'Intobo Auctioneers | Banks')
@section('content-wrapper')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Banks</h1>
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
                <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#modal-lg">
                    Add New Bank
                  </button>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Bank Name</th>
                    <th>Write off Commission(%)</th>
                    <th>Active Loan Commission(%)</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($banks as $bank)
                        <tr>
                          <td class="text-uppercase"> {{$bank->bank_name}} </td>
                          <td> {{$bank->writeoff_comm}} </td>
                          <td> {{$bank->active_loan_comm}} </td>
                          <td> <a href="#" class="btn btn-primary btn-sm"> <i class="fas fa-pen"></i> Edit</a></td>
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
        <!-- /.modal -->
        <div class="modal fade" id="modal-lg">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Add New Bank</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="{{route('banks.store')}}" method="post">
                  @csrf
                    <div class="modal-body">
                        <div class="row">
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label>Bank Name</label>
                              <input type="text" class="form-control" name="bank_name" placeholder="ABC Bank" value="{{old('bank_name')}}">
                                @error('bank_name')
                                  <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label>Write Off Commission(%)</label>
                              <input type="number" class="form-control" name="write_off_commission" min="0" max="100" value="{{old('write_off_commission')}}">
                                @error('write_off_commission')
                                  <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label>Active Loan Commission(%)</label>
                              <input type="number" class="form-control" name="active_loan_commission" min="0" max="100" value="{{old('active_loan_commission')}}">
                                @error('active_loan_commission')
                                  <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
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
