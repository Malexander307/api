<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PhotosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('photos')->insert([
            'link' => 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fhabr.com%2Fru%2Fpost%2F334760%2F&psig=AOvVaw399-sFNL3JL6E0raW9tr92&ust=1627715221135000&source=images&cd=vfe&ved=0CAsQjRxqFwoTCIiF3u-divICFQAAAAAdAAAAABAD',
            'product_id' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
         DB::table('photos')->insert([
            'link' => 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fhabr.com%2Fru%2Fpost%2F334760%2F&psig=AOvVaw399-sFNL3JL6E0raW9tr92&ust=1627715221135000&source=images&cd=vfe&ved=0CAsQjRxqFwoTCIiF3u-divICFQAAAAAdAAAAABAD',
            'product_id' => 2,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
