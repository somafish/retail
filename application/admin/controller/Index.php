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

use app\libs\exception\RoutineMessage;
use think\Controller;
use think\Db;
use think\Request;
use think\Session;
use app\admin\model\Admin as AdminModel;

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
    public function login(Request $request){

        $user = AdminModel::Login($request);
        $msg = new RoutineMessage();

        if ($user == null){
            $msg->msg = "Login Fail please check your password@username";
            $msg->flag = false;
        }else{
            Session::set("user",$request->post("username"));
        }

        return json($msg,$msg->code);
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