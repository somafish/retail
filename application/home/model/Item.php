<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/16
 * Time: 15:41
 */

namespace app\home\model;


use think\Model;

class Item extends Model
{
    protected $hidden=['delete_time','update_time'];

    public static function getItems($id){
        return self::where(["cid"=>$id])->select()->toArray();
    }

    /**
     * 关联查询，同时查询该item(二级目录下的商品)
     */
    public function getProduct(){
        return $this->hasMany('Product','pid','id');
    }

}