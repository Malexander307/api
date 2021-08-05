<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Products;
use App\Reposetories\ProductReposetory;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        Log::info($request->user());
        return response(ProductReposetory::productsAll(), 200);
    }

    public function create()
    {
        //
    }

    public function store(ProductRequest $request)
    {
        try {
            ProductService::createProduct($request);
            return response('created', 200);
        }catch (\Exception $exception){
            return response($exception, 500);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        ProductService::updateProduct($request, $id);
    }

    public function destroy($id)
    {
        ProductService::deleteProduct($id);
        return response('deleted', 200);
    }
}
