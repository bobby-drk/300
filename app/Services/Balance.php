<?php

namespace App\Services;

use App\Models\Ledger;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class Balance
{
    public function getBalanceSheet()
    {
        //pull all data out of ledger
            //add up all of the IOUs (OWE)
            //add up all of the UOMes (PAID)
            //divide PAID/OWE
            //debtor owes creditor


        //SUM where creditor = x AND debtor = y

/*
SELECT creditor, debtor, SUM(amount) as sum
FROM ledger
GROUP BY creditor, debtor
*/
        $ledger_data = DB::table('ledger')
            ->select(DB::raw('creditor, debtor, SUM(amount) as sum'))
            ->groupBy('creditor', 'debtor')
            ->get();

        // $users = new \Illuminate\Database\Eloquent\Collection;
        // reorg the array
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
                    $user->pay_ratio = ($ledger[$user->id]['paid']  / $ledger[$user->id]['mooched']) ;
                } else {
                    $user->pay_ratio = $ledger[$user->id]['paid'];
                }
            } else {

                $user->pay_ratio = 1;
            }
        }

echo "<pre>";
print_r($users);

        // foreach ($ledger as $creditor => $clients) {

        //     foreach ($users as $i => $user) {
        //         if (!isset($clients[$user->id]) && $user->id != $creditor) {
        //             $ledger[$creditor][$user->id] = 0;
        //         }
        //     }

        // }




// print_r($ledger);

//         $adjustments = [];
//         foreach($users as $creditor => $clients) {

//             foreach($clients as $debtor => $sum) {

//                 if(isset($users[$debtor][$creditor])) {
//                     $adjustments[$creditor][$debtor] = ($users[$creditor][$debtor] - $users[$debtor][$creditor]);
//                 }
//             }
//         }

// print_r($adjustments);

//         foreach($users as $creditor => $clients) {
//             foreach($clients as $debtor => $sum) {
//                 if (isset($adjustments[$creditor][$debtor] )) {
//                     $users[$creditor][$debtor] = $adjustments[$creditor][$debtor];
//                 }
//             }
//         }






            // if (!$users->contains('id', $row->creditor)) {

            //     echo "made " . $row->creditor . "<br />\n";

            //     $user = User::find($row->creditor);

                // $user->favors = new \Illuminate\Database\Eloquent\Collection;

                // if (!$users->contains('id', $row->creditor)) {


                // $users->add($user);
            // }







/*
down vote
accepted
It's not really Eloquent, it's:

$c = new \Illuminate\Database\Eloquent\Collection;
And then you can

$c->add(new Post);
*/


        // }
// print_r($users);
print_r($ledger_data);
echo "</pre>";
echo "print_r located in <a href='#' title= '" . __FILE__ . "'>file</a> on line " . __LINE__;
exit;



        //add the data into user groups
        //return
    }
}