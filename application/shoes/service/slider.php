<?php
namespace app\shoes\service;
/**
* 
*/

class sliderClass{
	public $slider_pool=[];
}

class slider extends sliderClass
{
	
	public function __construct($position=0)
	{
		# position = 0  主页
		if(0==$position){
			$rs = \think\Db::Table('shoes_slider')->select();
			$this->slider_pool = $rs;
		}
	}
}
