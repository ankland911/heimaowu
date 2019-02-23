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
		$this->information['url'] = url('shoes/index/product_detail',['id'=>$this->information['id']]);
		$category = \think\Db::Table('shoes_cate_list')->where('product_id',$id)->find();
		$this->information['category_id'] = $category['category_id'];
	}
}