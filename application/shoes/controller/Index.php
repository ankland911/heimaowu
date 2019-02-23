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
        $product_pool = new product_pool();
        $product_pool->build();
        $this->assign('products',$product_pool->pool);
        $slider = new slider(0);
        $this->assign('slider_pool',$slider->slider_pool); 
        return $this->fetch('index');
    }

    public function products($cate=0)
    {
        $product_pool = new product_pool();
        if(0==$cate){
            $this->assign('category_title',['title'=>'鞋品库']);
            $product_pool->build();
        }else{
            $product_pool->build_by_category($cate);
            $this->assign('category_title',\think\Db::Table('shoes_categorys')->where('id',$cate)->field('title')->find());
        }
        
        
        
        $this->assign('products',$product_pool->pool);
        $this->assign('render',$product_pool->render);
        return $this->fetch('products');
    }

    public function product_detail($id=0)
    {
        $product = new product($id);
        $this->assign('product',$product->information);
        $this->assign('recommand_by_c',product_pool::recommand_by_cate(5,$product->information['category_id']));
        return $this->fetch('productdetail');
    }

    public function about(){
        return $this->fetch('about');
    }

    public function contact(){
        return $this->fetch('contact');
    }
}
