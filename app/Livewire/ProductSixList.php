<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductSix;
use App\Models\Unit;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Livewire\Component;

class ProductSixList extends Component
{
    public $name, $category_id, $unit_id, $sku, $opening_stock = 0, $purchase_price, $description, $is_active = true, $search = '';
    public $categories, $units, $products, $product;
    public $price_from, $price_to, $status_filter = 1;
    public $start_date, $end_date, $dates, $products_created;
    public function render()
    {
        $query = ProductSix::latest();
        if ($this->search != '') {
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('description', 'like', '%' . $this->search . '%')
                ->orWhereHas('category', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%');
                });
        }

        if ($this->price_from && $this->price_to) {
            $query->whereBetween('purchase_price', [$this->price_from, $this->price_to]);
        }
        $this->products = $query->get();

        return view('livewire.product-six-list');
    }

    public function mount()
    {
        $this->categories = Category::latest()->get();
        $this->units = Unit::latest()->get();
    }

    public function changeStatus($id)
    {
        $product = ProductSix::whereId($id)->first();
        if ($product->is_active) {
            $product->is_active = 0;
        } else {
            $product->is_active = 1;
        }
        $product->save();
    }

    public function resetInputFields()
    {
        $this->name = '';
        $this->category_id = '';
        $this->unit_id = '';
        $this->sku = '';
        $this->opening_stock = 0;
        $this->purchase_price = '';
        $this->description = '';
        $this->is_active = true;
        $this->product = null;
        $this->resetErrorBag();
    }
    public function save()
    {
        $this->validate([
            "name" => "required",
            "category_id" => "required",
            "unit_id" => "required",
            "purchase_price" => "required|numeric|min:0",
            "sku" => 'required|unique:product_sixes,sku,' . ($this->product->id ?? ''),
        ]);
        $product = new ProductSix();
        if ($this->product) {
            $product = $this->product;
        }
        $product->name = $this->name;
        $product->category_id = $this->category_id;
        $product->unit_id = $this->unit_id;
        $product->sku = $this->sku;
        $product->opening_stock = $this->opening_stock;
        $product->purchase_price = $this->purchase_price;
        $product->description = $this->description;
        $product->is_active = $this->is_active;
        $product->save();
        $this->dispatch('notify', [
            'type' => 'success',
            'title' => 'Success.',
            'message' => $this->product ? 'Product was updated' : 'Product was created.',
        ]);
        $this->resetInputFields();
        $this->dispatch('closemodal');
    }

    public function delete($id)
    {
        $this->product = null;
        $product = ProductSix::whereId($id)->first();
        if (!$product) {
            return;
        }
        $product->delete();
        $this->dispatch('notify', [
            'type' => 'success',
            'title' => 'Success.',
            'message' => ' Product was deleted.',
        ]);
    }

    public function edit($id)
    {
        $this->product = ProductSix::whereId($id)->first();
        $this->name = $this->product->name;
        $this->category_id = $this->product->category_id;
        $this->unit_id = $this->product->unit_id;
        $this->sku = $this->product->sku;
        $this->opening_stock = $this->product->opening_stock;
        $this->purchase_price = $this->product->purchase_price;
        $this->description = $this->product->description;
        $this->is_active = $this->product->is_active == 1 ? true : false;
        $this->resetErrorBag();
    }

    public function getCountOfProducts()
    {
        $start_date = Carbon::createFromFormat('Y-m-d', $this->start_date);
        $end_date = Carbon::createFromFormat('Y-m-d', $this->end_date);
        $period = CarbonPeriod::create($start_date, $end_date);

        $this->products_created = [];

        foreach ($period as $date) {
            $output = $date->format('Y-m-d');
            $products_count = ProductSix::whereDate('created_at', $output)->count();

            $product_data = [
                "count" => $products_count,
                'date' => $output,
            ];
            array_push($this->products_created, $product_data);
        }
    }
}
