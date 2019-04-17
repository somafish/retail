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
Route::get("home","admin/index/home");
Route::get("showInclude","admin/index/showInclude");

Route::get("home/showCategory","home/category/showProduction");
Route::get("home/Index","home/index/show");

