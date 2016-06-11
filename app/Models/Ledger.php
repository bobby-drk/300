<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ledger extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ledger';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['debtor', 'creditor', 'credit_type', 'amount'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    static function getLastPaid()
    {
        $array = [];
        $results = DB::table('ledger')
            ->select(DB::raw('creditor, MAX(created_at) as last_paid'))
            ->groupBy('creditor')
            ->get();


        foreach ($results as $i => $data) {
            $array[$data->creditor] = date('m-d-Y', strtotime($data->last_paid));
        }


        return $array;
    }


}
