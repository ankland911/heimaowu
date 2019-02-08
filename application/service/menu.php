<?php
namespace app\service\menu;
interface menuInterface{
}

class menuClass{
//内部变量，数组值 形如 {目录title=>目录页面url}
	public $_menu_pool;
	public $_cate;
}

class menu extends menuClass implements menuInterface{
//构造函数，生成_menu_pool 数组
	public function __construct(){
	}

	public function in_home(){
		$results = array();
		$cates = \think\Db::Table('categorys')->field('id,title,detail')->select();
		foreach ($cates as $key => $value) {
			$results[$value['title']] = \think\Url::build('index/index/index',array('cateid'=>$value['id']));
		}
		$this->_menu_pool = $results;
	}

	public function in_admin(){
		$cates = \think\Db::Table('categorys')->field('id,title,detail')->select();
		foreach ($cates as $key => $value) {
			$results[$value['title']] = \think\Url::build('index/admin/article_control',array('cateid'=>$value['id']));
		}
		$this->_menu_pool = $results;
	}

	public function get_data_menu(){
		$results = array();
		$this->_cate = \think\Db::Table('categorys')->field('id,title,detail')->select();
	}
}