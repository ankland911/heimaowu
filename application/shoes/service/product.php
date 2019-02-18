<?php
namespace app\shoes\service;

use app\shoes\service\picture;
/**
* 
*/
class product
{
	
	public function __construct($id)
	{
		$this->information = \think\Db::Table('shoes_products')->where('id',$id)->find();
		$url = $this->information['image'];
		if(""==$this->information['image_path']){
			$this->information['image_path'] = picture::get($url) or $file_path = '';
			\think\Db::Table('shoes_products')->update($this->information);
		}
		

	}
}