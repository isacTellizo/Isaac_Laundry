<?php

namespace App\Livewire;

use App\Models\CategoryFive;
use Carbon\Carbon;
use GuzzleHttp\Promise\Create;
use Livewire\Component;

class CategoryFiveList extends Component
{
    public $name, $description, $is_active = true, $status_filter = "1";
    public $categories, $search = '';
    public function render()
    {
        $query = CategoryFive::latest();
        if ($this->search != '') {
            $query->where('name', 'like', '%' . $this->name . '%');
        }
        $query->where('is_active', $this->status_filter == '1' ? 1 : 0);
        $date_filter = Carbon::today();
        $query->whereDate('created_at',$date_filter);
        $this->categories = $query->get();
        return view('livewire.category-five-list');
    }

    public function save()
    {
        $category = CategoryFive::create([
            "name" => 'Isaac',
            "description" => 'sample description',
            "is_active" =>  1,
        ]);
    }
}
