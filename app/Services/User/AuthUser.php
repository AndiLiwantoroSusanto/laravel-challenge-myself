<?php
namespace App\Services\User;

use App\User;
use Auth;

class AuthUser
{
    public function __construct()
    {

    }

    /**
     * Authenticate user and return access token
     *
     * @param  array
     * @return array 
     */
    static public function execute(array $data) : array
    {
        if(!Auth::attempt($data)){ 
            return [
                'message'=> 'Invalid credential',
                'errors' => [
                    'password' => [
                        'Invalid Credential'
                    ],
                    'email' => [
                        'Invalid Credential'
                    ]
                ]
            ];
        }
        else 
        {
            $accessToken = Auth::user()->createToken('authToken')->accessToken;

            return [
                'message'=> 'User authenticated',
                'data' => [
                    'access_token' => $accessToken
                ]
            ];
        }
    }
}