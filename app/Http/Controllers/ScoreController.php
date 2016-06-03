<?php

//comment
use Alert;
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

    public function recordscore()
    {
        $my_id = Auth::id();
        $score = Input::get('score');
        
        $new_score = new Rate ();
        $new_score->user_id = $my_id;
        $new_score->score = $score;
        $new_score->save();

        Alert::add("You recored your score successfully!");
        return redirect()->route('scores');
    }
}
