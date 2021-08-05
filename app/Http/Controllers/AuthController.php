<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\RestoringPassword;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(UserRequest $request)
    {
        $user = UserService::createUser($request);
        $token = $user->createToken('token')->plainTextToken;
        $response = ['user' => $user, 'token' => $token];
        return response($response, 201);
    }

    public function login(Request $request){
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return $user->createToken('token')->plainTextToken;
    }

    public function logout(){
        $user = request()->user();
        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
    }

    public function restorePassword(Request $request){
        if(User::where('email', $request->email)->first()){
            RestoringPassword::create([
                'email' => $request->email,
                'token' => Str::random(30),
            ]);

        }
    }
}
