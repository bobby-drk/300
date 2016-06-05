<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Models\Ledger;

class PayApiController extends ApiController
{
    /**
     * shows the record bowling page
     * @return view
     */
    public function record(Request $request)
    {
        // validate
         $validator = Validator::make($request->all(), [
            'debtor' => 'required|exists:users,id',
            'credit_type' => 'required|in:food,bowling',
            'amount' => 'required|numeric',
         ], [
            "debtor.required" => "Please select at least one participate",
            "debtor.exists" => "Internal Error: 3965",
            "credit_type.required" => "Internal Error: 9845",
            "credit_type.in" => "Internal Error: 8873",
         ]);

        if ($validator->fails()) {
            return $this->responseBadRequest("Bad Request", $validator->messages());
        }

        $user           = Auth::user();
        $debtors        = Input::get("debtor");
        $total_amount   = Input::get("amount");
        $credit_type    = Input::get("credit_type");

        $share = round($total_amount / (sizeof($debtors) + 1), 2);

        foreach ($debtors as $debtor) {
            $flight = Ledger::create([
                "creditor" =>  $user->id,
                'debtor' => $debtor,
                'credit_type' => $credit_type,
                "amount" => $share,
            ]);
        }

        return $this->setStatusCode(201)->respond([
            'data' => [
                "share" => $share,
                "group_size" => (sizeof($debtors) + 1)
            ]
        ]);
    }


}