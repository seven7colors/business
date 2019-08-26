<?php
	namespace   app\api\controller;
	use  think\Controller;
	Class Auth extends Controller{
		function __construct()
		{
			parent::__construct();
			if(session('user')){

			}else{

				$this->redirect('http://localhost/youhong/web/Login.html');
			}
		}
	} 

?>