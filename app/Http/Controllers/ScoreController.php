<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

class ScoreController extends Controller
{
    /**
     * shows the initial score page
     * @return view
     */
    public function index()
    {
        $data = [];
        // $data['friends'] = User::find($my_id)->friends;
        // return  User::with('friends')->find($user->id);

        return view('pages.scores', $data);
    }

}
