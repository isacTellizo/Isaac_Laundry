<?php

namespace App\Livewire;

use Livewire\Component;

class ArrayTask1 extends Component
{
    public $name, $cart = [], $secondCart = [], $id = 0;
    public $edit_key;
    public function render()
    {
        return view('livewire.array-task1');
    }
    public function addItem()
    {
        $cartItem = [
            "id" => $this->id,
            "name" => $this->name,
        ];
        $this->id++;
        array_push($this->cart, $cartItem);
        $this->name = '';
    }
    public function removeItem($itemId, $key,)
    {
        array_splice($this->cart, $key, 1);
        $output = array_filter($this->secondCart, function ($item) use ($itemId) {
          return  $item['id'] != $itemId;
        });

        $this->secondCart = $output;
    }

    public function addSecondItem($key)
    {
        $secondCartItem = [
            "id" => $this->cart[$key]["id"],
            "name" => $this->cart[$key]['name'],

        ];
        array_push($this->secondCart, $secondCartItem);
    }

    public function removeSecondItem($key)
    {
        array_splice($this->secondCart, $key, 1);
    }

    public function editSecondItem($key)
    {
        $this->name = $this->secondCart[$key]['name'];
        $this->edit_key = $key;
    }

    public function updateSecondItem()
    {
        $this->secondCart[$this->edit_key]['name'] = $this->name;
        $this->name = '';
        $this->edit_key = null;
    }
}
