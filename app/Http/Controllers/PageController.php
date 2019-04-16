<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;
use App\Product;
use App\TypeProduct;
use App\Cart;
use Session;
use App\Customer;
use App\Bills;
use App\BillDetail;
use App\User;
use Hash;

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

    public function getDetail(Request $req){
        $sanpham=Product::where('id',$req->id)->first();
        $sp_tuongtu=Product::where('id_type',$sanpham->id_type)->paginate(6);
        return view('page.detail',compact('sanpham','sp_tuongtu'));
    }

    public function getContact(){
        return view('page.contact');
    }

    public function getAbout(){
        return view('page.about');
    }

    public function getAddToCart(Request $req,$id){
        $product=Product::find($id);//tìm xem có sản phẩm với tương ứng id hay không
        $oldCart=Session('cart')?Session::get('cart'):null;//Nếu có thì lấy thông tin sản phẩm, không thì = null
        $cart=new Cart($oldCart);//Khởi tạo giỏ hàng 
        $cart->add($product,$id);//Thêm phần từ vào giỏ hàng
        $req->session()->put('cart',$cart);//Gán cart vào session
        return redirect()->back();
    }

    public function getDelItemCart($id){//id của sản phẩm muốn xóa
        $oldCart=Session::has('cart')?Session::get('cart'):NULL;//Kiểm tra có hay không
        $cart=new Cart($oldCart);
        $cart->removeItem($id);
        //Kiểm tra để xóa đơn hàng
        if(count($cart->items)>0){
            Session::put('cart',$cart);
        }
        else Session::forget('cart');
        return redirect()->back();
    }

    public function getCheckOut(){
        if(Session('cart')){
            $oldCart=Session::get('cart');
            $cart=new Cart($oldCart);
            return view('page.dat_hang',['cart'=>Session::get('cart'),'product_cart'=>$cart->items,'totalPrice'=>$cart->totalPrice,'totalQty'=>$cart->totalQty]);
        }
        else return view('page.dat_hang');
        
    }

    public function postCheckOut(Request $req){

        $cart=Session::get('cart');

        $customer=new Customer;
        $customer->name=$req->name;
        $customer->gender=$req->gender;
        $customer->email=$req->email;
        $customer->address=$req->address;
        $customer->phone_number=$req->phone;
        $customer->note=$req->notes;
        $customer->save();

        $bill=new Bills;
        $bill->id_customer=$customer->id;
        $bill->date_order=date('Y-m-d');
        $bill->total=$cart->totalPrice;
        $bill->payment=$req->payment_method;
        $bill->note=$req->notes;
        $bill->save();
        

        foreach($cart->items as $key=>$value){
            $billDetail=new BillDetail;
            $billDetail->id_bill=$bill->id;
            $billDetail->id_product=$key;
            $billDetail->quantity=$value['qty'];
            $billDetail->unit_price=$value['price']/$value['qty'];
            $billDetail->save();
        }

        Session::forget('cart');
        return redirect()->back()->with('thongBao','Đặt hàng thành công');
    }

    public function getLogin(){
        return view('page.dangnhap');
    }

    public function getSignUp(){
        return view('page.dangky');
    }

    public function postSignUp(Request $req){
        $this->validate($req,
        [
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:6|max:20',
            'fullname'=>'required',
            're_password'=>'required|same:password'
        ],
        [
            'email.required'=>'Vui lòng nhập email',
            'email.email'=>'Không đúng định daijng email',
            'email.enique'=>'Email này đã được sử dụng',
            'password.required'=>'Vui lòng nhập mật khẩu',
            'password.min'=>'Mật khẩu tối thiểu 6 kí tự',
            'password.max'=>'Mật khẩu tối đa 20 kí tự',
            'fullname.required'=>'Hãy nhập vào họ tên',
            're_password.required'=>'Hãy nhập lại mật khẩu',
            're_password.same'=>'Mật khẩu không giống nhau'
        ]     
        );
        $user=new User;
        $user->full_name=$req->fullname;
        $user->address=$req->address;
        $user->phone=$req->phone;
        $user->password=Hash::make($req->password);//mã hóa mật khẩu
        $user->save();

        return redirect()->back()->with('success','Đã tạo tài khoản thành công');
        
    }

    public function getSearch(Request $req){
        $product=Product::where('name','like','%'.$req->key.'%')
                        ->orWhere('unit_price',$req->key)
                        ->get();
        return view('page.search',compact('product'));
    }
}
