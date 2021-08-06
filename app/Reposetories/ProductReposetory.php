<?php

namespace App\Reposetories;
use App\Http\Resources\ProductResource;
use App\Models\Products;
use http\Exception\RuntimeException;
use Mockery\Exception;

class ProductReposetory
{
    public static function productsAll(){
         return ProductResource::collection(Products::with('photos')->get());
    }

    public static function products($request){
        try {
            $products = Products::query();
            if(!empty($request->title)){ $products = SearchReposetory::searchName($request->title, $products);}
            if(!empty($request->location)){ $products = SearchReposetory::searchLocation($request->location, $products);}
            if(!empty($request->category)){ $products = SearchReposetory::searchCategory($request->category, $products);}
            if(!empty($request->price)){ $products = SearchReposetory::searchPrice($request->price, $products);}
            return $products->paginate(10);
        }catch (\Exception $exception){
            dd($exception);
            throw new RuntimeException($exception, 500);
        }
    }
}