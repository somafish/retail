<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/20
 * Time: 10:03
 */

namespace app\home\model;


use think\Model;
use think\Session;

class Product extends Model
{
    public static function getSupplierProductList(){
        $user = Session::get("user");
        $user = 1;
        return self::with(['productItem'])->where('uid',$user)->select()->toArray();
    }

    public function productItem(){
        //一对一  关联 item模型 查询 二级目录名称
        return $this->hasOne('Item','id','pid');
    }

    /**
     * 根据item的id 获取改二级目录下的商品， 一已经通过审核的商品...
     * @pid item表下的id
     */
    public static function getProductByItem($pid){
        return self::where('pid',$pid)->where('statu','1')->select()->toArray();
    }


    public static function getProductById($id){
        return  self::get(['id'=>$id,'statu'=>'1'])->hidden(['update_time','delete_time','tag'])->toArray();
    }

    public static function updateStock($id,$size){
        return self::where('id',$id)->setDec('stock',$size);
    }

}