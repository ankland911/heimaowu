<?php
namespace app\shoes\service\menu;
interface menuInterface{
}

class menuClass{
//内部变量，数组值 形如 {目录title=>目录页面url}
	public $_menu_pool;
//  [ 0 => ['id'=>id,'title'=>title,'url'=>url],
//     1=> ['id'=>id,'title'=>title,'url'=>url]
//  ]
	public $_parents;
	public $_children;
}

class menu extends menuClass implements menuInterface{
//构造函数，生成_menu_pool 数组
	public function __construct(){
		$this->_parents = \think\Db::Table('shoes_menus')->field('id,title,url')->select();
		$this->build_child_menu();
		
	}

	public function build_child_menu()
	{
		foreach ($_parents as $key => $value) {
			$this->_children[$key] = \think\Db::Table('shoes_menus')->field('id,title,url')->where(['parentid'=>$value['id']])->select();
		}
	}
}