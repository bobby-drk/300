<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Models\Ledger;
use App\Services\Balance;


class PayController extends ApiController
{
    /**
     * shows the initial page for the pay section of the site
     * @return view
     */
    public function index()
    {
        $data = [];
        // $data['friends'] = User::find($my_id)->friends;
        // return  User::with('friends')->find($user->id);



        return view('pages.pay', $data);
    }


    /**
     * shows the record food page
     * @return view
     */
    public function recordFood()
    {
        $data = [];
        // $data['users'] = User::all()->sortBy("first_name");
        $data['users'] = User::where('id', '!=', Auth::id())->get();

        return view('pages.record_food', $data);
    }


    /**
     * shows the record bowling page
     * @return view
     */
    public function recordBowling()
    {
        $data = [];
        $data['users'] = User::where('id', '!=', Auth::id())->get();

        return view('pages.record_bowling', $data);
    }


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

   /**
     * show who I owe and who owes me
     * @return view
     */
    public function myBalance()
    {
        $data = [];
        $balance = new Balance();
        $data['balance_sheet'] = $balance->getMyBalance(Auth::id());

        return view('pages.mybalance', $data);

    }


}
