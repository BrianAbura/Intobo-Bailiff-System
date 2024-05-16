<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payments;
use App\Models\Fees;

class FeesController extends Controller
{
    public function index()
    {
        $fees = fees::all();
        return view('fees.index', ['fees' => $fees]);
    }
}
