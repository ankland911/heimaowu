<?php
namespace app\shoes\service\collect;
//组成页面所需的数组集合的收集类
interface collectInterface{
//获取推荐文章，用于在各种页面生成推荐文章列表
	public function getRecommendList();
//获取文章，用于在各种页面生成文章列表
	public function getArticleList();
	
}


class collect implements collectInterface{

	public function getRecommendList($num = 5){
		$results = array();
		$recommends = \think\Db::Table('article')->field('id,title,hits,main_text,description')->order('hits desc')->limit($num)->select();
		foreach ($recommends as $key => $value) {
			if(preg_match_all('/\{\:t_image\(([0-9]*)\)\}/',$value['main_text'],$matches)){
				$results[$key]['image'] = t_image($matches[1][0]);
				$results[$key]['matches'] = $matches[1];
			}elseif(preg_match_all('/\/public\/jiongtu\/[0-9]*\.(jpg|gif|png)/',$value['main_text'],$matches)){
				$results[$key]['image'] = $matches[0][0];
				$results[$key]['matches'] = $matches[0];
			}elseif(preg_match_all('/\/public\/upload\/image\/[0-9]*\/[0-9_]*\.(jpg|gif|png)/',$value['main_text'],$matches)){
				$results[$key]['image'] = $matches[0][0];
				$results[$key]['matches'] = $matches[0];
			}elseif(preg_match_all('/src=\"(.*)\"/',$value['main_text'],$matches)){
				$results[$key]['image'] = $matches[1][0];
				$results[$key]['matches'] = $matches[1];
			}else{
					$results[$key]['image'] = '#';
				}
			$results[$key]['title'] = mb_substr($value['title'],0,20);
			$results[$key]['description'] = mb_substr($value['description'],0,200);
			$results[$key]['path'] =\think\Url::build('index/index/item',['id'=>$value['id']]);	
		}
		return $results;
	}

	public function getArticleList($page =3 , $cateid = 1 ,$num =15, $where = 'status=1'){

		$results =array();
		$articles = \think\Db::Table('article')->field('id,title,main_text,day,description,cate_id,status,author')->where('cate_id',$cateid)->where($where)->order('id desc')->paginate($num)->each(
			function($item,$key){
				//
				if(preg_match_all('/\{\:t_image\(([0-9]*)\)\}/',$item['main_text'],$matches)){
					$item['image'] = t_image($matches[1][0]);
					$item['matches'] = $matches[1];
				}elseif(preg_match_all('/\/public\/jiongtu\/[0-9]*\.(jpg|gif|png)/',$item['main_text'],$matches)){
					$item['image'] = $matches[0][0];
					$item['matches'] = $matches[0];
				}elseif(preg_match_all('/\/public\/upload\/image\/[0-9]*\/[0-9_]*\.(jpg|gif|png)/',$item['main_text'],$matches)){
					$item['image'] = $matches[0][0];
					$item['matches'] = $matches[0];
				}else{
					$item['image'] = '#';
				}
				$item['title'] = mb_substr($item['title'], 0 ,27);
				$item['text'] = $item['description'];
				$item['path'] = \think\Url::build('index/index/item',['id'=>$item['id']]);
				$item['date'] = $item['day'];
				$item['tap'] = \think\Db::Table('categorys')->where('id',$item['cate_id'])->find();
				$author = \think\Db::Table('user')->where('id',$item['author'])->find();
				$item['author'] = $author['name'];

				return $item;
			});
		return $articles;
	}
}