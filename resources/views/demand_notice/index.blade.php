@extends('layouts/main_layout')
@section('title', 'Intobo Auctioneers | Demand Notices')
@section('content-wrapper')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Demand Notices</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Demand Notices</li>
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
                <a href="{{route('demand_notice.create')}}" class="btn btn-primary btn-sm float-right">Add New Demand Notice</a>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Debtors Name</th>
                    <th>Bank</th>
                    <th>Loan Balance</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Demand Notice</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @php
                        use Carbon\Carbon;
                        $currentDate = Carbon::now();
                    @endphp
                    @foreach ($notices as $notice)
                        <tr>
                          <td> <a href="{{route('instructions.show', $notice->instruction->id)}}">{{$notice->instruction->debtor_name }}</a> </td>
                          <td> {{$notice->instruction->bank->bank_name.' - '.$notice->instruction->branch}} </td>
                          <td> {{number_format($notice->instruction->loan_balance)}} </td>
                          <td> {{date('d-m-Y', strtotime($notice->start_date))}} </td>
                          <td> {{date('d-m-Y', strtotime($notice->end_date))}} </td>
                          <td>
                            @if (!empty($notice->notice_file))
                                {
                            <a href="{{asset($notice->notice_file)}}" target="_blank" alt=""><i class="fas fa-download"> View File</i></a>
                                }
                            @endif
                          </td>

                          @if ($currentDate->greaterThan($notice->end_date))
                                <td class="text-danger text-uppercase text-bold">Expired</td>
                          @else
                                <td class="text-success text-uppercase text-bold">Running</td>
                          @endif

                          <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">
                                    <i class="fas fa-bars"></i>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                  <a class="dropdown-item" href="{{route('demand_notice.edit', $notice->id )}}">Edit</a>
                                  <a class="dropdown-item" href="" data-toggle="modal" data-target="#modal-del-{{$notice->id}}">Delete</a>
                                </div>
                              </div>
                          </td>
                        </tr>
                        <!-- /.Delete Modal -->
                        <div class="modal fade" id="modal-del-{{$notice->id}}">
                            <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header bg-danger">
                                <h5 class="modal-title">Delete Demand Notice</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <form action="{{route('demand_notice.destroy', $notice->id )}}" method="post">
                                @csrf
                                @method('DELETE')
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete the Demand Notice?</p>
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
