<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/29
 * Time: 20:37
 */

namespace app\home\service;


use app\home\model\CardOrder;
use app\home\model\Product;
use app\home\model\User;
use app\libs\exception\RoutineMessage;
use think\Db;
use think\Exception;

/**
 * Class OrderService
 * @package app\home\service
 * 订单服务
 */
class OrderService
{

    /**
     * @var
     * 用户id
     * 商品id
     * 商品对象
     */
    protected $uid;
    protected $userOrder;
    protected $product;
    protected $orderId;
    /**
     * @param $uid 用户id
     * @param $userOrder 用户下单Array数组,涵括 下单密码
     */
    public function place($uid,$userOrder){

        $this->userOrder = $userOrder;
        $this->uid = $uid;
        $this->product = $this->getProduct($userOrder['id']);
        $msg = new RoutineMessage();

        //检查用户支付密码是否正确
        $statu = $this->checkPayCode($uid,$userOrder['paycode']);
        if (!$statu){
            $msg->flag = false;
            $msg->msg = "The payment password your entered is incorrect";
            return $msg;
        }

        //检查订单产品状态
        $statu = $this->checkProductStatu();

        if (!$statu){
            $msg->flag = false;
            $msg->msg = "Network request exception, please try again";
            return $msg;
        }

        //检查钱钱是否足够扣除
        $statu = $this->checkPay();
        if(!$statu){
            $msg->flag = false;
            $msg->msg = "Your balance is insufficent to complete the payment";
            return $msg;
        }

        //检查通过 -> 生成订单快照
        $statu = $this->createSnap();
        if($statu){
            //订单生成成功！
            $msg->msg = $this->orderId;
            return $msg;
        }else{
            $msg->flag = false;
            $msg->msg = "The server is busy. Please try again later.";
            return $msg;
        }
    }

    /**
     * 检查用户支付密码是否正确
     * @param $uid
     * @param $paycode
     * @return bool
     * @throws Exception
     * @throws \think\exception\DbException
     */
    public function checkPayCode($uid,$paycode){
        $result = User::get(['id'=>$uid,'paycode'=>getPayCode($paycode)]);
        return $result == null ? false : true;
    }

    public function createSnap(){
        $snapOrder = [
            'price'=>$this->product['price'],
            'product_name' => $this->product['product_name'],
            'qq'=>$this->userOrder['qq'],
            'reqq'=>$this->userOrder['reqq']
        ];

        $orderNo = $this->makeOrderNo();
        $cardModel = new CardOrder();
        $this->orderId = $orderNo;
        $cardModel->uid = $this->uid;
        $cardModel->oid = $orderNo;
        $cardModel->snap = json_encode($snapOrder);
        $cardModel->statu = 1;
        $cardModel->price = $this->product['price'];
        $cardModel->remarks = $this->userOrder['remarks'];
        $cardModel->place_time = date("Y-m-d H:i:s");

        //开启事务，进行下单操作

        Db::startTrans();

        try{
            //1. 库存 --
            Product::updateStock($this->product['id'],$this->userOrder['singlesize']);
            //2.用户金钱--
            $u = User::get($this->uid)->toArray();
            $money = $u['money'] - $cardModel['price'];
            if($money < 0){
                Db::rollback();
                return false;
            }
            User::pay($money,$this->uid);

            //3. 订单数据入库
            $cardModel->save();

            Db::commit();

            return true;
        }catch (Exception $e){
            Db::rollback();
        }
        return false;

    }

    public function getProduct($pid){
        return Product::getProductById($pid);
    }

    public function checkPay(){
        //1.查询用户金额
        $user = User::get($this->uid)->toArray();
        return $user['money'] - $this->product['price'] >= 0 ? $user['money'] - $this->product['price'] : false;
    }

    /**
     * 检查用户下单数据与服务器查询的数据是否一致
     * @return bool
     */
    public function checkProductStatu(){
        $uOrder = $this->userOrder;
        $product = $this->product;
        //1. 判断用户下单 数量是否满足及时查询出来的数据

        if($uOrder['singlesize'] != $product['singlesize']){
            return false;
        }

        //2.检查商品金额是否正确
        if($uOrder['price'] != $product['price']){
            return false;
        }

        //3.检查库存是充足
        if($product['stock'] - $uOrder['singlesize'] < 0){
            return false;
        }

        //4.检查ok 返回
        return true;
    }

    /**
     * 生成订单号
     * @return string
     */
    public function makeOrderNo(){
        $yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
        $no = $yCode[intval(date('Y')) - 2016] . strtoupper(dechex(date('m'))).date('d').
            substr(time(),-5).substr(microtime(),2,5). rand(1000,9999);
        return $no;
    }


    public static function OrderValidata($oid,$uid){
        CardOrder::get(['oid'=>$oid,'uid'=>$uid]);
    }

}