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


}