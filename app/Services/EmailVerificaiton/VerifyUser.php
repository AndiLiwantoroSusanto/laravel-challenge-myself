<?php
namespace App\Services\EmailVerification;

use App\User;
use App\EmailVerification;
use Carbon\Carbon;

class VerifyUser
{
    public function __construct()
    {

    }

    /**
     * Create a new user and return access token on success
     *
     * @param  string
     * @return 
     */
    static public function execute($key)
    {
        $email = EmailVerification::where('key',$key)->first();
        $user = User::find($email->user_id);
        $user->email_verified_at = Carbon::now();
        $user->save();
    }
}