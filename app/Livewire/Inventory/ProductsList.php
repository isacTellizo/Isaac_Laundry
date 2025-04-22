<?php

namespace App\Livewire\Inventory;

use App\Models\Category;
use App\Models\Product;
use App\Models\Unit;
use Livewire\Component;

class ProductsList extends Component
{
    public $name, $unit_id, $category_id, $sku, $purchase_price, $opening_stock, $minimum_stock_value, $description, $is_active = true, $is_consumable = true;
    public $categories, $units, $products, $product;
    public function render()
    {
        $this->categories = Category::latest()->get();
        $this->units = Unit::latest()->get();
        $this->products = Product::latest()->get();
        return view('livewire.inventory.products-list');
    }

    public function resetInputFields()
    {
        $this->name = '';
        $this->unit_id = '';
        $this->category_id = '';
        $this->sku = '';
        $this->purchase_price = '';
        $this->opening_stock = '';
        $this->minimum_stock_value = '';
        $this->description = '';
        $this->is_active = true;
        $this->is_consumable = true;
        $this->product = null;
        $this->resetErrorBag();
    }

    public function save()
    {
        if ($this->product) {
            $this->validate([
                "name" => "required",
                "unit_id" => "required",
                "category_id" => "required",
                "sku" => "required|unique:products,sku," . $this->product->id,
                "purchase_price" => "required",
            ]);

            $product = $this->product;
        } else {
            $this->validate([
                "name" => "required",
                "unit_id" => "required",
                "category_id" => "required",
                "sku" => "required|unique:products,sku",
                "purchase_price" => "required",
            ]);
            $product = new Product();
        }
        $product->name = $this->name;
        $product->unit_id = $this->unit_id;
        $product->category_id = $this->category_id;
        $product->sku = $this->sku;
        $product->purchase_price = $this->purchase_price;
        $product->opening_stock = $this->opening_stock;
        $product->minimum_stock_value = $this->minimum_stock_value;
        $product->description = $this->description;
        $product->is_active = $this->is_active;
        $product->is_consumable = $this->is_consumable;
        $product->save();
        $this->dispatch('notify', [
            'type' => 'success',
            'title' => 'Success.',
            'message' => 'Product was created.',
        ]);
        $this->resetInputFields();
        $this->dispatch('closemodal');
    }

    public function delete($id)
    {
        $product = Product::whereId($id)->first();
        if (!$product) {
            return;
        }
        $product->delete();
        $this->dispatch('notify', [
            'type' => 'success',
            'title' => 'Success.',
            'message' => 'Product was deleted successfully.',
        ]);
    }

    public function edit($id)
    {
        $this->product = Product::whereId($id)->first();
        $this->name = $this->product->name;
        $this->unit_id = $this->product->unit_id;
        $this->category_id = $this->product->category_id;
        $this->sku = $this->product->sku;
        $this->purchase_price = $this->product->purchase_price;
        $this->opening_stock = $this->product->opening_stock;
        $this->minimum_stock_value = $this->product->minimum_stock_value;
        $this->description = $this->product->description;
        $this->is_active = $this->product->is_active == 1 ? true : false;
        $this->is_consumable = $this->product->is_consumable == 1 ? true : false;
    }
}
