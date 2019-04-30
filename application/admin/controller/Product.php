<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/18
 * Time: 16:33
 */

namespace app\admin\controller;


use app\home\model\Category as CategoryModel;
use app\home\model\Item as ItemModel;
use think\Controller;
use think\Request;

class Product extends Controller
{
    public function showProducPage(){
        $result = CategoryModel::getItemWithCategory(false);
       // var_dump($result);
        $this->assign("list",$result);
        $this->assign("size",count($result));
        return $this->fetch('product');
    }

    public function addFristBrand(){
        //添加一级目录
        return $this->fetch('addFristBrand');
    }

    public function savefristbrand(Request $request){
        $categoryModel = new CategoryModel($request->post());
        $result = $categoryModel->allowField(true)->save();
        if($result > 0 ){
            $this->success('新增成功', 'admin/product/showProducPage');
        }else{
            return $this->error('新增失败');
        }
    }

    public function showAddSecondBrand(){
        //添加二级分类
        $categoryModel = new CategoryModel();
        $source = $categoryModel->select();
        $this->assign("list",$source);
        return $this->fetch('addSecondBrand');
    }

    public function saveSecondeBrand(Request $request){
        $item = new ItemModel($request->post());
        $result = $item->save();
        if($result > 0 ){
            $this->success('新增成功', 'admin/product/showProducPage');
        }else{
            return $this->error('新增失败');
        }
    }

    /**
     * 显示当前平台下的所有商品
     * @return mixed
     */
    public function showAllProductList(){
        $result = CategoryModel::getCategoryWithItemWithPorcut();

        $this->assign("list",$result);
        return $this->fetch('all-product');
        //return json($result);
    }

}