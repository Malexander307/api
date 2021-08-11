<?php

namespace App\Http\Controllers;

use App\Models\Favourites;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{

    public function store(Request $request)
    {
        Favourites::create([
                               'user_id' => $request->user()->id,
                               'product_id' => $request->product_id
                           ]);
    }

    public function destroy($id)
    {
        //
    }
}
