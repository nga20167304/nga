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