<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use think\Route;

Route::get("api/:version/banner/:id","api/:version.Banner/getBanner");

Route::post("api/:version/test","api/:version.Banner/test");


Route::get("admin","admin/index/show");
Route::get("admin/home","admin/index/home");
Route::get("showInclude","admin/index/showInclude");

Route::get("home/showCategory","home/category/showProduction");
Route::get("home/Index","home/index/show");
Route::get("home/product","home/product/showItemProduct");
Route::get("home/supplier","home/supplier/showIndex");


Route::get("order/take/:id","home/order/showOrder");
Route::post("order/confirm","home/order/showConfirmOrder");
Route::post("order/pay","home/order/order");
Route::get("order/success","home/order/orderSuccess");
Route::get("order/showMyOrder","home/order/showMyOrder");
Route::get("order/showOrderContent","home/order/showOrderContent");

