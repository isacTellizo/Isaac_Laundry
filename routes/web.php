<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Livewire\Dashboard::class)->name('home');

Route::prefix('inventory')->group(function () {
    Route::get('/units', \App\Livewire\Inventory\Units::class)->name('inventory.units.list');
    Route::get('/products', \App\Livewire\Inventory\ProductsList::class)->name('inventory.products.list');
    Route::get('/categories', \App\Livewire\Inventory\CategoriesList::class)->name('categories.units.list');
});
