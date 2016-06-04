<?php

//use Alert;
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Models\Score;

class ScoreController extends Controller
{
    /**
     * shows the initial score page
     * @return view
     */
    public function index()
    {
        $data = [];

        return view('pages.scores', $data);
    }

    public function record()
    {
        $my_id = Auth::id();
        $score = Input::get('score');
//        $score = 300;
        
        $new_score = new Score();
        $new_score->user_id = $my_id;
        $new_score->score = $score;
        $new_score->save();
        
                      
        return $new_score->id;
    }
}


