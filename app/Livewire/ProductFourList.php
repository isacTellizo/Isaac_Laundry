<?php

namespace App\Livewire;

use App\Livewire\Inventory\Categories;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductFour;
use App\Models\Unit;
use Livewire\Component;

class ProductFourList extends Component
{
    public $name, $unit_id, $category_id, $sku, $purchase_price, $opening_stock, $description, $is_active = true;
    public $categories, $units, $products, $product;
    public function render()
    {
        $this->products = ProductFour::latest()->get();
        return view('livewire.product-four-list');
    }
    public function mount()
    {
        $this->categories = Category::latest()->get();
        $this->units = Unit::latest()->get();
    }

    public function resetInputFields()
    {
        $this->name = '';
        $this->unit_id = '';
        $this->category_id = '';
        $this->sku = '';
        $this->purchase_price = null;
        $this->opening_stock = null;
        $this->description = '';
        $this->is_active = true;
        $this->resetErrorBag();
    }
    public function save()
    {
        $this->validate([
            "name" => "required",
            "unit_id" => "required",
            "category_id" => "required",
            "sku" => "required|unique:prdouct_fours,sku," .($this->product->id ?? ''),
            "purchase_price" => "required|numeric|min:0",
            "opening_stock" => "required|numeric|min:0",
        ]);

        $product = new ProductFour();
        if ($this->product) {
            $product = $this->product;
        }
        $product->name = $this->name;
        $product->unit_id = $this->unit_id;
        $product->category_id = $this->category_id;
        $product->sku = $this->sku;
        $product->purchase_price = $this->purchase_price;
        $product->opening_stock = $this->opening_stock;
        $product->description = $this->description;
        $product->is_active = $this->is_active;
        $product->save();
        $this->resetInputFields();
        $this->dispatch('notify', [
            'type' => 'success',
            'title' => 'Success.',
            'message' => $this->product ? 'Product was updated.' : 'Product was created.',
        ]);
        $this->dispatch('closemodal');
    }

    public function delete($id)
    {
        $product = ProductFour::whereId($id)->first();
        if (!$product) {
            return;
        }
        $product->delete();
    }

    public function edit($id)
    {
        $this->product = ProductFour::whereId($id)->first();
        $this->name = $this->product->name;
        $this->unit_id = $this->product->unit_id;
        $this->category_id = $this->product->category_id;
        $this->sku = $this->product->sku;
        $this->purchase_price = $this->product->purchase_price;
        $this->opening_stock = $this->product->opening_stock;
        $this->description = $this->product->description;
        $this->is_active = $this->product->is_active == 1 ? true : false;
        $this->resetErrorBag();
    }
}
