<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Services\Balance;
use App\Models\Ledger;
use App\Models\Score;


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
        
        $data['pr'] = Score::where('user_id', Auth::id())->max('score');

        return view('pages.dashboard', $data);
    }

}
