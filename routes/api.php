<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SampleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'getProducts']);
    Route::get('/view/{id?}', [ProductController::class, 'getProduct']);
    Route::post('/create', [ProductController::class, 'createProduct']);
    Route::match(['get','post'],'/update/{id?}', [ProductController::class, 'updateProduct']);
});

Route::prefix('categories')->group(function(){
    Route::get('/',[CategoryController::class,'getCategories']);
    Route::get('/view/{id?}',[CategoryController::class,'getCategory']);
    Route::post('/create',[CategoryController::class,'createCategory']);
    Route::match(['get','post'],'/update/{id}',[CategoryController::class,'updateCategory']);
});
