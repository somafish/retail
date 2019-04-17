<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/16
 * Time: 16:31
 */

namespace app\home\controller;


use app\home\model\Item;
use think\Controller;

class Index extends Controller
{

    public function show(){
        return $this->fetch('index');
    }

    public function test(){
        $item = new Item();
//        $result = $item->select();
        $result = $item->where('cid',4)
            ->where('id',2)
            ->select();
        //条件 就是 主键 == 传递进来的值
        //select * from item where key(id)=1   有条件下
        // select * from item
        $arr = $result->toArray();
        var_dump($arr);
    }

}