<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Mail\RestoringEmail;
use App\Models\RestoringPassword;
use App\Models\User;
use App\Services\RestoringService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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

    public function restoreEmail(Request $request){
        if(User::where('email', $request->email)->first()){
            Mail::to($request->email)->send(new RestoringEmail('http://localhost:8080/new-password/' . RestoringService::createToken($request)));
        }else{
            return response('User don`t find', 404);
        }
    }

    public function restorePassword(Request $request){
        $user = User::where('email', RestoringPassword::where('token', $request->token)->first()->email)->first();
        $token_date = RestoringPassword::where('token', $request->token)->first()->created_at;
        if ($token_date->diffInMinutes(Carbon::now()) > 30){
            RestoringPassword::where('token', $request->token)->delete();
            return response('Token is expired', 401);
        }else{
            $user->password = bcrypt($request['password']);
            $user->save();
            RestoringPassword::where('token', $request->token)->delete();
            return response('New password', 200);
        }
    }
}
