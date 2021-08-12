<?php

namespace App\Http\Controllers;

use App\Http\Requests\FavoriteRequest;
use App\Services\FavoriteService;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{

    public function store(FavoriteRequest $request)
    {
        FavoriteService::create($request);
    }

    public function destroy(FavoriteRequest $request)
    {
         FavoriteService::delete($request);
    }
}
