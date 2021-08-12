<?php

namespace App\Reposetories;

use App\Models\RestoringPassword;
use App\Models\User;

class RestoringPasswordRepository
{

    public static function currentUser($token){
        return User::where('email', RestoringPassword::where('token', $token)->first()->email)->first();
    }

    public static function currentToken($token){
        return RestoringPassword::where('token', $token)->first()->created_at;
    }
}
}