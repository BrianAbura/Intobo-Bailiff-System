<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Instruction;
use Illuminate\Http\Request;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('banks.index')->with('banks', Bank::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $request->validate(
                [
                    'bank_name' => 'required',
                    'write_off_commission' => 'required',
                    'active_loan_commission' => 'required',
                ]
            );

            $query = Bank::where('bank_name', 'like', '%' . $request->bank_name . '%')->get();

            if ($query->isEmpty()) {
                $bank = new Bank();
                $bank->bank_name = strip_tags($request->bank_name);
                $bank->writeoff_comm = strip_tags($request->write_off_commission);
                $bank->active_loan_comm = strip_tags($request->active_loan_commission);
                $bank->save();
                return back()->with('success', $request->bank_name.' was added successfully.');
            }
            else {
                return back()->with('error', $request->bank_name.' is already registered.');
            }

    }

    /**
     * Display the specified resource.
     */
    public function show($bank)
    {
        $bank = Bank::find($bank);
        $instructions = Instruction::where('bank_id', $bank->id)->get();
        return view('banks.show', ['bank' => $bank, 'instructions' => $instructions]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bank $bank)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $request->validate(
            [
                'bank_name' => 'required|unique:banks,bank_name,'. $id,
                'write_off_commission' => 'required',
                'active_loan_commission' => 'required',
            ]
        );
        $bank = Bank::findOrFail($id);

        $query = Bank::where('bank_name', 'like', '%' . $request->bank_name . '%')->get();
        foreach($query as $item){
            if ($item->id == $bank->id) {
                $bank->bank_name = strip_tags($request->bank_name);
                $bank->writeoff_comm = strip_tags($request->write_off_commission);
                $bank->active_loan_comm = strip_tags($request->active_loan_commission);
                $bank->save();
                return back()->with('success', $request->bank_name.' has been updated successfully.');
            }
            else{
                return back()->with('error', $request->bank_name.' is already registered.');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Check for existing instructions
        $bank = Bank::find($id);
        $instructions = Instruction::where('bank_id', $bank->id)->get();
        if ($instructions->isEmpty()) {
            Bank::destroy($id);
            return redirect()->route('banks.index')->with('success', $bank->bank_name.' has been deleted .');       }
        else{
            return back()->with('error', $bank->bank_name.' cannot be deleted because it has existing instructions. <br/> <br/>Delete linked instructions and try again.');
        }
    }
}
