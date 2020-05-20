<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Auth;
use App\Mail\TestEmail;
use Mail;

class UserController extends Controller
{
    public function register(Request $request)
    {
        // $data = ['message' => 'This is a test!'];

        // Mail::to('andiliesusanto@gmail.com')->send(new TestEmail($data));

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

    public function change(Request $request) 
    {
        $validatedData = $request->validate([
            'password' => 'required',
            'new_password' => 'required'
        ]);
        
        $user = $request->user();

        if(!Hash::check($request->password,$user->password)){
            return response(['message'=>'Password does not match']);
        }
        
        $user->password = bcrypt($request->new_password);
        $user->save();

        return response(['message'=>'Password Changed']);
    }
}
