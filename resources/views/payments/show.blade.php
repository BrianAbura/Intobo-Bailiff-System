@extends('layouts/main_layout')
@section('title', 'Intobo Auctioneers | Instruction Details')
@section('content-wrapper')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Payment Details</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Payment Details</li>
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
            <div class="card" id="printInstruction">
              <!-- /.card-header -->
              <div class="card-header">
                <h3 class="card-title">Payment ID: <span class="text-primary">#{{$payment->instruction->id}}</span> </h3>
                </div>
              <div class="card-body">
                <div class="row">
                    <div class="col-sm-2">
                        <p class="text-md text-uppercase">Debtor Name
                            <b class="d-block text-primary">{{$payment->instruction->debtor_name}}</b>
                        </p>
                    </div>
                    <div class="col-sm-2">
                        <p class="text-md text-uppercase">Bank - Branch
                            <b class="d-block text-primary">{{$payment->instruction->bank->bank_name}} - {{$payment->instruction->branch}}</b>
                        </p>
                    </div>
                    <div class="col-sm-2">
                        <p class="text-md text-uppercase">Loan Balance
                            <b class="d-block text-primary">{{number_format($payment->loan_balance)}}</b>
                        </p>
                    </div>
                    <div class="col-sm-2">
                        <p class="text-md text-uppercase">Amount Paid
                            <b class="d-block text-primary">{{number_format($payment->amount)}}</b>
                        </p>
                    </div>
                    <div class="col-sm-2">
                        <p class="text-md text-uppercase">Commission Loan Blance
                            <b class="d-block text-primary">{{number_format($payment->commission_based_olb)}}</b>
                        </p>
                    </div>
                    <div class="col-sm-2">
                        <p class="text-md text-uppercase">Fees Loan Balance
                            <b class="d-block text-primary">{{number_format($payment->fees_based_olb)}}</b>
                        </p>
                    </div>
                </div>
                <hr style="border-top: 1px dashed blue;" class="col-sm-6">
                <div class="row">
                    <div class="col-sm-2">
                        <p class="text-md text-uppercase">Payment Date
                            <b class="d-block text-primary">{{date('d-M-Y', strtotime($payment->payment_date))}}</b>
                        </p>
                    </div>
                    <div class="col-sm-2">
                        <p class="text-uppercase">Payment Receipt <br>
                            <a href="{{asset($payment->payment_proof )}}" class="text-lowercase" target="_blank" alt=""><i class="fas fa-download"> View File</i></a>
                        </p>
                    </div>
                    <div class="col-sm-2">
                        <p class="text-md text-uppercase">Date Added
                            <b class="d-block text-primary">{{date('d-m-Y h:i', strtotime($payment->created_at))}}</b>
                        </p>
                    </div>
                    <div class="col-sm-2">
                        <p class="text-md">Added By
                            <b class="d-block text-primary">{{Auth::user($payment->user_id)->name}}</b>
                        </p>
                    </div>
                </div>
                <hr style="border-top: 1px dashed blue;" class="col-sm-6">
               @if (count($fees) > 0)
                    <div class="row">
                        <div class="col-sm-2">
                            <h4 class="title">Fees </h4>
                        </div>
                        <div class="col-sm-12">
                            <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Narration</th>
                                <th>Amount</th>
                                <th>Date Added</th>
                                <th>Reciept</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($fees as $fee)
                                <tr>
                                    <td>{{$fee->narration}}</td>
                                    <td>{{number_format($fee->amount)}}</td>
                                    <td>{{date('d-M-Y', strtotime($fee->pay_date))}}</td>
                                    <td>
                                        @if (!empty($fee->receipt))
                                        {
                                            <a href="{{asset($fee->receipt)}}" target="_blank" alt=""><i class="fas fa-download"> View File</i></a>
                                        }
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            </table>
                        </div>
                    </div>
               @endif
              </div>
              <!-- /.card-body -->
            </div>

            <div class="modal-footer">
                <button class="btn btn-warning text-white" title="Print" onclick="printDiv()"><i class="fas fa-print"></i> </button>
                {{-- <a href="{{route('instructions.edit', $instruction->id)}}" title="Edit"  class="btn btn-info"><i class="fas fa-edit"></i> </a> --}}
                <a href="#" title="Delete"  class="btn btn-danger"><i class="fas fa-trash"></i> </a>

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
<script>
    function printDiv() {
        // Get All elements not for print and hide them
        var file1 = document.getElementById('loanSecurityDiv');
        var file2 = document.getElementById('instructionFileDiv');
        file1.style.display = 'none';
        file2.style.display = 'none';

        var printContents = document.getElementById('printInstruction').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;

        //Restore Hident elements
        file1.style.display = 'block';
        file2.style.display = 'block';
    }
  </script>

