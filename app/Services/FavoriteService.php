<?php

namespace App\Services;

use App\Models\Favourites;

class FavoriteService
{
    public static function create($request){
        Favourites::create([
                               'user_id' => $request->user()->id,
                               'product_id' => $request->product_id
                           ]);
    }

    public static function delete($request){
        Favourites::where('user_id', $request->user()->id)->where('product_id', $request->product_id)->delete();
    }

}