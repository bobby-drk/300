<?php

namespace App\Http\Controllers;

use App\Services\Balance;
use App\Models\Ledger;

class CommonController extends Controller
{
    /**
     * shows the initial page for the pay section of the site
     * @return view
     */
    public function index()
    {
        $data = [];
        return view('pages.home', $data);
    }

    public function dashboard()
    {
        $data = [];

        $balance = new Balance();
        $data['balance_ratio'] = $balance->getUserBalanceRatio();

        $data['paid_dates'] = Ledger::getLastPaid();

        return view('pages.dashboard', $data);
    }

}
