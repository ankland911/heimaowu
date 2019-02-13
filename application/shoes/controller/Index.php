<?php
namespace app\shoes\controller;
use app\shoes\service\menu;
class Index
{
    public function index()
    {	
    	$website=['homepage'=>'http://www.heimaowu.cn','website'=>'黑猫屋'];
    	$seo = ['title'=>'title','keywords'=>'keywords','description'=>'description'];
    	$menu = new menu();
    	$this->assign('parents',$menu->_parents);
               $this->assign('children',$menu->_children);
    	$this->assign('website',$website);
    	$this->assign('seo',$seo);
    	return $this->fetch('index');
    }

    public function products()
    {
        return $this->fetch('products');
    }
}
