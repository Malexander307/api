<?php

namespace App\Reposetories;

use App\Http\Resources\CategoriesResource;
use App\Http\Resources\CategoryResource;
use App\Models\Categories;

class CategoriesReposetory
{
    public static function getCategories(){
       return CategoriesResource::collection(Categories::all());
    }

    public static function getCategory($id){
       return CategoryResource::collection(Categories::where('id', $id)->with('products')->get());
    }
}