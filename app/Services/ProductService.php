<?php

namespace App\Services;

use App\Models\Photo;
use App\Models\Products;
use Illuminate\Support\Facades\DB;

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
            ])->id;
            self::photoSave($request->file('photos'), $id);
            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
            return response($exception, 500);
        }
    }

    private static function photoSave($files, $id){
        foreach ($files as $file) {
            $link = $file->storeAs('files', time() . '_' . $file->getClientOriginalName());
            Photo::create(['link' => $link, 'product_id' => $id]);
        }

    }
}
