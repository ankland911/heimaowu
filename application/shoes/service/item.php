<?php
namespace app\shoes\service\item;
class itemClass{
	public $data;
	/*
	id
	title
	image
	page
	category
	link
	old_price
	month_sold
	commission_rate
	commission_money
	solder_name
	solder_id
	shop_name
	type
	coupon_id
	coupon_mount
	new_coupon_mount
	coupon_info
	coupon_start_date
	coupon_end_date
	coupon_link
	coupon_ali_link
	*/
	
	public $category; // array
	public $commission_rate; //float 0.00	
}

class item extends itemClass{
	public function __construct($data){
			$this->data = $data;
	}

	public function set_category(){
		$this->category = split('/',$this->data['category']);
			
	}  

	public function format_rate(){
		$this->commission_rate = intval($this->data['commission_rate'];
	}
	
	public function is_img_local(){
		if(strpos($this->data[$this->data['image'],'http://')){
			return false;
		}else{
			return true;
		}
	}

	
	public function get_image($file_url){
		$ymd = date("Ymd");
		$save_path = dirname(THINK_PATH) .'/public/upload/image/';
		$save_path .= $ymd . "/";
		if (!file_exists($save_path)) {
			mkdir($save_path);
		}
		$ext = strrchr($file_url, '.');
		$new_file_name = date("YmdHis") . '_' . rand(10000, 99999) . $ext;
		$save_to = $save_path.$new_file_name;
		$content = file_get_contents($file_url);
		if(!file_put_contents($save_to, $content)){
			print('failed');
		}else{
			//return strstr($save_to,'/public');
			$this->change_image_path(strstr($save_to,'/public');
		}
	}

	public function change_image_path($path){
		Db::table('alimama_list')->where('id',$this->id)->update(['image'=>$path]);
	}

	public function rip_keywords(){
	}

	public function del_record(){
	}

	public function modi_record(){
	}
}