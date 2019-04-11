<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
//use think\Test;

// $test = new Test();

//$test = \think\Test\Test();
//Test.php
// namespace think\Test;

class Index extends Controller
{


//(无参数)
//(有参数 Request )
    public function index(Request $request)
    {
//        return "Hello World!";
        //return '<style type="text/css">*{ padding: 0; margin: 0; } .think_default_text{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p> ThinkPHP V5<br/><span style="font-size:30px">十年磨一剑 - 为API开发设计的高性能框架</span></p><span style="font-size:22px;">[ V5.0 版本由 <a href="http://www.qiniu.com" target="qiniu">七牛云</a> 独家赞助发布 ]</span></div><script type="text/javascript" src="https://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script><script type="text/javascript" src="https://e.topthink.com/Public/static/client.js"></script><think id="ad_bd568ce7058a1091"></think>';
        //1.怎么获取 请求的数据
        Request::instance()->get();
        $param = $request->param();
        $domain = $request->domain();
        echo "域名：" . $domain;
        echo "<br>";
        echo 'root:' . $request->root() . '<br/>';
        //post name=123
//        $post = $request->(); // 只获取 post 船体过来的参数
//        echo "POst param";
//        var_dump($post);

        var_dump($param);
    }
    public function test($id,$ids){
//        echo "id:".$id;
//        echo "ids".$ids;
//        $param = Request::instance()->get('id');
//        var_dump($param);
        //头信息
        $header = Request::instance()->header();
        var_dump($header);
        //api的时候 token 令牌  携带在头信息里面
        // 令牌 是你服务器 颁发给客户端的  有一个失效期 2小时
        // onCreate 方法 -》服务器获取令牌
    }


    //关于数据库
    //1. Mysql
    //mysql_connction  mysql_query  mysqli_
    //封装了一个构建器 PDO-> 对原生的 mysql_ 函数进行封装


    //关于日志
    // 自动记录
    // 如果你开启了 调试模式【开发模式】
    //[app_debug => true] 自动的 记录日志
    // 日志 默认的文件目录 runtime/ log
    // 记录日志 会消耗 1->记录一次
    // 1-> 0.01M内存 10000-> 项目上线以后 一定关闭
    // 如果 你在开发模式下 又不想 记录

    public function show(){
        //显示首页
        return $this->fetch("index");
    }
}
