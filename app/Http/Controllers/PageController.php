<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;
use App\Product;
use App\TypeProduct;

class PageController extends Controller
{
    //
    public function getIndex(){
        $slide=Slide::all();

        $new_product=Product::where('new',1)->paginate(4);
        $sp_sale=Product::where('promotion_price','<>',0)->paginate(8);
        return view('page.trangchu',compact('slide','new_product','sp_sale'));
    }

    public function getLoaiSP($type){
        $sp_theoloai=Product::where('id_type',$type)->get();
        $sp_khac=Product::where('id_type','<>',$type)->paginate(3);
        $loai=TypeProduct::all();
        $loai_sp=TypeProduct::where('id',$type)->first();
        return view('page.loaisanpham',compact('sp_theoloai','sp_khac','loai','loai_sp'));
    }

    public function getDetail(){
        return view('page.detail');
    }

    public function getContact(){
        return view('page.contact');
    }

    public function getAbout(){
        return view('page.about');
    }
}
