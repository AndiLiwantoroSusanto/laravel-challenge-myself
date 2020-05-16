<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name'  => 'required|max:55',
            'email' => 'email|required',
            'password' => 'required|confirmed'
        ]);
        $validatedData['password'] = bcrypt($request->password);
        $user = User::create($validatedData);
        $accessToken = $user->createToken('authToken')->accessToken;
        return response(['message'=>"Success Register",'access_token'=>$accessToken]);
    }

    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'email|required',
            'password' => 'required',
            'remember_me' => 'boolean'
        ]);

        if(!Auth::attempt($validatedData)){ 
            return response(['message'=>'Invalid Credentials']);
        }

        $accessToken = Auth::user()->createToken('authToken')->accessToken;
        return response(['message'=>"Success Login",'access_token'=>$accessToken]);
    }

    public function test()
    {
        return User::all();
    }
}
