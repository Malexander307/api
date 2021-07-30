<?php

namespace App\Reposetories;
use App\Http\Resources\ProductResource;
use App\Models\Products;

class ProductReposetory
{
    public static function productsAll(){
         return ProductResource::collection(Products::with('photos')->get());
    }
}