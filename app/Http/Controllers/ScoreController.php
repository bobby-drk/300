<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Models\Score;

class ScoreController extends ApiController
{
    /**
     * shows the initial score page
     * @return view
     */
    public function index()
    {
        $data = [];
        $data['pr'] = Score::where('user_id', Auth::id())->max('score');

        return view('pages.scores', $data);
    }

    public function record(Request $request)
    {
        // validate
         $validator = Validator::make($request->all(), [            
            'score' => 'required|numeric|max:300|min:1'
         ]);

        if ($validator->fails()) {
            return $this->responseBadRequest("Bad Request", $validator->messages());
        }
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


