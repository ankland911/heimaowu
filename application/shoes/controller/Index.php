<?php
namespace app\shoes\controller;
use app\shoes\service\menu;
use app\shoes\service\category_pool;
use app\shoes\service\product_pool;
use app\shoes\service\product;
use app\shoes\service\slider;
class Index extends \think\Controller
{
    public function _initialize()
    {
        $website=['homepage'=>'http://www.heimaowu.cn','sitename'=>'黑猫屋','short_url'=>'heimaowu.cn'];
        $seo = ['title'=>'黑猫屋','keywords'=>'keywords','description'=>'description'];
        $this->assign('website',$website);
        $this->assign('seo',$seo);
        $menu = new menu();
        $this->assign('parents',$menu->_parents);
        $this->assign('children',$menu->_children);
        $this->assign('categorys',category_pool::build());
        $this->assign('recommand',product_pool::recommand(5));
    }
    public function index()
    {
        $this->assign('products',product_pool::build());
        $slider = new slider(0);
        $this->assign('slider_pool',$slider->slider_pool); 
        return $this->fetch('index');
    }

    public function products()
    {
        return $this->fetch('products');
    }

    public function product_detail($id=0)
    {
        $product = new product('571053833335');
        $this->assign('product',$product->information);
        return $this->fetch('productdetail');
    }
}
