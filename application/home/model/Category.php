<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/16
 * Time: 15:33
 */

namespace app\home\model;


use think\Model;

class Category extends Model
{

//    //关联方法
//    public function items(){
//        return $this->hasMany('item','cid','id');
//    }

    public function item(){
        //关联查询item表
        return $this->hasMany('Item','cid','id');
    }

    public static function getCategory(){
        return self::select()->toArray();
    }

    public static function getItemWithCategory($fill = true){
        $result = self::with(['item'])->select();
        $result = $result->toArray();
        if($fill){
            for($i = 0; $i < count($result); $i++){
                $size = count($result[$i]['item']);
                if($result[$i]['item'] != null && $size > 0 && $size%5 != 0){
                    //为数组添加数据
                    $add = $size%5;
                    for ($j=$add; $j < 5; $j++){
                        array_push($result[$i]['item'],[]);
                    }
                }
            }
        }

        return $result;
    }

    public static function getCategoryWithItemWithPorcut(){
        return self::with(['item','item.getProduct'])->select()->toArray();
    }



}