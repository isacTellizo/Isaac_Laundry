<?php

namespace App\Livewire\Inventory;

use App\Models\Unit;
use Livewire\Component;

class Units extends Component
{
    public $name, $short_form, $description, $is_active = true;
    public $units, $unit, $search = '';
    public function render()
    {
        $query = Unit::latest();
        if ($this->search != '') {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('short_form', 'like', '%' . $this->search . '%');
            });
        }
        $this->units = $query->get();
        return view('livewire.inventory.units');
    }
    public function resetInputFields()
    {
        $this->name = '';
        $this->short_form = '';
        $this->description = '';
        $this->is_active = true;
        $this->unit = null;
        $this->resetErrorBag();
    }
    public function save()
    {
        $this->validate([
            "name" => "required",
            "short_form" => "required",
        ]);

        if ($this->unit) {
            $unit = $this->unit;
        } else {
            $unit = new Unit();
        }
        $unit->name = $this->name;
        $unit->short_form = $this->short_form;
        $unit->description = $this->description;
        $unit->is_active = $this->is_active;
        $unit->save();
        $this->dispatch('notify', [
            'type' => 'success',
            'title' => 'Success.',
            'message' => 'Unit was created.',
        ]);
        $this->resetInputFields();
        $this->dispatch('closemodal');
    }

    public function delete($id)
    {
        $unit = Unit::whereId($id)->first();
        if (!$unit) {
            return;
        }
        $unit->delete();
        $this->dispatch('notify', [
            'type' => 'success',
            'title' => 'Success.',
            'message' => 'Unit was deleted successfully.',
        ]);
    }

    public function edit($id)
    {
        $this->unit = Unit::whereId($id)->first();
        $this->name = $this->unit->name;
        $this->short_form = $this->unit->short_form;
        $this->description = $this->unit->description;
        $this->is_active = $this->unit->is_active == 1 ? true : false;
    }
}
