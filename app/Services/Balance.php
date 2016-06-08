<?php

namespace App\Services;

use App\Models\Ledger;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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

        return $users->pluck('pay_ratio', 'first_name')->sort();
    }
}