<?php

namespace App\Services;

use App\Models\Ledger;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use CustomHelpers;
use Illuminate\Support\Facades\Auth;

class Balance
{
    public function getUserBalanceRatio()
    {
        $ledger_data = DB::table('ledger')
            ->select(DB::raw('creditor, debtor, SUM(amount) as sum'))
            ->groupBy('creditor', 'debtor')
            ->get();

        $users = User::all();
        $ledger = [];
        foreach ($ledger_data as $i => $row) {

            //calculate how much you have paid
            if (isset($ledger[$row->creditor]['paid'] )) {
                $ledger[$row->creditor]['paid'] += $row->sum;
            } else {
                $ledger[$row->creditor]['paid'] = $row->sum;
            }

            //calculate how much you've spent
            if (isset($ledger[$row->debtor]['mooched'] )) {
                $ledger[$row->debtor]['mooched'] += $row->sum;
            } else {
                $ledger[$row->debtor]['mooched'] = $row->sum;
            }

        }

        foreach ($users as $i => $user) {

            if (isset($ledger[$user->id])) {

                if ($ledger[$user->id]['mooched'] > 0) {
                    //divide paid/mooched
                    $user->pay_ratio = round($ledger[$user->id]['paid']  / $ledger[$user->id]['mooched'], 3) ;
                } else {
                    $user->pay_ratio = $ledger[$user->id]['paid'];
                }
            } else {

                $user->pay_ratio = 1;
            }
        }

        return $users->sortBy("pay_ratio");
    }

    public function getMyBalance($me)
    {
        $balance = [];
        $users = User::where('id', '!=', Auth::id())->get();

        $rec_array = DB::table('ledger')
            ->select(DB::raw('debtor, SUM(amount) as sum'))
            ->where("creditor", $me)
            ->groupBy('debtor')
            ->get();

        $receivables = [];
        foreach ($rec_array as $i => $transaction) {
            $receivables[$transaction->debtor] = $transaction->sum;
        }

        $pay_array = DB::table('ledger')
            ->select(DB::raw('creditor, SUM(amount) as sum'))
            ->where("debtor", $me)
            ->groupBy('creditor')
            ->get();

        $payables = [];
        foreach ($pay_array as $i => $transaction) {
            $payables[$transaction->creditor] = $transaction->sum;
        }


        foreach($users as $i => $user) {

            if (isset($receivables[$user->id]) && isset($payables[$user->id])) {
                $user->balance = $receivables[$user->id] - $payables[$user->id];
            } else if (isset($receivables[$user->id]))  {
                $user->balance = $receivables[$user->id];
            } else if (isset($payables[$user->id]))  {
                $user->balance = 0 - $payables[$user->id];
            }
        }

        return $users;
    }

}