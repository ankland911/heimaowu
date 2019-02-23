<?php
namespace app\shoes\service;

use app\shoes\service\product;
/**
* 
*/
class product_pool
{
	
	public function build($limit=12)
	{
		$rs = \think\Db::Table('shoes_products')->field('id')->limit($limit)->paginate(12);
		$this->render = $rs->render();
		$this->pool = [];
		$count = 0;
		foreach ($rs as $key => $value) {
			$product = new product($value['id']);
			$this->pool[$count] = $product->information;
			$count ++;
		}
	}

	public function build_by_category($id){
		$rs=\think\Db::Table('shoes_cate_list')->where(['category_id'=>$id])->paginate(12);
		$this->render = $rs->render();
		$this->pool = [];
		$count = 0;
		foreach ($rs as $key => $value) {
			$product = new product($value['product_id']);
			$this->pool[$count] = $product->information;
			$count ++;
		}
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

	public static function recommand_by_cate($count,$cate)
	{
		$rs = \think\Db::Table('shoes_products')->alias('p')->join('shoes_cate_list c','p.id=c.category_id')->where(['is_recommand'=>'1','category_id'=>$cate])->limit($count)->select();
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