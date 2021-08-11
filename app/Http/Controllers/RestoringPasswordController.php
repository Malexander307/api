<?php

namespace App\Http\Controllers;

use App\Mail\RestoringEmail;
use App\Models\RestoringPassword;
use App\Models\User;
use App\Services\RestoringService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class RestoringPasswordController extends Controller
{
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

    public function restoreEmail(Request $request){
        if(User::where('email', $request->email)->first()){
            Mail::to($request->email)->send(new RestoringEmail('http://localhost:8080/new-password/' . RestoringService::createToken($request)));
        }else{
            return response('User don`t find', 404);
        }
    }
}
