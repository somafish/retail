<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/27
 * Time: 9:42
 */

namespace app\admin\controller;

//视图引擎 所以要集成 controller 集成了视图
// 有多个 模块 api index admin
//index -> 前台 index.html -> index.css
//admin -> 后台 index.html -> index.css

use app\admin\validata\IndexValidata;
use app\admin\validata\XX;
use think\Controller;
use think\Db;
use think\Request;
use think\Session;
use think\Validate;

class Index extends Controller
{
    public function show(){
        //用于显示后台登录页面
        return $this->fetch("index");
    }

    public function test(){

        $result = Db::table("admin")->select();
        echo md5("somafish");
        var_dump($result);
    }

    //给后台管理员登陆的
    public function login(){
        $validata = new IndexValidata();
        $validata->goCheck();

        //说明 验证其通过了
        //去做其他操作
        $request = Request::instance();

//        //查询数据库
//        $username = $request->param("user");
//        $password  = $request->param("password");
//        $data = Db::query("select * from admin where username=? and password=?",
//            [$username,$password]);
//
//        var_dump($data);

        $queryResutl = Db::query("select * from admin where username=? and password=?",
            [$request->param("user"),$request->param("password")]);

        if($queryResutl != null){
            //转发 user -> 用于后面校验 用户是否登录
            Session::set("user",$request->param("user"));
            //重定向 30min
            $this->redirect("/home");
        }else{
            echo "用户名或者密码错误";
        }


    }

    public function home(){
        //如果没有登录 跳转到登录页面
        if(Session::get("user") == null || Session::get("user") == ""){
            $this->redirect("/admin");
        }
        return $this->fetch("home_index");
    }


    public function showInclude(){
        //返回home.html
        if(Session::get("user") == null || Session::get("user") == ""){
            $this->redirect("/admin");
        }
        return $this->fetch("home");
    }




}