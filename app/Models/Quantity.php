<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quantity extends Model
{
    use HasFactory;

    
    protected $guarded = [];

    public function product(){
    	return $this->belongsToMany(Product::class,'product_id','id');
    }

    public function size(){
    	return $this->belongsToMany(Size::class,'size_id','id');
    }
}
