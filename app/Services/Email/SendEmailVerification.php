<?php
namespace App\Services\Email;

use App\User;
use Auth;
use App\EmailVerification;
use App\Mail\EmailVerificationEmail;
use Mail;
use Illuminate\Support\Str;

class SendEmailVerification
{
    public function __construct()
    {

    }

    /**
     * Create a new user and return access token on success
     *
     * @param  array
     * @return 
     */
    static public function execute(User $user)
    {
        $key = Str::random(32);
        $data = [
            'key' => $key,
            'user_id' => $user->id
        ];
        EmailVerification::create($data);
        $data = ['key' => $key];
        Mail::to('andiliesusanto@gmail.com')->send(new EmailVerificationEmail($data));
    }
}