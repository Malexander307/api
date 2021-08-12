<?php

namespace App\Services;

use App\Models\Photo;
use App\Models\Products;
use http\Exception\RuntimeException;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;
use Image4IO\Image4IOApi;

class ProductService
{
    public static function createProduct($request){
        try {
            DB::beginTransaction();
            $id = Products::create([
                'title' => $request->title,
                'description' => $request->description,
                'location' => $request->location,
                'price' => $request->price,
                'user_id' => $request->user()->id,
                'category_id' => $request->category_id,
            ])->id;
            self::photoSave($request->file('photos'), $id);
            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
            throw response($exception, 500);
        }
    }

    public static function deleteProduct($id){
        try {
            $product = Products::findOrFail($id);
            $product->photos()->delete();
            $product->delete();
        }catch (\Exception $exception){
            return response($exception, 500);
        }
    }

    private static function photoSave($files,$id){
        try {
            $client = new Image4IOApi(
                "bygvX72ZmCvgA0SvEu0pTQ==",//remake this hardcode
                "cDPmh0aIdWHWbMgxtbqyjFS3nKd5ihpIEzLXQjXDu7w="
            );
            foreach ($files as $file) {
                $response = $client->uploadImage($file, time() . '_' . $file->getClientOriginalName(), 'files', true);
                $link = json_decode($response['content'])->uploadedFiles[0]->url;
                Photo::create(['link' => $link, 'product_id' => $id]);
            }
        } catch (\Exception $exception) {
            throw response('error creating photo', 500);
        }
    }

    public static function updateProduct($request, $id){
        try {
            $product = Products::find($id);
            $product->title = $request->title;
            $product->description = $request->description;
            $product->description = $request->location;
            $product->price = $request->price;
            $product->category_id = $request->category_id;
            $product->save();
        }catch (\Exception $exception){
            throw new RuntimeException($exception);
        }
    }
}
