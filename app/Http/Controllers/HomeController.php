<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $banks = Bank::count();
        return view('home', ['bank_count' => $banks]);
    }
}
