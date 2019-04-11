<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/28
 * Time: 14:47
 */

namespace app\admin\validata;


class XX extends BaseValidata
{
    protected $rule = [
        'time' => 'time',
        //验证id
        'id' => 'CheckId'
    ];
}