<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/15
 * Time: 7:13
 */

namespace app\libs\exception;

//参数异常

use Exception;
use Throwable;

class ParamException extends Exception
{
    public $code = 500;
    public $msg = "There is a something wring with your param !";
    public $errorCode = 30001;

}