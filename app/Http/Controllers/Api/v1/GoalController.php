<?php

namespace App\Http\Controllers\Api\v1;

use App\Goal;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        $goals = Goal::where('user_id', $user->id)->get();
        return response(['goals' => $goals]);
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
            'total_day' => 'numeric|required',
        ]);
        $validatedData['user_id'] = $request->user()->id;

        $goal = Goal::create($validatedData);

        return response([
            'message' => 'User registered',
            'goal' => $goal,
        ]);
    }

    public function checkIn(Request $request, $id)
    {
        // $validatedData['user_id'] = $request->user()->id;
        $msg = 'Success Check In';
        $goal = Goal::where('id', $id)->first();
        if (isset($goal)) {
            if (!$goal->check_in) {
                $goal->check_in = true;
                $goal->current_day++;
                $goal->save();
            } else {
                $msg = 'Already Check In';
            }
        }

        return response([
            'message' => $msg,
        ]);
    }

    public function refreshCheckIn()
    {
        $goals = Goal::where('is_not_lazy', 1)->where('check_in', 1)->get();
        if (isset($goals)) {
            foreach ($goals as $goal) {
                $goal->check_in = false;
                $goal->save();
            }
        }
    }

    public function resetG()
    {
        Goal::truncate();
    }
}
