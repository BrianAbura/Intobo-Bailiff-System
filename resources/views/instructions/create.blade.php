@extends('layouts/main_layout')
@section('title', 'Intobo Auctioneers | Instructions')
@section('content-wrapper')
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
<div class="container-fluid">
<div class="row mb-2">
<div class="col-sm-6">
<h4>Create New Instruction</h1>
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
    <div class="card-body">
    <form action="{{route('instructions.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                <label>Bank Name</label>
                <select class="form-control select2" name="bank_id" required>
                    <option></option>
                    @foreach ($banks as $bank)
                    <option value="{{ $bank->id }}">{{$bank->bank_name}}</option>
                    @endforeach
                </select>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                <label>Bank Branch</label>
                <input type="text" class="form-control" name="bank_branch" value="{{old('bank_branch')}}" placeholder="Bank Branch">
                @error('bank_branch')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                <label>Security Status</label>
                <select class="form-control" name="security_status" required>
                    <option ></option>
                    <option value="secured">Secured</option>
                    <option value="non-secured">Non-Secured</option>
                </select>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                <label>Loan Amount</label>
                <input type="text" class="form-control InputAmount" name="loan_amount" value="{{old('loan_amount')}}" placeholder="Loan Amount">
                @error('loan_amount')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                <label>Loan Status</label>
                <select class="form-control" name="loan_status" required>
                    <option ></option>
                    <option value="active_loan">Active Loan</option>
                    <option value="write_off">Write Off</option>
                </select>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                <label>Debtors Fullname</label>
                <input type="text" class="form-control" name="debtor_name" value="{{old('debtor_name')}}" placeholder="Debtors Name">
                @error('debtor_name')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                <label>Debtors Account Number</label>
                <input type="text" class="form-control" name="debtor_account_number" value="{{old('debtor_account_number')}}" placeholder="Debtors Account Number">
                @error('debtor_account_number')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                <label>Debtor Phone Number</label>
                <input type="text" class="form-control" name="debtor_phone_number" value="{{old('debtor_phone_number')}}" placeholder="Debtors Phone Number">
                @error('debtor_phone_number')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                <label>Debtor Address</label>
                <textarea class="form-control" rows="3" placeholder="Enter Address" name="debtor_address" value="{{old('debtor_address')}}"></textarea>
                @error('debtor_address')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                <label>Date of Instruction</label>
                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" name="instruction_date"/>
                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                    @error('instruction_date')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                <label>Guarantors Fullname</label>
                <input type="text" class="form-control" name="guarantor_name" value="{{old('guarantor_name')}}">
                @error('guarantor_name')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                <label>Guarantors Phone Number</label>
                <input type="text" class="form-control" name="guarantor_phone_number" value="{{old('guarantor_phone_number')}}">
                @error('guarantor_phone_number')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                <label>Loan Security File</label>
                <input type="file" id="exampleInputFile" name="loan_security_file">
                @error('loan_security_file')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                <label>Instruction File Upload</label>
                <input type="file" id="exampleInputFile" name="instruction_file">
                @error('instruction_file')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                <label>Responsible Officer</label>
                <input type="text" class="form-control" name="responsible_officer" value="{{old('responsible_officer')}}">
                @error('responsible_officer')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
            <a href="{{route('instructions.index')}}" class="btn btn-danger btn-sm">Cancel</a>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
    </form>
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
