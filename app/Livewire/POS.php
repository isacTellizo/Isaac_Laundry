<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use PhpParser\Node\Expr\FuncCall;

class POS extends Component
{
    public $products = [], $cart = [], $tax_percentage = 18, $base_total, $tax_total;
    public $cart_data = [
        'tax_percentage' => 0,
        'tax_total' => 0,
        'taxable_amount' => 0,
        'sub_total' => 0,
        'total_discount' => 0,
        'total' => 0,
    ];
    public $categories, $categoryFilter = "all";

    public function render()
    {
        $query = Product::latest();
        if ($this->categoryFilter != "all") {
            $query->where('category_id', $this->categoryFilter);
        }
        $this->products = $query->get();
        return view('livewire.p-o-s');
    }

    public function mount()
    {
        $this->categories = Category::latest()->get();
    }

    public function changeCategory($id)
    {
        $this->categoryFilter = $id;
    }


    public function addItem(Product $product)
    {
        $item_key = null;
        foreach ($this->cart as $key => $item) {
            if ($item['id'] == $product->id) {
                $item_key = $key;
            }
        }
        if ($item_key !== null) {
            $this->cart[$item_key]['quantity']++;
            $this->calculateTotal();
            return;
        }
        $cartItem = [
            'product' => $product,
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->purchase_price,
            'quantity' => 1,
            'tax_total' => 0,
            'tax_percentage' => $this->tax_percentage,
            'discount' => 0,
            "total" => 0
        ];

        array_push($this->cart, $cartItem);
        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $sub_total = 0;
        $total_discount = 0;
        $total_tax = 0;
        $taxable_amount = 0;
        $item_total = 0;

        foreach ($this->cart as $key => $item) {
            $item_base_total =  (float)$item['quantity'] * (float)$item['price'];
            $item_tax_total = $item_base_total * ($this->tax_percentage / 100);
            $local_item_total = ($item_base_total + $item_tax_total) -  ((float)$item['discount'] ?? 0);


            $total_discount += $item['discount'];
            $item_total += $local_item_total;
            $total_tax += $item_tax_total;
            $taxable_amount += $item_base_total;
            $sub_total += $item_base_total;

            $this->cart[$key]['total'] = $local_item_total;
            $this->cart_data['tax_percentage'] = $this->tax_percentage;
            $this->cart_data['tax_total'] = $total_tax;
            $this->cart_data['taxable_amount'] = $taxable_amount;
            $this->cart_data['sub_total'] = $sub_total;
            $this->cart_data['total_discount'] = $total_discount;
            $this->cart_data['total'] = $item_total;
        }
    }

    public function removeItem($id)
    {
        array_splice($this->cart, $id, 1);
        $this->calculateTotal();
    }
}
