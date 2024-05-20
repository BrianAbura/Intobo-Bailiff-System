<?php

namespace App\Http\Controllers;

use App\Models\Adverts;
use App\Models\Instruction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;


class AdvertsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $adverts = Adverts::all();
        return view('adverts.index', compact("adverts"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $instructions = Instruction::with('bank')->get();
        return view('adverts.create', compact('instructions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'security_details' => 'required',
            'advertised_date' => 'required|date',
            'expiry_date' => 'required|date',
            'advert_file' => 'required|file|mimes:jpeg,png,pdf|max:2048',
        ]);

        //Save Debtors proof of Payment
        if ($request->hasFile('advert_file') && $request->file('advert_file')->isValid())
        {
            $file = $request->file('advert_file');
            $fileName = 'AdvertFile' . '_' . time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);
            $advert_file_uploaded = 'uploads/' . $fileName;
        }

        $advert = new Adverts();
        $advert->instruction_id = $request->debtor_details;
        $advert->security_details = $request->security_details;
        $advert->advert_file = $advert_file_uploaded;
        $advert->advertised_date = Carbon::parse($request->advertised_date);
        $advert->expiry_date = Carbon::parse($request->expiry_date);
        $advert->user_id = Auth::user()->id;
        $advert->save();

        return redirect()->route('adverts.index')->with('success', 'The Advert has been added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Adverts $adverts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($adverts)
    {
        $advert = Adverts::with('instruction')->find($adverts);
        return view('adverts.edit', ['advert'=> $advert]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $adverts)
    {
        $advert = Adverts::findOrFail($adverts);

        $request->validate([
            'security_details' => 'required',
            'advertised_date' => 'required|date',
            'expiry_date' => 'required|date',
            'advert_file' => 'file|mimes:jpeg,png,pdf|max:2048'
        ]);

        //Save Debtors proof of Payment
        if ($request->hasFile('advert_file') && $request->file('advert_file')->isValid())
        {
            $file = $request->file('advert_file');
            $fileName = 'Demandadvert' . '_' . time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);
            $advert_file_uploaded = 'uploads/' . $fileName;

            //Add the file is available
            $advert->advert_file = $advert_file_uploaded;
        }

        $advert->security_details = $request->security_details;
        $advert->advertised_date = Carbon::parse($request->advertised_date);
        $advert->expiry_date = Carbon::parse($request->expiry_date);
        $advert->save();

        return redirect()->route('adverts.index')->with('success', 'The advert has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($adverts)
    {
        $advert = Adverts::findOrFail($adverts);
        $file = public_path($advert->advert_file);
        if(File::exists($file))
        {
            File::delete($file);
        }
        $advert->delete();
        return redirect()->route('adverts.index')->with('success', 'The advert and associated file has been deleted successfully.');
    }
}
