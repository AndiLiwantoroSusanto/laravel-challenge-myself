<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goal;

class GoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $goals = Goal::where('user_id',$user->id)->get();
        return response(['goals'=>$goals]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'is_not_lazy' => 'boolean|required',
            'started_at' => 'date|required',
            'total_day' => 'numeric|required'
        ]);
        $validatedData['user_id'] = $request->user()->id;

        $goal = Goal::create($validatedData);
        
        return response([
            'message'=> 'User registered',
            'goal' => $goal
        ]);
    }

    public function resetG()
    {
        Goal::truncate();
    }
}
