<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Instruction;
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

        $instructions = instruction::with('bank')->get();
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
        $instruction->branch = $request->bank_branch;
        $instruction->security_status = $request->security_status;
        $instruction->loan_amount = str_replace(',','', $request->loan_amount);
        $instruction->loan_status = $request->loan_status;
        $instruction->debtor_name = $request->debtor_name;
        $instruction->debtor_acc_no = $request->debtor_account_number;
        $instruction->debtor_tell = $request->debtor_phone_number;
        $instruction->debtor_address = $request->debtor_address;
        $instruction->guarantor_name = $request->guarantor_name;
        $instruction->guarantor_tell = $request->guarantor_phone_number;
        $instruction->instruction_date = Carbon::parse($request->instruction_date);
        $instruction->responsible_officer = $request->responsible_officer;
        $instruction->loan_security_file = $loan_security_file_uploaded;
        $instruction->instruction_file = $instruction_file_uploaded;
        $instruction->user_id = Auth::user()->id;
        $instruction->save();

        return redirect()->route('instructions.index')->with('success', 'Bank Instruction was added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(instruction $instruction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(instruction $instruction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, instruction $instruction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(instruction $instruction)
    {
        //
    }
}
