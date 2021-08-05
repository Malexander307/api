<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('restoreEmail', [AuthController::class, 'restoreEmail'])->name('restore');
Route::get('restorePass', [AuthController::class, 'restorePassword'])->name('restore_pass');;

Route::group(['middleware' => ['auth:sanctum']], function (){
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('/products', ProductController::class);
    Route::resource('/categories', CategoriesController::class);
});

