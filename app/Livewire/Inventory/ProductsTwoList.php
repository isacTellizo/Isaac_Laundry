<?php

namespace App\Livewire\Inventory;

use App\Models\Category;
use App\Models\ProductTwo;
use App\Models\Unit;
use Livewire\Component;

class ProductsTwoList extends Component
{
    public $name, $unit_id, $category_id, $sku, $purchase_price, $opening_stock, $description, $is_active = true, $search = '';
    public $product, $products, $categories, $units, $selectedProducts = [], $cartItems = [];
    public function render()
    {
        $this->units = Unit::latest()->get();
        $this->categories = Category::latest()->get();
        $query = ProductTwo::latest();
        if ($this->search != '') {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search)
                    ->orWhere('sku', 'like', '%' . $this->search . '%');
            });
        }

        $this->products = $query->get();
        return view('livewire.inventory.products-two-list');
    }

    public function addProducts() {
        $item = ProductTwo::whereId($this->selectedProducts)->get();
        $cartItem = [
            "name" => $this->selectedProducts['name'],
            "quantity" => 1,
            "rate" => $this->selectedProducts['purchase_price'],
        ];

        array_push($this->cartItems,$cartItem);
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
        $this->product = null;
        $this->resetErrorBag();
    }
    public function save()
    {
        $this->validate([
            "name" => "required",
            "unit_id" => "required",
            "category_id" => "required",
            "sku" => "required|unique:product_twos,sku," . ($this->product->id ?? ''),
            "purchase_price" => "nullable|numeric|min:0",
            "opening_stock" => "nullable|numeric|min:0",
        ]);

        $product = new ProductTwo();
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
        $this->dispatch('notify', [
            'type' => 'success',
            'title' => 'Success.',
            'message' => $this->product ? 'Product was updated.' : 'Product was created.',
        ]);
        $this->resetInputFields();
        $this->dispatch('closemodal');
    }

    public function delete($id)
    {
        $this->product = null;
        $product = ProductTwo::whereId($id)->first();
        if (!$product) {
            return;
        }
        $product->delete();
        $this->dispatch('notify', [
            'type' => 'success',
            'title' => 'Success.',
            'message' => 'Product was deleted.',
        ]);
    }

    public function edit($id)
    {
        $this->product = ProductTwo::whereId($id)->first();
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
