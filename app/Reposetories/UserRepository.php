<?php

namespace App\Reposetories;

use App\Http\Resources\UserResource;
use App\Models\User;

class UserRepository
{
    public static function getUser($userId){
        return User::where('id', $userId)->first();
    }
}