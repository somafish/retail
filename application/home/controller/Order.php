<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/29
 * Time: 20:37
 */

namespace app\home\controller;


use app\home\model\CardOrder;
use app\home\service\OrderService;
use app\libs\exception\RoutineMessage;
use think\Controller;
use app\home\model\Product as ProductModel;
use think\Request;

class Order extends Controller
{

    /**
     * 显示下订单页面
     */
    public function showOrder($id){
        //1. check login statu

        //2.查询数据
        $list = ProductModel::getProductById($id);
        $this->assign('list',$list);
        return $this->fetch('order');
    }

    /**
     * 显示确认订单页面
     */
    public function showConfirmOrder(Request $request){
        $id = $request->post('id');
        $list = ProductModel::getProductById($id);
        $list['qq'] = $request->post('qq');
        $list['reqq'] = $request->post('reqq');
        $list['remarks'] = $request->post('remarks');
        $this->assign('list',$list);
        return $this->fetch('comfirm');
    }

    /**
     * 下订单
     */
    public function order(Request $request){
        $order = new OrderService();
        $msg = $order->place('10001',$request->post());
        return json($msg);
    }


    /**
     * 显示下单成功的提示页面
     * @return mixed
     */
    public function orderSuccess(Request $request){
        //显示下单成功页面
        $orderId = $request->get('oid');

        return $this->fetch('ordersuccess');
    }

    /**
     * 显示我的订单
     */
    public function showMyOrder(Request $request){
        //todo 更新用户id
        $scope = $request->get('scope');
        if($scope == null){
            //默认查询30天
            $scope = 30;
        }

        $start = date("Y-m-d H:i:s",strtotime("-".$scope." day"));
        $end = date("Y-m-d H:i:s");
        $list = CardOrder::getRecentlyOrderRecoder($start,$end,'10001')->toArray();
//        if ($list != null){
//            $list = $list->toArray();
//        }
        $this->assign('list',$list);
        return $this->fetch('myOrder');
    }

    /**
     * @return mixed
     * 显示订单详情。。。
     */
    public function showOrderContent(){
        //显示订单详情
        return $this->fetch('orderContent');
    }
}