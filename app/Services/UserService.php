<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public static function createUser($request){
        return User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password'])
        ]);
    }

    public static function updatePassword($user, $new_password){
        $user->password = bcrypt($new_password);
        $user->save();
    }
}