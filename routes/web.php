<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SampleController;
use Illuminate\Support\Facades\Route;

Route::get('/home', \App\Livewire\Dashboard::class)->name('home');

Route::get('/json',[SampleController::class, 'products']);
Route::get('/product/{id?}',[ProductController::class,'showProduct']);
Route::post('/products/create',[ProductController::class,'createProduct']);

Route::prefix('inventory')->group(function () {
    Route::get('/units', \App\Livewire\Inventory\Units::class)->name('inventory.units.list');
    Route::get('/products', \App\Livewire\Inventory\ProductsList::class)->name('inventory.products.list');
    Route::get('/products-two', \App\Livewire\Inventory\ProductsTwoList::class)->name('inventory.products-two');
    Route::get('/products-three', \App\Livewire\Inventory\ProductsThreeList::class)->name('inventory.products-three');
    Route::get('/products-four', \App\Livewire\ProductFourList::class)->name('inventory.products-four');
    Route::get('/categories', \App\Livewire\Inventory\CategoriesList::class)->name('categories.units.list');
    Route::get('/categories-two', \App\Livewire\Inventory\Categories::class)->name('categories-two.units.list');
    Route::get('/products-six', \App\Livewire\ProductSixList::class)->name('inventory.products-six');
});
Route::prefix('purchase')->group(function () {
    Route::get('/suppliers/{name?}', \App\Livewire\Purchase\SupplierList::class)->name('purchase.supplier.list');
    Route::get('/suppliers-new', \App\Livewire\Purchase\SuppliersNew::class)->name('purchase.suppliers-new');
    Route::get('/suppliers-two', \App\Livewire\Purchase\SupplierListTwo::class)->name('purchase.suppliers-two');
    Route::get('/suppliers-three', \App\Livewire\SupplierListThree::class)->name('purchase.suppliers-three');
    Route::get('/', \App\Livewire\Purchase\PurchaseList::class)->name('purchase.list');
    Route::get('/purchase-manage/{id?}', \App\Livewire\Purchase\PurchaseManage::class)->name('purchase.manage');

});

Route::get('/', \App\Livewire\TestComponent::class)->name('test');
Route::get('/pos', \App\Livewire\POS::class)->name('pos');
Route::get('/array-task-one', \App\Livewire\ArrayTask1::class)->name('array');
Route::get('/practice',\App\Livewire\Practice::class)->name('practice');

Route::get('/name'.\App\Livewire\Inventory\ProductsThreeList::class);
Route::prefix('users')->group(function(){
    Route::get('/sample' , \App\Livewire\Inventory\ProductsThreeList::class)->name('save');
});

