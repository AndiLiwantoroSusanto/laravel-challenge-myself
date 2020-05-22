<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\EmailVerification;
use App\User;
use Carbon\Carbon;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function verify($key)
    {
        $email = EmailVerification::where('key',$key)->first();
        $user = User::find($email->user_id);
        $user->email_verified_at = Carbon::now();
        $user->save();
    }
}
