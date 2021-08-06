<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Reposetories\ProductReposetory;
use App\Reposetories\SearchReposetory;
use App\Services\ProductService;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchName(Request $request){
        return SearchReposetory::searchName($request->search, Products::all())->paginate(10);
    }

    public function searchLocation(Request $request){
        return SearchReposetory::searchLocation($request->search, Products::all())->paginate(10);
    }

    public function products(Request $request){
        try {
            return response(ProductReposetory::products($request), '200');
        }catch (\Exception $exception){
            return response($exception, 500);
        }
    }
}
