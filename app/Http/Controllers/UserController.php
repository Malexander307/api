<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Reposetories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        return UserRepository::getUser(request()->user()->id);
    }

    public function show(Request $request)
    {
        return UserResource::collection(UserRepository::getUser($request->user()->id));
    }

    public function update(Request $request)
    {

    }

    public function destroy($id)
    {
        //
    }
}
