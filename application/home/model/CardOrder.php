<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/29
 * Time: 22:16
 */

namespace app\home\model;


use think\Model;

class CardOrder extends Model
{



    public static function queryDateTimeIn($start,$end,$uid){
        //todo 根据订单号 查询数据库
    }

    public function getSnapAttr($value){
        return json_decode($value,true);
    }

    /**
     * 查询指定范围的用户订单数据
     * @param $start
     * @param $end
     * @param $uid
     * @return false|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public static function getRecentlyOrderRecoder($start,$end,$uid){
        return self::where('place_time','>=',$start)->where('place_time','<=',$end)
            ->where('uid',$uid)->order('id','desc')->select();
    }
}