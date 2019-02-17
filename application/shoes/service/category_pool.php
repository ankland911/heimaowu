<?php
namespace app\shoes\service;
class category_pool
{
	
	public static function build()
	{
		$rs = \think\Db::Table('shoes_categorys')->select();
		$count = 0;
		$pool= [];
		foreach ($rs as $key => $value) {
			$pool[$count] = $value;
			$count ++ ;
		}
		return $pool;
	}
}