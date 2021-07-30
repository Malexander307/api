<?php

namespace App\Reposetories;

use App\Models\Products;

class ProductReposetory
{
    public static function productsAll(){
         return Products::with('photos')->get();
    }
}