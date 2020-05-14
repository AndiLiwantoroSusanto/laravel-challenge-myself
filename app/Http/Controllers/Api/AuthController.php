<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;

class AuthController extends Controller
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
        return response(['user'=>$user,'access_token'=>$accessToken]);
    }

    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'name'  => 'required',
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if(!Auth::attempt($validatedData)){ 
            return response(['message'=>'Invalid Credentials']);
        }

        $accessToken = Auth::user()->createToken('authToken')->accessToken;
        return response(['user'=>auth()->user(),'access_token'=>$accessToken]);
    }
}
