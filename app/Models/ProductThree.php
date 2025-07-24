<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductThree extends Model
{
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function photo()
    {
        if ($this->image && file_exists(public_path($this->image))) {

            return asset($this->image);
        } else {
            return asset('assets/img/not-found.png');
        }
    }
}
