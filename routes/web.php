<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Livewire\Dashboard::class)->name('home');

Route::prefix('inventory')->group(function () {
    Route::get('/units', \App\Livewire\Inventory\Units::class)->name('inventory.units.list');
    Route::get('/products', \App\Livewire\Inventory\ProductsList::class)->name('inventory.products.list');
    Route::get('/products-two', \App\Livewire\Inventory\ProductsTwoList::class)->name('inventory.products-two');
    Route::get('/categories', \App\Livewire\Inventory\CategoriesList::class)->name('categories.units.list');
    Route::get('/categories-two', \App\Livewire\Inventory\Categories::class)->name('categories-two.units.list');
});
Route::prefix('purchase')->group(function () {
    Route::get('/suppliers', \App\Livewire\Purchase\SupplierList::class)->name('purchase.supplier.list');
    Route::get('/suppliers-new', \App\Livewire\Purchase\SuppliersNew::class)->name('purchase.suppliers-new');
    Route::get('/suppliers-two', \App\Livewire\Purchase\SupplierListTwo::class)->name('purchase.suppliers-two');
    Route::get('/suppliers-three', \App\Livewire\SupplierListThree::class)->name('purchase.suppliers-three');
    Route::get('/', \App\Livewire\Purchase\PurchaseList::class)->name('purchase.list');
    Route::get('/purchase-manage/{id?}', \App\Livewire\Purchase\PurchaseManage::class)->name('purchase.manage');

});

