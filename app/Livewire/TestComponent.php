<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Attributes\On;
use Livewire\Component;

class TestComponent extends Component
{
    public $todo, $todos = [] ;
    public $message = "No Product Saved";
    public function render()
    {
        return view('livewire.test-component');
    }

    public function addTodo()
    {
        array_push($this->todos , $this->pull('todo'));
    }

    #[On('ProductSaved')]
    public function showMessage(){
        $this->message = "Product Saved Now";
    }


}
