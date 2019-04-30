<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/29
 * Time: 22:23
 */

namespace app\home\model;


use think\Model;

class User extends Model
{

    public static function pay($money,$uid){
        self::where('id',$uid)->update(['money'=>$money]);
    }
}