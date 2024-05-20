<?php

namespace App\Http\Controllers;

use App\Models\Adverts;
use App\Models\Bank;
use App\Models\Commitment;
use App\Models\DemandNotice;
use App\Models\Payments;
use App\Models\Fees;
use App\Models\Instruction;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $banks = Bank::count();
        $payments = Payments::count();
        $fees = Fees::count();
        $instructions = Instruction::count();
        $commitments = Commitment::count();
        $demand_notices = DemandNotice::count();
        $adverts = Adverts::count();

        return view('home',
            ['bank_cnt' => $banks,
            'payment_cnt'=> $payments,
            'fees_cnt' => $fees,
            'instuction_cnt' => $instructions,
            'commitment_cnt' => $commitments,
            'demandNotice_cnt' => $demand_notices,
            'adverts_cnt' => $adverts]);
}
}
