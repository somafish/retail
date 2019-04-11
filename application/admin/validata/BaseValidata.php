<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/28
 * Time: 14:47
 */

namespace app\admin\validata;


use app\libs\exception\ParamException;
use think\Validate;
use think\Request;

class BaseValidata extends Validate
{

    public function goCheck(){
        $request = Request::instance()->param();
        //$result = $validate->batch()->check($request);
        return $this->batch()->check($request);
    }

    protected function CheckId($value,$rule,$data){

        //实现我自己的验证规则

        if(is_numeric($value) && is_integer($value + 0) && ($value+0 > 0)){
//            echo "success !";
            return true;
        }else{
            //未通过验证。直接抛出异常了
            $this->error = "输入的id必须为大于0的正整数";
            $exceptions = new ParamException();
            $exceptions->msg = $this->getError();
            $exceptions->code = 400;
            $exceptions->errorCode = 40001;
            throw $exceptions;
        }
        return false;

    }
}