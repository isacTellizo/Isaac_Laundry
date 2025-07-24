<?php

namespace App\Livewire\Inventory;

use App\Models\Category;
use App\Models\ProductThree;
use App\Models\Unit;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductsThreeList extends Component
{
    public $name, $unit_id, $category_id, $sku, $purchase_price, $opening_stock, $description, $is_active = true, $toggle = true, $image;
    public $product, $products, $units, $categories, $search = '', $number_filter = null;
    public $selectedUnit, $selectedCategory = "all", $order_filter = "all";
    public $from_date, $to_date, $selected_items = [],$dateNow,$newDate;
    public $today,$yesterday,$addedYear,$carbonInterval;

    use WithFileUploads;

    public function render()
    {
        $query = ProductThree::latest();
        if ($this->search != '') {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('sku', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%')
                    ->orWhereHas('category', function($query2){
                        $query2->where('name','like','%'.$this->search.'%');
                    })
                    ->orWhereHas('unit',function($query3){
                        $query3->where('short_form','like','%'.$this->search.'%');
                    });
            });
        }
        // $query->where('is_active', $this->toggle);
        if ($this->selectedUnit) {
            $query->where('unit_id', $this->selectedUnit);
        }
        if ($this->selectedCategory != "all") {
            $query->where('category_id', $this->selectedCategory);
        }
        if ($this->from_date  && $this->to_date) {
            $query->whereDate('created_at', '>=', $this->from_date)->whereDate('created_at', '<=', $this->to_date);
        }
        if ($this->order_filter != 'all') {
            $query->reorder()->orderBy('name', $this->order_filter);
        }

        // $query->whereLike('name', '%Afsal%');
        // $this->products = $query->take($this->number_filter)->get();
        $this->products = $query->take($this->number_filter)->get();
        $this->units = Unit::latest()->get();
        $this->categories = Category::latest()->get();

        return view('livewire.inventory.products-three-list');
    }

    public function mount()
    {
        // $this->from_date = Carbon::today()->toDateString();
        // $this->to_date = Carbon::today()->toDateString();
        // $this->dateNow = Carbon::now();
        // $this->today = Carbon::today()->format("F j ,Y, g:i a");
        // $this->yesterday = Carbon::yesterday();
        // $this->addedYear = Carbon::now()->addYear(10);
        // $this->carbonInterval = CarbonInterval::months(5);
        // $this->newDate = $this->dateNow->add($this->carbonInterval);
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
        $this->image = null;
        $this->resetErrorBag();
    }


    public function save()
    {
        $this->validate([
            "name" => "required",
            "unit_id" => "required",
            "image" => 'nullable|image',
            "category_id" => "required",
            "sku" => "required|unique:product_threes,sku," . ($this->product->id ?? ''),
            "purchase_price" => "required|numeric|min:0",
            "opening_stock" => "nullable|numeric|min:0",
        ]);

        $product = new ProductThree();
        if ($this->product) {
            $product = $this->product;
        }
        $product->name = $this->name;
        if ($this->image) {
            $path = Storage::disk('public')->put('/uploads/productsThree', $this->image);
            $product->image = $path;
        }
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
            'message' => $this->product ? 'Product was updated' : 'Product was created.',
        ]);
        $this->resetInputFields();
        $this->dispatch('ProductSaved');
        $this->dispatch('closemodal');
    }

    public function delete($id)
    {
        $this->product = null;
        $product = ProductThree::whereId($id)->first();
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

    public function deleteSelected()
    {

        $selectedItems =  ProductThree::whereIn('id', $this->selected_items);
        if (!$selectedItems) {
            return;
        }
        $selectedItems->delete();
        $this->selected_items = [];
        $this->dispatch('notify', [
            'type' => 'success',
            'title' => 'Success.',
            'message' => 'Selected Products were deleted.',
        ]);
    }

    public function edit($id)
    {
        $this->product = ProductThree::whereId($id)->first();
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

    public function activeStatus($id)
    {
        $product = ProductThree::whereId($id)->first();
        $product->is_active = 1;
        $product->save();
    }
    public function inactiveStatus($id)
    {
        $product = ProductThree::whereId($id)->first();
        $product->is_active = 0;
        $product->save();
    }

    public function changeStatus($id)
    {
        $product = ProductThree::whereId($id)->first();
        if ($product->is_active) {
            $product->is_active = 0;
        } else {
            $product->is_active = 1;
        }
        $product->save();
    }
}
