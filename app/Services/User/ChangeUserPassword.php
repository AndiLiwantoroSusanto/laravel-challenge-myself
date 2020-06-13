<?php
namespace App\Services\User;

use App\User;
use Auth;

class ChangeUserPassword
{
    public function __construct()
    {

    }

    /**
     * Change User Password
     *
     * @param  array
     * @return array 
     */
    static public function execute(array $data,$user) : array
    {
        $errors = [];

        if(!Hash::check($request->password,$user->password))
        {
            push_array_assosiative($errors,'email','Password does not match');
        }


        if(!empty($errors))
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
            $user->password = bcrypt($request->new_password);
            $user->save();

            return [
                'message'=> 'Password Changed'
            ];
        }
    }
}