<?php
namespace app\shoes\service;

/**
* 
*/
class picture
{
	
	public static function get($url)
	{
		$ymd = date("Ymd");
		$save_path = dirname(THINK_PATH) .'/public/pic/';
		$save_path .= $ymd . "/";
		if (!file_exists($save_path)) {
			mkdir($save_path);
		}
		$ext = strrchr($url, '.');
		$new_file_name = date("YmdHis") . '_' . rand(10000, 99999) . $ext;
		$save_to = $save_path.$new_file_name;
		$content = file_get_contents($url);
		if(!file_put_contents($save_to, $content)){
			return false;
		}else{
			return strstr($save_to,'/public');
		}
	}
}