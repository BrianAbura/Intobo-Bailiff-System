<?php

namespace App\Http\Controllers;

use App\Models\Commitment;
use App\Models\Instruction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CommitmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $commitments = Commitment::with('instruction')->get();
        return view('commitment.index', ['commitments' => $commitments]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $instructions = Instruction::with('bank')->get();
        return view('commitment.create', compact('instructions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'commitment_made' => 'required',
            'commitment_date' => 'required|date',
            'responsible_officer' => 'required',
        ]);

        $commitment = new Commitment();
        $commitment->instruction_id = $request->debtor_details;
        $commitment->description = $request->commitment_made;
        $commitment->commitment_date = Carbon::parse($request->commitment_date);
        $commitment->responsible_officer = $request->responsible_officer;
        $commitment->user_id = Auth::user()->id;
        $commitment->save();

        return redirect()->route('commitment.index')->with('success', 'Commitment has been added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Commitment $commitment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($commitment_id)
    {
        $commitment = Commitment::with('instruction')->find($commitment_id);
        return view('commitment.edit', ['commitment' => $commitment]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $commitment_id)
    {
        $request->validate([
            'commitment_made' => 'required',
            'commitment_date' => 'required|date',
            'responsible_officer' => 'required',
        ]);

        $commitment = Commitment::findOrFail($commitment_id);
        $commitment->description = $request->commitment_made;
        $commitment->commitment_date = Carbon::parse($request->commitment_date);
        $commitment->responsible_officer = $request->responsible_officer;
        $commitment->save();

        return redirect()->route('commitment.index')->with('success', 'Commitment has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commitment $commitment)
    {
        //
    }
}
