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

        $result = CategoryModel::getItemWithCategory();
        //return json($result);
        $this->assign('list',$result);
        return $this->fetch('category');
        //1. 写到 一个html中
//        return $this->fetch('test');
    }



}