<?php

namespace App\Http\Controllers;

use App\Models\Payments;
use App\Models\Instruction;
use App\Models\Fees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payments::with('instruction')->get();
        return view('payments.index', ['payments' => $payments]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $instructions = instruction::with('bank')->get();
        return view('payments.create', compact('instructions') );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $instruction = Instruction::with('bank')->find($request->debtor_details);

        $request->validate([
            'debtor_details' => 'required',
            'amount' => 'required',
            'payment_date' => 'required|date',
            'proof_of_payment' => 'required|file|mimes:jpeg,png,pdf|max:2048',
            'fee_receipt.*' => 'file|mimes:jpeg,png,pdf|max:2048'
        ]);
        $payment_amount = str_replace(',','', $request->amount);

        // Check if amount paid is greater then the loan Balance
        if($payment_amount > $instruction->loan_balance)
        {
            return back()->with('error', 'The amount paid is greater than the current loan balance.');
        }

        //Save Debtors proof of Payment
        if ($request->hasFile('proof_of_payment') && $request->file('proof_of_payment')->isValid())
        {
            $file = $request->file('proof_of_payment');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);
            $payment_file_uploaded = 'uploads/' . $fileName;
        }

        //Calculate commission_based_olb
        $loan_balance = $instruction->loan_balance - $payment_amount;
        if ($instruction->loan_status == "write_off") {
            $commission_based_olb = $loan_balance + ($payment_amount * ($instruction->bank->writeoff_comm/100));
        }
        else {
            $commission_based_olb = $loan_balance + ($payment_amount * ($instruction->bank->active_loan_comm/100));
        }

        // Add the payment
        $payment = new Payments();
        $payment->instruction_id = strip_tags($request->debtor_details);
        $payment->loan_balance = $loan_balance;
        $payment->amount = strip_tags($payment_amount);
        $payment->commission_based_olb = $commission_based_olb;
        $payment->payment_proof = $payment_file_uploaded;
        $payment->payment_date = Carbon::parse($request->instruction_date);
        $payment->user_id = Auth::user()->id;
        $payment->save();
        $payment_id = $payment->id;

        // Update loan balance of instruction
        $instruction->loan_balance = $loan_balance;
        $instruction->save();

        //Check for fees including the dynamically added rows
        $feeNarration = $request->input('fee_narration');
        $feeAmount = $request->input('fee_amount');
        $feeDate = $request->input('fee_payment_date');
        $feeReceipt = [];
        $sumFees = 0;
        $fees_based_olb = 0;

         // Upload Fees Receipts if present
         if ($request->hasFile('fee_receipt'))
         {
            foreach($request->file('fee_receipt') as $file)
            {
            $receiptfileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $receiptfileName);
            $receipt_file_uploaded = 'uploads/' . $receiptfileName;
            array_push($feeReceipt, $receipt_file_uploaded);
            }
         }

        //  Iterate the fees
        foreach($feeNarration as $key => $fee_narration)
        {
            $fee_amount = str_replace(',','', $feeAmount[$key]);
            $fee_payment_date = Carbon::parse($feeDate[$key]);

            if(!empty($fee_amount) && !empty($fee_narration) && !empty($fee_payment_date))
            {
                $sumFees += $fee_amount;
                $fee_receipt = $feeReceipt[$key];

                // Add the fees
                $fees = new Fees();
                $fees->instruction_id = $request->debtor_details;
                $fees->payments_id = $payment_id;
                $fees->amount = $fee_amount;
                $fees->narration = $fee_narration;
                $fees->pay_date = $fee_payment_date;
                $fees->receipt = $fee_receipt;
                $fees->save();

                 //Calculate fees_based_olb
                if ($instruction->loan_status == "write_off") {
                    $fees_based_olb = $loan_balance + ($payment_amount * ($instruction->bank->writeoff_comm/100)) + $sumFees;
                }
                else {
                    $fees_based_olb = $loan_balance + ($payment_amount * ($instruction->bank->active_loan_comm/100)) + $sumFees;
                }
            }
        }

        // Update Payments table
        $payment_update = Payments::findOrFail($payment_id);
        $payment_update->fees_based_olb =$fees_based_olb;
        $payment_update->save();

        return redirect()->route('payments.index')->with('success', 'Payment has been added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($payment_id)
    {
        $payment = Payments::with('instruction')->find($payment_id);
        $fees = Fees::where('payments_id', $payment_id)->get();
        return view('payments.show', ['payment' => $payment, 'fees' => $fees]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($payment_id)
    {
        $payment = Payments::with('instruction')->find($payment_id);
        $fees = Fees::where('payments_id', $payment_id)->get();
        return view('payments.edit', ['payment' => $payment, 'fees' => $fees]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payments $payments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payments $payments)
    {
        //
    }
}
