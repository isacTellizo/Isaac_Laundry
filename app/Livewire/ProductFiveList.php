<?php

namespace App\Livewire;

use App\Models\CategoryFive;
use App\Models\ProductFive;
use Livewire\Component;

class ProductFiveList extends Component
{
    public $products,$categories;
    public function render()
    {
        $this->products = ProductFive::orderBy('name', 'ASC')->latest()->get();
        return view('livewire.product-five-list');
    }

    public function mount(){
        $this->categories = CategoryFive::where('is_active',1)->latest()->get();
    }
}
