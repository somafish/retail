<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/28
 * Time: 14:29
 */

namespace app\admin\validata;



class IndexValidata extends BaseValidata
{
    //自定义的方式 可以自定义 tp5 里面没有的验证规则
    protected $rule = [
        'user' => 'require|email', //内置的严重规则
        'password' => 'require|alphaNum', //
//        'id' => 'CheckId', //上传的id 自动段 必须为 正整数
    ];

    //读取用户的时间  验证用户上传的 时间格式 是否正确

    protected $message = [
        'user.require' => '用户名不能为空',
        'user.email' => '输入的邮箱格式不正确',
        'password.require' => '密码一定不能为空',
        'password.alphaNum' => '密码必须为数字和字母的组合'
    ];



}