<?php

namespace App\Http\Controllers;

use App\Models\DemandNotice;
use App\Models\Instruction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class DemandNoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notices = DemandNotice::all();
        return view("demand_notice.index", compact("notices"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $instructions = Instruction::with('bank')->get();
        return view('demand_notice.create', compact('instructions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'notice_file' => 'required|file|mimes:jpeg,png,pdf|max:2048',
        ]);

        //Save Debtors proof of Payment
        if ($request->hasFile('notice_file') && $request->file('notice_file')->isValid())
        {
            $file = $request->file('notice_file');
            $fileName = 'DemandNotice' . '_' . time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);
            $notice_file_uploaded = 'uploads/' . $fileName;
        }

        $notice = new DemandNotice();
        $notice->instruction_id = $request->debtor_details;
        $notice->notice_file = $notice_file_uploaded;
        $notice->start_date = Carbon::parse($request->start_date);
        $notice->end_date = Carbon::parse($request->end_date);
        $notice->user_id = Auth::user()->id;
        $notice->save();

        return redirect()->route('demand_notice.index')->with('success', 'Demand Notice has been added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(DemandNotice $demandNotice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($demandNotice)
    {
        $notice = DemandNotice::with('instruction')->find($demandNotice);
        return view('demand_notice.edit', ['notice'=> $notice]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $demandNotice)
    {
        $notice = DemandNotice::findOrFail($demandNotice);

        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'notice_file' => 'file|mimes:jpeg,png,pdf|max:2048',
        ]);

        //Save Debtors proof of Payment
        if ($request->hasFile('notice_file') && $request->file('notice_file')->isValid())
        {
            $file = $request->file('notice_file');
            $fileName = 'DemandNotice' . '_' . time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);
            $notice_file_uploaded = 'uploads/' . $fileName;

            //Add the file is available
            $notice->notice_file = $notice_file_uploaded;
        }

        $notice->start_date = Carbon::parse($request->start_date);
        $notice->end_date = Carbon::parse($request->end_date);
        $notice->save();

        return redirect()->route('demand_notice.index')->with('success', 'Demand Notice has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($demandNotice)
    {

        $notice = DemandNotice::findOrFail($demandNotice);
        $file = public_path($notice->notice_file);
        if(File::exists($file))
        {
            File::delete($file);
        }
        $notice->delete();
        return redirect()->route('demand_notice.index')->with('success', 'Demand Notice and associated file has been deleted successfully.');
    }
}
