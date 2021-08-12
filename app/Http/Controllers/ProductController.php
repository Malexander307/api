<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Reposetories\ProductReposetory;
use App\Services\ProductService;

class ProductController extends Controller
{
    public function index()
    {
        return response(ProductReposetory::productsAll(), 200);
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

    public function update(ProductRequest $request, $id)
    {
        ProductService::updateProduct($request, $id);
    }

    public function destroy($id)
    {
        ProductService::deleteProduct($id);
        return response('deleted', 200);
    }
}
