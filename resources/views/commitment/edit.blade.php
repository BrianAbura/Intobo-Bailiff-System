@extends('layouts/main_layout')
@section('title', 'Intobo Auctioneers | Edit Commitment')
@section('content-wrapper')
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
<div class="container-fluid">
<div class="row mb-2">
<div class="col-sm-6">
<h4>Edit Commitment</h1>
</div>
<div class="col-sm-6">
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">Edit Commitment</li>
</ol>
</div>
</div>
</div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <form action="{{route('commitment.update', $commitment->id)}}" method="post" enctype="multipart/form-data">
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
                        <input type="text" class="form-control" readonly name="debtor_details" autocomplete="off" value="{{$commitment->instruction->debtor_name}} ({{$commitment->instruction->bank->bank_name}} - {{$commitment->instruction->branch}}) - {{number_format($commitment->instruction->loan_balance)}}">
                    </div>
                    <div class="col-md-4">
                        <label>Commitment Made</label>
                        <textarea name="commitment_made" id="commitment_made" rows="5" class="form-control">{{$commitment->description}} </textarea>
                        @error('commitment_made')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-2">
                        <label>Commitment Date</label>
                        <input type="text" class="form-control datetimepicker-input" data-toggle="datetimepicker" name="commitment_date" autocomplete="off" value="{{$commitment->commitment_date}}">
                        @error('commitment_date')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-2">
                        <label>Responsible Officer</label>
                        <input type="text" class="form-control" name="responsible_officer" autocomplete="off" value="{{$commitment->responsible_officer}}">
                        @error('responsible_officer')
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
        <a href="{{route('commitment.index')}}" class="btn btn-danger">Cancel</a>
        <button type="submit" class="btn btn-success">Update Commitment</button>
    </div>
</form>
</section>
</div>
@endsection
