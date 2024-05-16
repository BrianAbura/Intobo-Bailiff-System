@extends('layouts/main_layout')
@section('title', 'Intobo Auctioneers | Instruction Details')
@section('content-wrapper')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Instruction Details</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Instruction Details</li>
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
                <h3 class="card-title">Instruction ID: <span class="text-primary">#{{$instruction->id}}</span> </h3>
                <h3 class="card-title float-right">Responsible Officer: <span class="text-primary">{{$instruction->responsible_officer}}</span></h3>
              </div>
              <div class="card-body">
                <div class="row">
                    <div class="col-sm-2">
                        <p class="text-md text-uppercase">Bank Name
                            <b class="d-block text-primary">{{$instruction->bank->bank_name}}</b>
                        </p>
                    </div>
                    <div class="col-sm-2">
                        <p class="text-md text-uppercase">Bank Branch
                            <b class="d-block text-primary">{{$instruction->branch}}</b>
                        </p>
                    </div>
                    <div class="col-sm-2">
                        <p class="text-md text-uppercase">Security Status
                            <b class="d-block text-primary">{{$instruction->security_status}}</b>
                        </p>
                    </div>
                    <div class="col-sm-2">
                        <p class="text-md text-uppercase">Loan Amount
                            <b class="d-block text-primary">{{number_format($instruction->loan_amount)}}</b>
                        </p>
                    </div>
                    <div class="col-sm-2">
                        <p class="text-md text-uppercase">Loan Status
                            <b class="d-block text-primary">{{$instruction->loan_status}}</b>
                        </p>
                    </div>
                    <div class="col-sm-2">
                        <p class="text-md text-uppercase">Date of Instruction
                            <b class="d-block text-primary">{{date('d-m-Y', strtotime($instruction->instruction_date))}}</b>
                        </p>
                    </div>
                </div>
                <hr style="border-top: 1px dashed blue;" class="col-sm-6">
                <div class="row">
                    <div class="col-sm-2">
                        <p class="text-md text-uppercase">Debtor Name
                            <b class="d-block text-primary">{{$instruction->debtor_name}}</b>
                        </p>
                    </div>
                    <div class="col-sm-2">
                        <p class="text-md text-uppercase">Debtor Account Number
                            <b class="d-block text-primary">{{$instruction->debtor_acc_no}}</b>
                        </p>
                    </div>
                    <div class="col-sm-2">
                        <p class="text-md text-uppercase">Debtor Phone Number
                            <b class="d-block text-primary">{{$instruction->debtor_tell}}</b>
                        </p>
                    </div>
                    <div class="col-sm-2">
                        <p class="text-md text-uppercase">Debtor Address
                            <b class="d-block text-primary">{{$instruction->debtor_address}}</b>
                        </p>
                    </div>
                </div>
                <hr style="border-top: 1px dashed blue;" class="col-sm-6">
                <div class="row">
                    <div class="col-sm-2">
                        <p class="text-md text-uppercase">Guarantor Name
                            <b class="d-block text-primary">{{$instruction->guarantor_name}}</b>
                        </p>
                    </div>
                    <div class="col-sm-2">
                        <p class="text-md text-uppercase">Guarantor Phone Number
                            <b class="d-block text-primary">{{$instruction->guarantor_tell}}</b>
                        </p>
                    </div>
                    <div class="col-sm-2" id="loanSecurityDiv">
                        <p class="text-md text-uppercase">Loan Security File
                            <a href="{{asset($instruction->loan_security_file )}}" target="_blank" alt=""><i class="fas fa-download"> Loan Security</i></a>
                        </p>
                    </div>
                    <div class="col-sm-2" id="instructionFileDiv">
                        <p class="text-md text-uppercase">Instruction Document File
                            <a href="{{asset($instruction->instruction_file )}}" target="_blank" alt=""><i class="fas fa-download"> Bank Instruction</i></a>
                        </p>
                    </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>

            <div class="modal-footer">
                <button class="btn btn-warning text-white" title="Print" onclick="printDiv()"><i class="fas fa-print"></i> </button>
                <a href="{{route('instructions.edit', $instruction->id)}}" title="Edit"  class="btn btn-info"><i class="fas fa-edit"></i> </a>
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

