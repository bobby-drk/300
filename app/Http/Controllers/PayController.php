<?php

namespace App\Http\Controllers;

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

        return view('pages.record_food', $data);
    }


    /**
     * shows the record bowling page
     * @return view
     */
    public function recordBowling()
    {
        $data = [];

        return view('pages.record_bowling', $data);
    }


    /**
     * shows the record bowling page
     * @return view
     */
    public function record()
    {
        return $data;
    }

}
