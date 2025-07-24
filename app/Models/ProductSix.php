<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSix extends Model
{
    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function unit(){
        return $this->belongsTo(Unit::class,"unit_id",'id');
    }
}
