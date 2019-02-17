<?php
namespace app\service\article;

interface articleInterface{
//类操作函数，获取文章标题
	public function getTitle();
//类操作函数，返回文章点击数
	public function getHits();
//类操作函数，增加文章点击数
	public function addHit();
//类操作函数，返回文章发布日期
	public function getDay();
//类操作函数，返回作者用户代码
	public function getAuthor();
//类操作函数，返回作者用户代码转换的作者姓名
	public function getAuthorName();
//类操作函数，如果main_text存在形如{:t_image();}的图片代码段，则替换为t_image()函数处理后的图片path代码；
	public function getText();
//发布文章
	public function send();
}

class articleClass{
//文章编号
	public $_id;
//文章标题
	public $_title;
//文章点击数
	public $_hits;
//文章发布日期
	public $_day;
//文章作者编号
	public $_author;
//文章正文内容（html代码）
	public $_mainText;
//下一篇文章的ID号
	public $_next;
//上一篇文章的ID号
	public $_prev;
//文章所属的栏目ID
	public $_cateId;
//文章页面description
	public $_description;
//文章页面关键字
	public $_keywords;
}


class article extends articleClass implements articleInterface{
	public function __construct($id=null){
		if($id){
			$result = \think\Db::Table('article')->where('id',$id)->find();
			$this->_id = $id;
			$this->_title = $result['title'];
			$this->_hits = $result['hits'];
			$this->_day = $result['day'];
			$this->_author = $result['author'];
			$this->_mainText = $result['main_text'];
			$this->_description = $result['description'];
			$this->_cateId = $result['cate_id'];
			$this->_keywords = $result['keywords'];
		}
	}
	

	public function send(){
		$data['status'] = '1';
		$data['day'] = date('Y-m-d');
		$rs = \think\Db::Table('article')->where(['id'=>$this->_id])->update($data);
		return $rs;
	}
	

	public function addHit(){
		$hits = (int)$this->_hits +1;
		$hits = (string)$hits;
		\think\Db::Table('article')->where('id',$this->_id)->update(['hits'=>$hits]);

	}



	public function getAuthorName(){
		$rs = \think\Db::Table('user')->where('id',$this->_author)->find();
		return $rs['name'];
	}

	public function getText(){
		if(preg_match_all('/\{\:t_image\(([0-9]*)\)\}/',$this->_mainText,$matches)){
			foreach ($matches[0] as $key => $value) {
				$this->_mainText = str_replace($value,t_image($matches[1][$key]),$this->_mainText);
			}
		}
		return $this->_mainText;
	}

	

	public function saveArticle(){
		if(null==\think\Db::Table('article')->where('id',$this->_id)->find()){
			return \think\Db::Table('article')->insertGetid(['id'=>$this->_id,'title'=>$this->_title,'author'=>$this->_author,'description'=>$this->_description,'cate_id'=>$this->_cateId,'keywords'=>$this->_keywords]);
		}else{
			\think\Db::Table('article')->where('id',$this->_id)->update(['title'=>$this->_title,'author'=>$this->_author,'description'=>$this->_description,'cate_id'=>$this->_cateId,'keywords'=>$this->_keywords]);
			return $this->_id;
		}
	}
}