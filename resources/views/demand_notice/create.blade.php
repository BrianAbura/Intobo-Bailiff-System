@extends('layouts/main_layout')
@section('title', 'Intobo Auctioneers | Add Demand Notice')
@section('content-wrapper')
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
<div class="container-fluid">
<div class="row mb-2">
<div class="col-sm-6">
<h4>Add New Demand Notice</h1>
</div>
<div class="col-sm-6">
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">Add Demand Notice</li>
</ol>
</div>
</div>
</div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <form action="{{route('demand_notice.store')}}" method="post" enctype="multipart/form-data">
        @csrf
    <div class="row">
          {{-- Guarantor Details --}}
          <div class="col-md-12">
            <div class="card card-primary card-outline">
              <div class="card-body">
               <div class="row">
                <div class="col-md-4">
                    <label>Debtor (Bank - Branch) - Loan Balance</label>
                    <select class="form-control select2" name="debtor_details" required>
                        <option></option>
                        @foreach ($instructions as $instruction)
                        <option value="{{ $instruction->id }}">{{$instruction->debtor_name}} ({{$instruction->bank->bank_name}} - {{$instruction->branch}}) - {{number_format($instruction->loan_balance)}} </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label>Start Date</label>
                    <input type="text" class="form-control reservationdate" data-toggle="datetimepicker" name="start_date" autocomplete="off">
                    @error('start_date')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-2">
                    <label>End Date</label>
                    <input type="text" class="form-control reservationdate" data-toggle="datetimepicker" name="end_date" autocomplete="off">
                    @error('end_date')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-2">
                    <label>Demand Notice File</label>
                    <input type="file" id="exampleInputFile" name="notice_file">
                    @error('notice_file')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
               </div>
               <br>
            </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
    </div>
    <div class="modal-footer justify-content-between">
        <a href="{{route('demand_notice.index')}}" class="btn btn-danger">Cancel</a>
        <button type="submit" class="btn btn-success">Add Demand Notice</button>
    </div>
</form>
</section>
</div>
@endsection
