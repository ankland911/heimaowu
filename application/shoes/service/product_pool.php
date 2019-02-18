<?php
namespace app\shoes\service;

use app\shoes\service\product;
/**
* 
*/
class product_pool
{
	
	public static function build()
	{
		$rs = \think\Db::Table('shoes_products')->field('id')->select();
		$pool = [];
		$count = 0;
		foreach ($rs as $key => $value) {
			$product = new product($value['id']);
			$pool[$count] = $product->information;
			$count ++;
		}
		return $pool;
	}

	public static function build_by_category($id){
		$rs=\think\Db::Table('shoes_cate_list')->where(['category_id'=>$id])->select();
		$pool = [];
		$count = 0;
		foreach ($rs as $key => $value) {
			$product = new product($value['product_id']);
			$pool[$count] = $product->information;
			$count ++;
		}
		return $pool;
	}

	public static function recommand($count)
	{
		$rs = \think\Db::Table('shoes_products')->field('id')->where(['is_recommand'=>'1'])->limit($count)->select();
		$pool = [];
		$count = 0;
		foreach ($rs as $key => $value) {
			$product = new product($value['id']);
			$pool[$count] = $product->information;
			$count ++;
		}
		return $pool;
	}
}