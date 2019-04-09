<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table="products";

    public function type_products(){
        return $this->belongsTo('App\TypeProduct','id_type','id');//id là khóa chính của bảng product
    }

    public function bill_details(){
        return $this->hasMany('App\BilllDetail','id_product','id');
    }
}
