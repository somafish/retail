<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

/**
 * 返回加盐后的密码
 * @param $pwd
 * @return string
 */
function getPassword($pwd){
    return md5(md5($pwd)."jsnfio32.12@sd/");
}

/**
 * 加盐后的支付密码
 * @param $paycode
 * @return string
 */
function getPayCode($paycode){
    return md5(md5($paycode)."lrmc@()^@#$@sd/");
}