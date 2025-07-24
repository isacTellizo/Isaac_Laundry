<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductFour extends Model
{
    public function unit(){
        return $this->belongsTo(Unit::class,'unit_id','id');
    }
}
