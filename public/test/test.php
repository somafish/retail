<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/19
 * Time: 9:35
 */

header("Content-Type:application/json");
$json = $GLOBALS['HTTP_RAW_POST_DATA'];

// 将JSON数据转换为PHP对象
$obj = json_decode($json);


file_put_contents("F:/r.txt",$obj."this is all Data");