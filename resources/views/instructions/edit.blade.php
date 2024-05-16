@extends('layouts/main_layout')
@section('title', 'Intobo Auctioneers | Edit Instruction Details')
@section('content-wrapper')
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
<div class="container-fluid">
<div class="row mb-2">
    <div class="col-sm-6">
    <h4>Edit Instruction Details</h4>
    </div>
    <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Edit Instruction Details</li>
    </ol>
    </div>
</div>
</div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
<form action="{{route('instructions.update', $instruction->id )}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
<div class="row">
    {{-- Bank Details --}}
    <div class="col-md-4">
        <div class="card card-primary">
            <div class="card-header">
            <h3 class="card-title">Bank Details</h3>
            </div>
            <div class="card-body">
            <div class="form-group">
                <label>Bank Name</label>
                <select class="form-control select2" name="bank_id" required>
                    <option value="{{ $instruction->bank->id }}">{{$instruction->bank->bank_name}}</option>
                    @foreach ($banks as $bank)
                    @if ($instruction->bank->id == $bank->id)
                        @continue
                    @endif

                    <option value="{{ $bank->id }}">{{$bank->bank_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Bank Branch</label>
                <input type="text" class="form-control" name="bank_branch" value="{{$instruction->branch}}" placeholder="Bank Branch">
                @error('bank_branch')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label>Security Status</label>
                <select class="form-control" name="security_status" required>
                    <option value="{{ $instruction->security_status }}">{{$instruction->security_status}}</option>
                    <option value="secured">Secured</option>
                    <option value="non-secured">Non-Secured</option>
                </select>
            </div>
            <div class="form-group">
                <label>Loan Amount</label>
                <input type="text" class="form-control InputAmount" name="loan_amount" value="{{number_format($instruction->loan_amount)}}" placeholder="Loan Amount">
                @error('loan_amount')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label>Loan Status</label>
                <select class="form-control" name="loan_status" required>
                    <option value="{{ $instruction->loan_status }}">{{$instruction->loan_status}}</option>
                    <option value="active_loan">Active Loan</option>
                    <option value="write_off">Write Off</option>
                </select>
            </div>
            <div class="form-group">
                <label>Date of Instruction</label>
                <div class="input-group date" >
                    <input type="text" id="reservationdate" class="form-control datetimepicker-input" data-target="#reservationdate" data-toggle="datetimepicker" name="instruction_date" value="{{$instruction->instruction_date}}"/>

                    @error('instruction_date')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        </div>

        {{-- Debtor Details --}}
        <div class="col-md-4">
        <div class="card card-info">
            <div class="card-header">
            <h3 class="card-title">Debtor Details</h3>
            </div>
            <div class="card-body">
            <div class="form-group">
                <label>Debtor Fullname</label>
                <input type="text" class="form-control" name="debtor_name" value="{{$instruction->debtor_name}}" placeholder="Debtors Name">
                @error('debtor_name')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label>Debtor Account Number</label>
                <input type="text" class="form-control" name="debtor_account_number" value="{{$instruction->debtor_acc_no}}" placeholder="Debtors Account Number">
                @error('debtor_account_number')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label>Debtor Phone Number</label>
                <input type="text" class="form-control" name="debtor_phone_number" value="{{$instruction->debtor_tell}}" placeholder="Debtors Phone Number">
                @error('debtor_phone_number')
                    <div class="form-text text-danger">{{ $message }}</div>
            @enderror
            </div>
            <div class="form-group">
                <label>Debtor Address</label>
                <textarea class="form-control" rows="3" placeholder="Enter Address" name="debtor_address"> {{$instruction->debtor_address}} </textarea>
                @error('debtor_address')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        </div>

        {{-- Guarantor Details --}}
        <div class="col-md-4">
        <div class="card card-secondary">
            <div class="card-header">
            <h3 class="card-title">Guarantor Details</h3>
            </div>
            <div class="card-body">
            <div class="form-group">
                <label>Guarantor Fullname</label>
                <input type="text" class="form-control" name="guarantor_name" value="{{$instruction->guarantor_name}}">
                @error('guarantor_name')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label>Guarantor Phone Number</label>
                <input type="text" class="form-control" name="guarantor_phone_number" value="{{$instruction->guarantor_tell}}">
                @error('guarantor_phone_number')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
            <!-- /.card-body -->
        </div>

        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Attachments</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Loan Security File</label>
                    {
                    <a href="{{asset($instruction->loan_security_file )}}" target="_blank" alt=""><i class="fas fa-download"> Loan Security</i></a>
                    }

                    <input type="file" name="loan_security_file" value="{{$instruction->loan_security_file}}">
                    @error('loan_security_file')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Instruction File</label>
                    {
                     <a href="{{asset($instruction->instruction_file )}}" target="_blank" alt=""><i class="fas fa-download"> Bank Instruction</i></a>
                    }
                    <input type="file" name="instruction_file" value="{{$instruction->instruction_file}}">
                    @error('instruction_file')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Responsible Officer</label>
                    <input type="text" class="form-control" name="responsible_officer" value="{{$instruction->responsible_officer}}">
                    @error('responsible_officer')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <!-- /.card-body -->
            </div>
        <!-- /.card -->
        </div>
</div>
<div class="modal-footer justify-content-between">
    <a href="{{route('instructions.show', $instruction->id)}}" class="btn btn-danger">Cancel</a>
    <button type="submit" class="btn btn-success">Update Instruction</button>
</div>
</form>
</section>
<!-- /.content -->
</div>
@endsection

