<?php

namespace App\Livewire\Purchase;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\PurchasePayment;
use App\Models\Supplier;
use Carbon\Carbon;
use Livewire\Component;

class PurchaseManage extends Component
{
    public $suppliers, $supplier, $name, $phone, $email, $tax_number, $address, $is_active = 1, $opening_balance, $search_supplier = '';
    public $selected_supplier, $supplier_id, $supplier_query;
    public $products = [], $selected_products = [], $product_query, $product_data = [];
    public $invoice_number, $invoice_date, $purchase_number, $purchase_date, $notes, $remarks, $payment_method;
    public $purchase, $purchase_details, $purchase_payment;
    public $paid_amount;
    public function render()
    {
        return view('livewire.purchase.purchase-manage');
    }
    public function mount($id = null)
    {
        if ($id) {
            $this->purchase = Purchase::whereId($id)->first();
            $this->invoice_number = $this->purchase->invoice_number;
            $this->invoice_date = $this->purchase->invoice_date;
            $this->selected_supplier = Supplier::find($this->purchase->supplier_id);

            $this->purchase_details = PurchaseDetail::where('purchase_id', $id)->get();
            $this->selected_products = [];

            foreach ($this->purchase_details as $item) {
                $this->selected_products[] = [
                    'id' => $item->product_id,
                    'name' => $item->product_name,
                    'quantity' => $item->quantity,
                    'rate' => $item->rate,
                    'discount' => $item->discount ?? 0,
                    'tax' => $item->tax_amount ?? 0,
                    'total' => $item->total,
                ];
            }
            $this->purchase_payment = PurchasePayment::where('purchase_id', $id)->first();
            $this->paid_amount = $this->purchase_payment->paid_amount ?? 0;
            $this->payment_method = $this->purchase_payment->payment_method ?? 1;
            $this->notes = $this->purchase_payment->note ?? '';
            $this->remarks = $this->purchase_payment->payment_remarks ?? '';

            $this->purchase_number = $this->purchase->purchase_number;
            $this->purchase_date = $this->purchase->purchase_date;
        } else {
            $this->invoice_date =  Carbon::today()->toDateString();
            $last_purchase_number = Purchase::latest('id')->first();
            $this->purchase_number = $last_purchase_number ? $last_purchase_number->purchase_number + 1 : 1;
            $this->purchase_date = Carbon::today()->toDateString();
        }

        $this->calculateTotal();
    }
    public function resetFields()
    {
        $this->name = '';
        $this->phone = '';
        $this->email = '';
        $this->tax_number = '';
        $this->address = '';
        $this->is_active = true;
        $this->opening_balance = '';
        $this->resetErrorBag();
    }

    public function addSupplier()
    {
        $this->validate([
            'name'  => 'required',
            'phone'  => 'required',
            "opening_balance" => "nullable|numeric|min:0",
            "tax_number" => "nullable|numeric|min:0",
        ]);
        if ($this->opening_balance == '' || $this->opening_balance == null) {
            $this->opening_balance = 0;
        }
        if ($this->email == '') {
            $this->email = null;
        }
        $supplier = new Supplier();
        $supplier->name = $this->name;
        $supplier->phone = $this->phone;
        $supplier->email = $this->email;
        $supplier->tax_number = $this->tax_number;
        $supplier->address = $this->address;
        if ($this->opening_balance == '') {
            $this->opening_balance = 0;
        }
        $supplier->opening_balance = $this->opening_balance;
        $supplier->is_active = $this->is_active;
        $supplier->save();
        $this->resetFields();
        $this->selectSupplier($supplier->id);
        $this->dispatch('closemodal');
        $this->dispatch('notify', [
            'type' => 'success',
            'title' => 'Success.',
            'message' => 'Product was created.',
        ]);
    }

    public function updated($name, $value)
    {
        if ($name == 'supplier_query' && $value != '') {
            $this->suppliers = Supplier::where(function ($query) use ($value) {
                $query->where('name', 'like', '%' . $value . '%')->orWhere('phone', 'like', '%' . $value . '%');
            })->latest()->limit(5)->get();
        } elseif ($name == 'supplier_query' && $value == '') {
            $this->suppliers = collect();
        }

        if ($name == 'product_query' && $value != '') {
            $this->products = Product::where('name', 'like', '%' . $value . '%')->latest()->limit(5)->get();
        } elseif ($name == 'product_query' && $value == '') {
            $this->products = collect();
        }
    }

    public function updatedSelectedProducts()
    {
        $this->calculateTotal();
    }

    public function selectSupplier($id)
    {
        $this->selected_supplier = Supplier::where('id', $id)->first();
        $this->supplier_query = '';
        $this->suppliers = collect();
    }

    public function selectProduct($id)
    {
        $product = Product::where('id', $id)->first();
        $product_index = null;
        foreach ($this->selected_products as $index => $item) {
            if ($item['id'] == $product->id) {
                $product_index = $index;
            }
        }
        if ($product_index !== null) {
            $this->selected_products[$product_index]['quantity'] = $this->selected_products[$product_index]['quantity'] + 1;
            $this->calculateTotal();
            return;
        }
        $selected_products = [
            'product' => $product,
            'id' => $product->id,
            'name' => $product->name,
            'quantity' => 1,
            'rate' => $product->purchase_price,
            'discount' => 0,
            'tax' => 0,
            'total' => $product->purchase_price,
        ];
        array_push($this->selected_products, $selected_products);
        $this->product_query = '';
        $this->products = collect();
        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $this->product_data = [];
        $this->product_data['sub_total'] = 0;
        $this->product_data['discount'] = 0;
        $this->product_data['tax_amount'] = 0;
        $this->product_data['taxable_amount'] = 0;
        $this->product_data['total'] = 0;

        foreach ($this->selected_products as $index => $product) {
            $grossPrice = ((float)$product['rate'] * (float)$product['quantity']);
            $unitPrice = $grossPrice;
            $itemTax = $grossPrice;
            $itemTotal = $grossPrice - (float)$product['discount'];

            $this->product_data['sub_total'] += $grossPrice;
            $this->product_data['tax_amount'] += $itemTax;
            $this->product_data['total'] += $itemTotal;
            $this->product_data['discount'] += (float)$product['discount'];

            $this->selected_products[$index]['total'] = $itemTotal;
            $this->selected_products[$index]['tax_amount'] = $itemTax;
            $this->selected_products[$index]['taxable_amount'] = $unitPrice;
        }
        $this->paid_amount = $this->product_data['total'];
    }
    public function removeProduct($index)
    {
        unset($this->selected_products[$index]);
        $this->calculateTotal();
    }

    public function resetAll()
    {
        $this->selected_products = [];
        $this->selected_supplier = '';
        $this->supplier_query = '';
        $this->product_query = '';
        $this->paid_amount = '';
        $this->payment_method = '';
        $this->invoice_number = '';
    }
    public function save()
    {
        if (!$this->selected_supplier) {
            $this->dispatch('notify', [
                'type' => 'error',
                'title' => 'Error.',
                'message' => 'Select A Supplier',
            ]);
            return;
        }
        $totalQty = 0;
        foreach ($this->selected_products as $product) {
            $totalQty += $product['quantity'];
        }
        if ($this->purchase) {
            $this->validate([
                "paid_amount" => "required",
                "payment_method" => "required",
                "invoice_number" => "required|unique:purchases,invoice_number," . $this->purchase->id,
                "invoice_date" => "required",
                "selected_products" => "required",
            ]);
            $purchase = $this->purchase;
        } else {
            $this->validate([
                "paid_amount" => "required",
                "payment_method" => "required",
                "invoice_number" => "required|unique:purchases,invoice_number",
                "invoice_date" => "required",
            ]);
            $purchase = new Purchase();
        }
        $purchase->purchase_date = $this->purchase_date;
        $purchase->purchase_number = $this->purchase_number;
        $purchase->invoice_number = $this->invoice_number;
        $purchase->invoice_date = $this->invoice_date;
        $purchase->supplier_name = $this->selected_supplier->name;
        $purchase->supplier_id = $this->selected_supplier->id;
        $purchase->discount = 0;
        $purchase->discount_total = $this->product_data['discount'] ?? 0;
        $purchase->sub_total = $this->product_data['sub_total'] ?? 0;
        $purchase->tax_amount =  0;
        $purchase->tax_percentage =  0;
        $purchase->total = $this->product_data['total'] ?? 0;
        $purchase->status = 1;
        $purchase->notes = $this->notes;
        $purchase->total_quantity = $totalQty;
        $purchase->created_by = 1;
        $purchase->financial_year_id = null;
        $purchase->save();

        if ($this->purchase_details) {
            PurchaseDetail::where('purchase_id', $this->purchase->id)->delete();
        }

        foreach ($this->selected_products as $product) {
            $purchase_detail = new PurchaseDetail();
            $purchase_detail->purchase_id = $purchase->id;
            $purchase_detail->type = 1;
            $purchase_detail->quantity = $product['quantity'] ?? 1;
            $purchase_detail->product_id = $product['id'];
            $purchase_detail->product_name = $product['name'];
            $purchase_detail->rate = $product['rate'] ?? 0;
            $purchase_detail->purchase_price = $product['rate'] ?? 0;
            $purchase_detail->total = $product['total'] ?? 0;
            $purchase_detail->discount = $product['discount'] ?? 0;
            $purchase_detail->tax_percentage = 0;
            $purchase_detail->tax_amount = $product['tax_amount'];
            $purchase_detail->save();
        }

        if ($this->purchase_payment) {
            $purchase_payment = $this->purchase_payment;
        } else {
            $purchase_payment = new PurchasePayment();
        }
        $purchase_payment->purchase_id = $purchase->id;
        $purchase_payment->supplier_id = $purchase->supplier_id;
        $purchase_payment->paid_amount = $this->paid_amount;
        $purchase_payment->payment_method = $this->payment_method;
        $purchase_payment->note = $this->notes;
        $purchase_payment->payment_remarks = $this->remarks;
        $purchase_payment->created_by = $purchase->created_by;
        $purchase_payment->save();
        $this->resetAll();
        $this->dispatch('notify', [
            'type' => 'success',
            'title' => 'Success.',
            'message' => 'Purchase Saved.',
        ]);
        return redirect()->route('purchase.list');
    }
}
