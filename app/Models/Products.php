<?php

namespace App\Models;

use Database\Seeders\PhotosSeeder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'location', 'price', 'user_id', 'category_id'];

    public function photos(){
        return $this->hasMany(Photo::class, 'product_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category(){
        return $this->belongsTo(Categories::class, 'category_id');
    }
}
