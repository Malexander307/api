<?php

namespace App\Reposetories;

use App\Http\Resources\UserResource;
use App\Models\User;

class UserRepository
{
    public static function getUser($userId){
        return User::with('favorites')->where('id', $userId)->first();
    }
}