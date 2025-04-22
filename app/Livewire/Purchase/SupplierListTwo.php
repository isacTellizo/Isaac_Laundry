<?php

namespace App\Livewire\Purchase;

use App\Models\SupplierTwo;
use Livewire\Component;

class SupplierListTwo extends Component
{
    public $name, $phone, $email, $tax_number, $opening_balance, $address, $is_active = true;
    public $supplier, $suppliers;
    public function render()
    {
        $this->suppliers = SupplierTwo::latest()->get();
        return view('livewire.purchase.supplier-list-two');
    }

    public function resetInputFields()
    {
        $this->name = "";
        $this->phone = "";
        $this->email = "";
        $this->tax_number = "";
        $this->opening_balance = null;
        $this->address = "";
        $this->is_active = true;
        $this->supplier = null;
        $this->resetErrorBag();
    }

    public function save()
    {
        $this->validate([
            "name" => "required",
            "phone" => "required|numeric",
            "opening_balance" => "nullable|numeric|min:0",
        ]);
        $supplier = new SupplierTwo();
        if ($this->supplier) {
            $supplier = $this->supplier;
        }
        $supplier->name = $this->name;
        $supplier->phone = $this->phone;
        $supplier->email = $this->email;
        $supplier->tax_number = $this->tax_number;
        $supplier->opening_balance = $this->opening_balance;
        $supplier->address = $this->address;
        $supplier->is_active = $this->is_active;
        $supplier->save();
        $this->dispatch('notify', [
            'type' => 'success',
            'title' => 'Success.',
            'message' => $this->supplier ? 'Supplier was updated.' : 'Supplier was created',
        ]);
        $this->resetInputFields();
        $this->dispatch('closemodal');
    }

    public function delete($id)
    {
        $this->supplier = null;
        $supplier = SupplierTwo::whereId($id)->first();
        if (!$supplier) {
            return;
        }
        $supplier->delete();
        $this->dispatch('notify', [
            'type' => 'success',
            'title' => 'Success.',
            'message' => 'Supplier was deleted.',
        ]);
    }

    public function edit($id)
    {
        $this->supplier =  SupplierTwo::whereId($id)->first();
        $this->name = $this->supplier->name;
        $this->phone = $this->supplier->phone;
        $this->email = $this->supplier->email;
        $this->tax_number = $this->supplier->tax_number;
        $this->opening_balance = $this->supplier->opening_balance;
        $this->address = $this->supplier->address;
        $this->is_active = $this->supplier->is_active == 1 ? true : false;
        $this->resetErrorBag();
    }
}
