<?php
namespace app\admin\controller;
use think\Controller;


/**
 * 
 */
class Superuser extends Controller{
	
	public function index()
	{
		return $this->fetch();
	}

	public function dologin()
	{
		$name=$_POST['name'];
		$pwd=$_POST['password'];
		$info=db('admin')->where("name='$name' and password='$pwd'")->find();
		if($info){
			session('superuser',$info);
			$this->success('登录成功',url('goods/index'));
		}else{
			$this->error('用户名或密码不一致，请重新登录！');
		}
	}
	public function logout()
	{
		session('superuser',null);
		$this->success('退出成功',url('goods/index'));
	}
}
?>