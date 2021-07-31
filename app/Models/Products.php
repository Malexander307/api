<?php

namespace App\Models;

use Database\Seeders\PhotosSeeder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'location', 'price'];

    public function photos(){
        return $this->hasMany(Photo::class, 'product_id');
    }
}
