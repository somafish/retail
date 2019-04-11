<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/14
 * Time: 12:24
 */

namespace app\api\controller\v1;

//定义 Banner Controller 类

use app\api\validata\MustBePositiveInteger;
use think\Controller;
use think\Request;
use think\Validate;

class Banner extends Controller
{
    public function getBanner($id){
        $requst = Request::instance();
        var_dump($requst->param());
        $ids = $requst->param("id");
        echo "from get method ids = " . $ids . "<br>";
        echo "this is come id = ". $id;
        $validata = new Validate([
            'name' => "require|max:8",
            'email' => "email"
        ]);

        $data = [
            'name' => "somafish",
            'email' => '50023427@qq.com'
        ];

        $result = $validata->batch()->check($data);
        if(!$result){
            echo "error message :". var_dump($validata->getError());
            echo "<br>";
        }
//        var_dump($result);

        //使用我们自己定义的验证器验证数据
        $requst = Request::instance();
        $validata_result = (new MustBePositiveInteger())->check($requst->param());
        if(!$validata_result){
            echo "验证失败！";
            echo "<br>";
            return;
        }
        return ["login"=>"success!"];
    }


    public function test(){
        return "test";
    }

    public function show(){
        //$this->>display('模板名称','要传递的参数');
        //index.html
        //index.tpl
        return $this->fetch('index');
    }


}