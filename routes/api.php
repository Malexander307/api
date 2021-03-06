<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RestoringPasswordController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('restoreEmail', [RestoringPasswordController::class, 'restoreEmail'])->name('restore');
Route::post('restorePass', [RestoringPasswordController::class, 'restorePassword'])->name('restore_pass');

Route::group(['middleware' => ['auth:sanctum']], function (){
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('/products', ProductController::class);
    Route::post('search_name', [SearchController::class, 'searchName']);
    Route::post('search', [SearchController::class, 'products']);
    Route::resource('/categories', CategoriesController::class);
    Route::post('/addToFavorites', [FavouriteController::class, 'store']);
    Route::post('/removeFromFavorites', [FavouriteController::class, 'destroy']);
    Route::get('user', [UserController::class, 'index']);
});

