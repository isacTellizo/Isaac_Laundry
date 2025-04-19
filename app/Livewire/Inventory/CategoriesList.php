<?php

namespace App\Livewire\Inventory;

use App\Models\Category;
use Livewire\Component;

class CategoriesList extends Component
{
    public $name, $description, $is_active = true;
    public $category, $categories, $search = '';
    public function render()
    {
        $query = Category::latest();
        if ($this->search != '') {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('short_form', 'like', '%' . $this->search . '%');
            });
        }
        $this->categories = $query->get();
        return view('livewire.inventory.categories-list');
    }
    public function resetInputFields()
    {
        $this->name = '';
        $this->description = '';
        $this->is_active = true;
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
            $category = new Category();
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
        $category = Category::whereId($id)->first();
        if (!$category) {
            return;
        }
        $category->delete();
        $this->dispatch('notify', [
            'type' => 'success',
            'title' => 'Success.',
            'message' => 'Category was deleted successfully.',
        ]);
    }
    public function edit($id)
    {
        $this->category = Category::whereId($id)->first();
        $this->name = $this->category->name;
        $this->description = $this->category->description;
        $this->is_active = $this->category->is_active == 1 ? true : false;
    }
}
