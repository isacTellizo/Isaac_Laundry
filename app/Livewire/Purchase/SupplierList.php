<?php

namespace App\Livewire\Purchase;

use App\Models\Supplier;
use Livewire\Component;

class SupplierList extends Component
{
    public $name, $email, $phone, $tax_number, $opening_balance, $address, $is_active = true;
    public $suppliers,$supplier;
    public function render()
    {
        $this->suppliers = Supplier::latest()->get();
        return view('livewire.purchase.supplier-list');
    }

    public function resetInputFields()
    {
        $this->name = '';
        $this->email = '';
        $this->phone = '';
        $this->tax_number = '';
        $this->opening_balance = '';
        $this->address = '';
        $this->is_active = true;
    }
    public function save()
    {
        $this->validate([
            "name" => "required",
            "phone" => "required",
        ]);
        $supplier = new Supplier();
        $supplier->name = $this->name;
        $supplier->email = $this->email;
        $supplier->phone = $this->phone;
        $supplier->tax_number = $this->tax_number;
        $supplier->opening_balance = $this->opening_balance;
        $supplier->address = $this->address;
        $supplier->is_active = $this->is_active;
        $supplier->save();
        $this->dispatch('notify', [
            'type' => 'success',
            'title' => 'Success.',
            'message' => 'Supplier was created.',
        ]);
        $this->resetInputFields();
        $this->dispatch('closemodal');
    }

    public function delete($id) {
       
        $supplier = Supplier::whereId($id)->first();
        if (!$supplier) {
            return;
        }
        $supplier->delete();
        $this->dispatch('notify', [
            'type' => 'success',
            'title' => 'Success.',
            'message' => 'Supplier was deleted successfully.',
        ]);
    }

    public function edit($id)
    {
        $this->supplier = Supplier::whereId($id)->first();
        $this->name = $this->supplier->name;
        $this->email = $this->supplier->email;
        $this->phone = $this->supplier->phone;
        $this->tax_number = $this->supplier->tax_number;
        $this->opening_balance = $this->supplier->opening_balance;
        $this->address = $this->supplier->address;
        $this->is_active = $this->product->is_active == 1 ? true : false;
    }


}
