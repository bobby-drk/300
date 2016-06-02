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
         ]);

        if ($validator->fails()) {
            return $this->responseBadRequest("Bad Request", $validator->messages());
        }

        $user = Auth::user();

        $ledger = new Ledger();
        $ledger->creditor = $user->id;
        $ledger->debtor = Input::get("debtor");
        $ledger->credit_type = Input::get("credit_type");
        $ledger->amount = Input::get("amount");

        $ledger->save();

        return $this->setStatusCode(201)->respond([
            'data' => ["id" => $ledger->id]
        ]);
    }


}