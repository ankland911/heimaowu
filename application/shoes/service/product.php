<?php
namespace app\shoes\service;

/**
* 
*/
class product
{
	
	public function __construct($id)
	{
		$this->information = \think\Db::Table('shoes_products')->where('id',$id)->find();
	}
}