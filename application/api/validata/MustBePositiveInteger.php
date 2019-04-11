<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/14
 * Time: 12:41
 */

namespace app\api\validata;


use app\libs\exception\ParamException;
use think\Exception;
use think\Validate;

class MustBePositiveInteger extends Validate
{
    protected $rule = [
        'id' => "require|isPositiveInteger"
    ];

    protected function isPositiveInteger($value, $rule, $data ,$field=''){
//        echo "test print all data <br>";
//        echo "values = ";
        var_dump($value);
//        echo "<br> rule = ";
//        var_dump($rule);
//        echo "<br> data = ";
        var_dump($data);
//        echo "field = ". $field;
        /*to check is positive integer */
        echo "进入到本方法中！~~~~";

        if(is_numeric($value) && is_integer($value + 0) && ($value+0 > 0)){
            echo "success !";
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