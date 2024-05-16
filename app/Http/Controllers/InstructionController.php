<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Instruction;
use App\Models\Payments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class InstructionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $instructions = Instruction::with('bank')->get();
        return view('instructions.index', ['instructions' => $instructions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('instructions.create')->with('banks', Bank::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'bank_branch' => 'required',
            'debtor_name' => 'required',
            'debtor_account_number' => 'required',
            'debtor_phone_number' => 'required',
            'debtor_address' => 'required',
            'loan_amount' => 'required',
            'instruction_date' => 'required',
            'guarantor_name' => 'required',
            'guarantor_phone_number' => 'required',
            'responsible_officer' => 'required',
            'loan_security_file' => 'file|mimes:jpeg,png,pdf|max:2048',
            'instruction_file' => 'required|file|mimes:jpeg,png,pdf|max:2048'
        ]);

        if ($request->hasFile('instruction_file') && $request->file('instruction_file')->isValid())
        {
            $file = $request->file('instruction_file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);
            $instruction_file_uploaded = 'uploads/' . $fileName;
        }

        if ($request->hasFile('loan_security_file') && $request->file('loan_security_file')->isValid())
        {
            $file = $request->file('loan_security_file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);
            $loan_security_file_uploaded = 'uploads/' . $fileName;
        }

        $instruction = new Instruction();
        $instruction->bank_id = strip_tags($request->bank_id);
        $instruction->branch = strip_tags($request->bank_branch);
        $instruction->security_status = strip_tags($request->security_status);
        $instruction->loan_amount = str_replace(',','', $request->loan_amount);
        $instruction->loan_balance = str_replace(',','', $request->loan_amount); // Initially Loan Balance is loan Amount
        $instruction->loan_status = strip_tags($request->loan_status);
        $instruction->debtor_name = strip_tags($request->debtor_name);
        $instruction->debtor_acc_no = strip_tags($request->debtor_account_number);
        $instruction->debtor_tell = strip_tags($request->debtor_phone_number);
        $instruction->debtor_address = strip_tags($request->debtor_address);
        $instruction->guarantor_name = strip_tags($request->guarantor_name);
        $instruction->guarantor_tell = strip_tags($request->guarantor_phone_number);
        $instruction->instruction_date = Carbon::parse($request->instruction_date);
        $instruction->responsible_officer = strip_tags($request->responsible_officer);
        $instruction->loan_security_file = $loan_security_file_uploaded;
        $instruction->instruction_file = $instruction_file_uploaded;
        $instruction->user_id = Auth::user()->id;
        $instruction->save();

        return redirect()->route('instructions.index')->with('success', 'Bank Instruction was added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($instruction)
    {
        $instruction = Instruction::with('bank')->find($instruction);
        return view('instructions.show', ['instruction' => $instruction]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($instruction)
    {
        $instruction = Instruction::with('bank')->find($instruction);
        return view('instructions.edit', ['instruction' => $instruction, 'banks' => Bank::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $instruction)
    {

        $instruction = Instruction::find($instruction);

        // Check for any payments, if any then reject and user removes payments first
        $payments = Payments::where('instruction_id', $instruction->id);
        if($payments->exists())
        {
            return redirect()->route('instructions.show', $instruction->id)->with('error', 'Bank Instruction cannot be updated because it contains payment records. <br/> Delete Payment records and try again.');
        }

        $request->validate([
            'bank_branch' => 'required',
            'debtor_name' => 'required',
            'debtor_account_number' => 'required',
            'debtor_phone_number' => 'required',
            'debtor_address' => 'required',
            'loan_amount' => 'required',
            'instruction_date' => 'required',
            'guarantor_name' => 'required',
            'guarantor_phone_number' => 'required',
            'responsible_officer' => 'required',
            'loan_security_file' => 'file|mimes:jpeg,png,pdf|max:2048',
            'instruction_file' => 'file|mimes:jpeg,png,pdf|max:2048'
        ]);

        //Check Instruction File
        if ($request->hasFile('instruction_file') && $request->file('instruction_file')->isValid())
        {
            $file = $request->file('instruction_file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);
            $instruction_file_uploaded = 'uploads/' . $fileName;
        }
        else{
            $instruction_file_uploaded = $instruction->instruction_file;
        }

        //Check Loan Security File
        if ($request->hasFile('loan_security_file') && $request->file('loan_security_file')->isValid())
        {
            $file = $request->file('loan_security_file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);
            $loan_security_file_uploaded = 'uploads/' . $fileName;
        }
        else{
            $loan_security_file_uploaded = $instruction->loan_security_file;
        }

        // Save the information
        $instruction->bank_id = strip_tags($request->bank_id);
        $instruction->branch = strip_tags($request->bank_branch);
        $instruction->security_status = strip_tags($request->security_status);
        $instruction->loan_amount = str_replace(',','', $request->loan_amount);
        $instruction->loan_balance = str_replace(',','', $request->loan_amount); // On Update Loan Balance is loan Amount
        $instruction->loan_status = strip_tags($request->loan_status);
        $instruction->debtor_name = strip_tags($request->debtor_name);
        $instruction->debtor_acc_no = strip_tags($request->debtor_account_number);
        $instruction->debtor_tell = strip_tags($request->debtor_phone_number);
        $instruction->debtor_address = strip_tags($request->debtor_address);
        $instruction->guarantor_name = strip_tags($request->guarantor_name);
        $instruction->guarantor_tell = strip_tags($request->guarantor_phone_number);
        $instruction->instruction_date = Carbon::parse($request->instruction_date);
        $instruction->responsible_officer = strip_tags($request->responsible_officer);
        $instruction->loan_security_file = $loan_security_file_uploaded;
        $instruction->instruction_file = $instruction_file_uploaded;
        $instruction->user_id = Auth::user()->id;
        $instruction->save();

        return redirect()->route('instructions.show', $instruction->id)->with('success', 'Bank Instruction was added successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(instruction $instruction)
    {
        //
    }
}
