<?php

namespace App\Http\Controllers;

use App\Services\Balance;

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

        $balance_sheet = $balance->getBalanceSheet();

        return view('pages.dashboard', $data);
    }

}
