<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/16
 * Time: 15:32
 */

namespace app\home\controller;


use think\Controller;
use \app\home\model\Category as CategoryModel;


class Category extends Controller
{
    public function showProduction(){
        //展示所有的商品信息
        /*
         * 缓存操作处理
         * */
//        $categoryModel = new CategoryModel();
//        $res = $categoryModel->select();  //不传递参数  默认查询所有
//        //并且我要关联一个模型 ， item  查询条件是 item.cid = 当前某一条数据的id
//        //var_dump($res->toArray());
//
//        //1。关联查询
//        $result = $categoryModel->with(['items'])->select();
//
//        //做一个处理
//        return json($result->toArray());

        $result = CategoryModel::getItemWithCategory();
        //return json($result);
        $this->assign('list',$result);
        return $this->fetch('category');
        //1. 写到 一个html中
//        return $this->fetch('test');
    }

    public function showItemProduct(){
        //根据id 显示商品
        return $this->fetch('item-list');
    }

}