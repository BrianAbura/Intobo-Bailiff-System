@extends('layouts/main_layout')
@section('title', 'Intobo Auctioneers | Instructions')
@section('content-wrapper')
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
<div class="container-fluid">
<div class="row mb-2">
<div class="col-sm-6">
<h4>Edit Payment</h1>
</div>
<div class="col-sm-6">
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">Edit Payment</li>
</ol>
</div>
</div>
</div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <form action="{{route('payments.store')}}" method="post" enctype="multipart/form-data">
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
                        <option value="{{ $payment->instruction->id }}">{{$payment->instruction->debtor_name}} ({{$payment->instruction->bank->bank_name}} - {{$payment->instruction->branch}}) - {{number_format($payment->loan_balance)}} </option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label>Amount</label>
                    <input type="text" class="form-control InputAmount" name="amount" value="{{$payment->amount}}">
                    @error('amount')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-2">
                    <label>Payment Date</label>
                    <input type="text" class="form-control datetimepicker-input reservationdate" data-toggle="datetimepicker" name="payment_date" autocomplete="off" value="{{$payment->payment_date}}">
                    @error('payment_date')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label>Proof of Payment
                        {
                            <a href="{{asset($payment->payment_proof )}}" target="_blank" alt=""><i class="fas fa-download"> Proof of Payment</i></a>
                        }
                    </label>

                    <input type="file" id="exampleInputFile" name="proof_of_payment" value="{{$payment->payment_proof}}">
                    @error('proof_of_payment')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
               </div>
               <br/>
               <h4 class="title">Fees </h4>

               <hr>
               <button type="button"  class="btn btn-primary btn-xs float-right" id="addRow"> <i class="fas fa-plus"></i> Add more Fees</button>
               {{-- fees --}}
               <div id="fees-container">
                @foreach ($fees as $fee)
                <div class="form-row col-md-12 fees-row mt-5">
                    <div class="col-md-3">
                        <label>Fees Narration</label>
                        <input type="text" class="form-control" name="fee_narration[]" value="{{$fee->narration}}">
                    </div>
                    <div class="col-md-2">
                        <label>Fees Amount</label>
                        <input type="text" class="form-control InputAmount" name="fee_amount[]" value="{{$fee->amount}}">
                    </div>
                    <div class="col-md-2">
                        <label>Date Added</label>
                        <input type="text" class="form-control reservationdate" data-toggle="datetimepicker" name="fee_payment_date[]" autocomplete="off" value="{{$fee->pay_date}}">
                    </div>
                    <div class="col-md-2">
                        <label>Receipt
                            @if (!empty($fee->receipt))
                            {
                                <a href="{{asset($fee->receipt)}}" target="_blank" alt=""><i class="fas fa-download"> Receipt</i></a>
                            }
                            @endif

                        </label>
                        <input type="file" id="exampleInputFile" name="fee_receipt[]">
                    </div>
                </div>
                @endforeach
               </div>
               {{-- fees Container--}}
            </div>
              <!-- /.card-body -->

            </div>
            <!-- /.card -->
          </div>
</div>
    <div class="modal-footer justify-content-between">
        <a href="{{route('payments.index')}}" class="btn btn-danger">Cancel</a>
        <button type="submit" class="btn btn-success">Add Payment</button>
    </div>
</form>
</section>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{asset('dist/js/add_fees.js')}}"></script>
@endsection
