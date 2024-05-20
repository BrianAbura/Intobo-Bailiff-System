@extends('layouts/main_layout')
@section('title', 'Intobo Auctioneers | Edit Demand Notice')
@section('content-wrapper')
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
<div class="container-fluid">
<div class="row mb-2">
<div class="col-sm-6">
<h4>Edit Demand Notice</h1>
</div>
<div class="col-sm-6">
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">Edit Demand Notice</li>
</ol>
</div>
</div>
</div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <form action="{{route('demand_notice.update', $notice->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
    <div class="row">
          {{-- Guarantor Details --}}
          <div class="col-md-12">
            <div class="card card-primary card-outline">
              <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <label>Debtor (Bank - Branch) - Loan Balance</label>
                        <input type="text" class="form-control" readonly name="debtor_details" autocomplete="off" value="{{$notice->instruction->debtor_name}} ({{$notice->instruction->bank->bank_name}} - {{$notice->instruction->branch}}) - {{number_format($notice->instruction->loan_balance)}}">
                    </div>
                    <div class="col-md-2">
                        <label>Start Date</label>
                        <input type="text" class="form-control datetimepicker-input" data-toggle="datetimepicker" name="start_date" autocomplete="off" value="{{$notice->start_date}}">
                        @error('start_date')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-2">
                        <label>End Date</label>
                        <input type="text" class="form-control datetimepicker-input" data-toggle="datetimepicker" name="end_date" autocomplete="off" value="{{$notice->end_date}}">
                        @error('end_date')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label>Demand Notice File
                            {
                                <a href="{{asset($notice->notice_file )}}" target="_blank" alt=""><i class="fas fa-download"> View File</i></a>
                            }
                        </label>
                        <input type="file" id="exampleInputFile" name="notice_file" value="{{$notice->notice_file}}">
                        @error('notice_file')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                   </div>
               <br/>
            </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
</div>
    <div class="modal-footer justify-content-between">
        <a href="{{route('demand_notice.index')}}" class="btn btn-danger">Cancel</a>
        <button type="submit" class="btn btn-success">Update Demand Notice</button>
    </div>
</form>
</section>
</div>
@endsection
