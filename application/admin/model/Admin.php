<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/18
 * Time: 16:08
 */

namespace app\admin\model;


use think\Model;
use think\Request;

class Admin extends Model
{
    public static function Login(Request $request){
        $passowrd = $request->post("password");
        $passowrd = md5($passowrd);
        return self::get(['username'=>$request->post('username'),'password'=>$passowrd]);
    }
}