<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/19
 * Time: 6:27
 */

namespace app\home\controller;


use app\home\model\Product;
use think\Controller;
use app\home\model\Category as CategoryModel;
use app\home\model\Product as ProdcutModel;
use app\home\model\Item as ItemModel;
use think\Request;

class Supplier extends Controller
{
    /**
     * 显示供货商首页
     * @return mixed
     */
    public function showIndex(){
        return $this->fetch('index');
    }

    /**
     * 显示供货商品列表
     * @return mixed
     */
    public function getSupplierList(){
        $list = ProdcutModel::getSupplierProductList();
        $this->assign('list',$list);
        return $this->fetch('product-list');
    }

    public function showAddDirectCharge(){
        //显示添加直充商品
        return $this->fetch('drect-charge');
    }

    /**
     * 显示一级目录列表
     * @return mixed
     */
    public function showCategorySelect(){
        $list = CategoryModel::getCategory();
        $this->assign("list",$list);
        return $this->fetch('category-select');
    }

    /**
     * 显示二级目录列表
     * @param Request $request
     * @return mixed
     */
    public function showItemSelect(Request $request){
        //根据id查询商品信息
        $list = ItemModel::getItems($request->get('id'));
        $this->assign("list",$list);
        return $this->fetch('item-select');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function showAddItem(Request $request){
        //显示添加商品页面
        $pid = $request->get("pid");
        $this->assign("pid",$pid);
        return $this->fetch("addproduct");
    }

    /**
     * 保存供货商发布的商品
     */
    public function saveProduct(Request $request){
        $p = $request->post();
        $p['uid'] = 1; //todo this is only for test
        $product = new Product($p);
        if($product->save()){
            return $this->success("添加成功！",'/home/supplier/getSupplierList');
        }else{
            return $this->error("添加失败！");
        }

    }

}