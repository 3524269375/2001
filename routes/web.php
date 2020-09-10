<?php

use Illuminate\Support\Facades\Route;

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
//品牌展示
Route::get('/brand','Admin\BrandController@index')->name('brand');
//品牌添加
Route::get('/brand/create','Admin\BrandController@create')->name('brand.create');
//品牌执行添加
Route::post('/brand/store','Admin\BrandController@store');
//获取图片地址
Route::post('/brand/upload','Admin\BrandController@upload');
//品牌修改
Route::get('/brand/edit/{brand_id}','Admin\BrandController@edit')->name('brand.edit');
//品牌执行修改
Route::post('/brand/update/{brand_id}','Admin\BrandController@update');
//品牌删除
Route::get('/brand/delete/{brand_id?}','Admin\BrandController@destroy');
//即点即改
Route::get('/brand/change','Admin\BrandController@change');
