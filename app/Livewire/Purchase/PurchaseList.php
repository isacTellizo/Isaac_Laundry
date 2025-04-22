<?php

namespace App\Livewire\Purchase;

use App\Models\Purchase;
use Livewire\Component;

class PurchaseList extends Component
{
    public $purchases;
    public function render()
    {
        $this->purchases = Purchase::latest()->get();
        return view('livewire.purchase.purchase-list');
    }
}
