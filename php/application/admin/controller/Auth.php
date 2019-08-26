<?php
namespace app\admin\controller;
use think\Controller;

// include 'think\Controller.php'

class Auth extends Controller{

	function __construct()
	{
		parent::__construct();
		if (session('superuser')) {
			// 通过
		}else{
			$this->error('请先登录！',url('superuser/index'));
		}
	}
	 
}


?>