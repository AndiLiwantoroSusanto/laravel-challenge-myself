<?php
namespace App\Services\User;

use App\User;
use Auth;
class CreateUser
{
    public function __construct()
    {

    }

    /**
     * Create a new user and return access token on success
     *
     * @param  array
     * @return array 
     */
    static public function execute(array $data) : array
    {
        $errors = [];

        if(User::isEmailExist($data['email']))
        {
            push_array_assosiative($errors,'email','Email alreay exists');
        }


        if(!isEmpty($errors))
        {
            return [
                'message'=> 'The given data was invalid.',
                'errors'=> [
                    $errors
                ]
            ];
        }
        else 
        {
            $data['password'] = bcrypt($data['password']);
            $user = User::create($data);
            $accessToken = $user->createToken('authToken')->accessToken;
            
            return [
                'message'=> 'User registered',
                'data' => [
                    'access_token' => $accessToken
                ]
            ];
        }
    }
}