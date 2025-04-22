<?php

namespace App\Livewire\Inventory;

use App\Models\CategoryNew;
use Livewire\Component;

class Categories extends Component
{
    public $name, $description, $is_active = true;
    public $categories, $category;
    public function render()
    {
        $this->categories = CategoryNew::latest()->get();
        return view('livewire.inventory.categories');
    }
    public function resetInputFields()
    {
        $this->name = '';
        $this->description = '';
        $this->is_active = true;
        $this->category = null;
        $this->resetErrorBag();
    }

    public function save()
    {
        $this->validate([
            "name" => "required",
        ]);
        if ($this->category) {
            $category = $this->category;
        } else {
            $category = new CategoryNew();
        }
        $category->name = $this->name;
        $category->description = $this->description;
        $category->is_active = $this->is_active;
        $category->save();
        $this->dispatch('notify', [
            'type' => 'success',
            'title' => 'Success.',
            'message' => 'Category was created.',
        ]);
        $this->resetInputFields();
        $this->dispatch('closemodal');
    }

    public function delete($id)
    {
        $this->category = null;
        $category = CategoryNew::whereId($id)->first();
        if (!$category) {
            return;
        }
        $category->delete();
        $this->dispatch('notify', [
            'type' => 'success',
            'title' => 'Success.',
            'message' => 'Category was deleted.',
        ]);
    }

    public function edit($id)
    {
        $this->category = CategoryNew::whereId($id)->first();
        $this->name = $this->category->name;
        $this->description = $this->category->description;
        $this->is_active = $this->category->is_active == 1 ? true : false;
        $this->resetErrorBag();
    }
}
