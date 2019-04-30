<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/25
 * Time: 11:48
 */

namespace app\home\controller;


use think\Controller;
use app\home\model\Product as ProductModel;
use think\Request;

class Product extends Controller
{
    public function showItemProduct(Request $request){
        //根据id 显示商品
        $list = ProductModel::getProductByItem($request->get('pid'));
        $this->assign('list',$list);
        return $this->fetch('item-list');
    }
}