<?php
namespace app\service\user;
interface userInterface{

}

class userClass{
 public $_id;
 public $_username;
 public $_name;
 public $_password;
}

class user extends userClass implements userInterface{
	public function __construct(){
		$user = \think\Db::Table('user')->field('id,username,name')->select();
		$this->_id = $user['id'];
		$this->_username=$user['username'];
		$this->_name = $user['name'];
	}
}