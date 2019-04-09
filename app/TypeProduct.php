<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeProduct extends Model
{
    //
    protected $table="type_products";

    //1 type_products có nhiều product
    public function products(){
        return $this->hasMany('App\Product','id_type','id');//id_type là khóa ngoại,id là khóa chính của bảng type_product
    }
}
