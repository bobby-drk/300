<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PayController extends Controller
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



}
