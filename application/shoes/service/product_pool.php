<?php
namespace app\shoes\service;
/**
* 
*/
class product_pool
{
	
	public static function build()
	{
		$rs = \think\Db::Table('shoes_products')->select();
		$pool = [];
		$count = 0;
		foreach ($rs as $key => $value) {
			$pool[$count] = $value;
			$count ++;
		}
		return $pool;
	}

	public static function recommand($count)
	{
		$rs = \think\Db::Table('shoes_products')->where(['is_recommand'=>'1'])->limit($count)->select();
		$pool = [];
		$count = 0;
		foreach ($rs as $key => $value) {
			$pool[$count] = $value;
			$count ++;
		}
		return $pool;
	}
}