<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('index',[
    'as'=>'trang-chu',
    'uses'=>'PageController@getIndex'
]);

Route::get('loai-san-pham/{type}',[
    'as'=>'loaisanpham',
    'uses'=>'PageController@getLoaiSP'
]);

Route::get('chi-tiet-san-pham/{id}',[
    'as'=>'chitiet_sanpham',
    'uses'=>'PageController@getDetail'
]);

Route::get('lien-he',[
    'as'=>'lienHe',
    'uses'=>'PageController@getContact'
]);

Route::get('gioi-thieu',[
    'as'=>'gioiThieu',
    'uses'=>'PageController@getAbout'
    ]);

Route::get('add-to-cart/{id}',[
    'as'=>'themGioHang',
    'uses'=>'PageController@getAddToCart'
]);

Route::get('del-cart/{id}',[
    'as'=>'xoaGioHang',
    'uses'=>'PageController@getDelItemCart'
]);

Route::get('dat-hang',[
    'as'=>'datHang',
    'uses'=>'PageController@getCheckOut'
]);

Route::post('dat-hang',[
    'as'=>'datHang',
    'uses'=>'PageController@postCheckOut'
]);

Route::get('dang-nhap',[
    'as'=>'login',
    'uses'=>'PageController@getLogin' 
]);

Route::get('dang-nhap',[
    'as'=>'login',
    'uses'=>'PageController@getLogin'
]);

Route::post('dang-nhap',[
    'as'=>'login',
    'uses'=>'PageController@postLogin'
]);

Route::get('dang-xuat',[
    'as'=>'logout',
    'uses'=>'PageController@postLogout'
]);

Route::get('dang-ky',[
    'as'=>'signup',
    'uses'=>'PageController@getSignUp'
]);

Route::post('dang-ky',[
    'as'=>'signup',
    'uses'=>'PageController@postSignUp'
]);

Route::get('search',[
    'as'=>'search',
    'uses'=>'PageController@getSearch'
]);