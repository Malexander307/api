<?php

namespace App\Reposetories;

use App\Models\Products;
use Illuminate\Http\Request;

class SearchReposetory
{
    public static function searchName($search, $products){
        return $products->where('title', 'LIKE', '%'.$search.'%');
    }

    public static function searchLocation($search, $products){
        return $products->where('location', 'LIKE', '%'.$search.'%');
    }

    public static function searchCategory($search, $products){
        return $products->where('category_id', $search);
    }

    public static function searchPrice($price, $products){
        return $products->whereBetween('price', [$price['min'], $price['max']]);
    }
}