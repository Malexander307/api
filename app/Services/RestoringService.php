<?php

namespace App\Services;

use App\Models\RestoringPassword;
use Illuminate\Support\Str;

class RestoringService
{
    public static function createToken($request){
        return RestoringPassword::create([
                'email' => $request->email,
                'token' => Str::random(30),
        ])->token;
    }

    public static function deleteToken($token){
        RestoringPassword::where('token', $token)->delete();
    }
}