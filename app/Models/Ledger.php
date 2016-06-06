<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

}
