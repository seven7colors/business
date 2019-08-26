<?php
	namespace app\api\controller;
	use think\Controller;
	/**
	 * 
	 */
	class Adress extends Controller
	{
		
		public function index()
		{
				session_start(); 
				$uid=$_SESSION['think']['user']['id'];
				//var_dump($uid);
				$adresslist=db('reciver')->where("uid='$uid'")->select();
				return json($adresslist);
				
				
    		
		}

		public function edit()
		{
			$id=input('id');
			$editlist=db('reciver')->where("id='$id'")->find();
			return json($editlist);
		}

		public function update()
		{	
			$id=input('id');
			$reciver_data = input();
			db('reciver')->where("id='$id'")->update($reciver_data);
			$this->redirect('http://localhost/youhong/web/Member_Address.html');

		}

		public function add()
		{	
			session_start();
			$uid=$_SESSION['think']['user']['id'];
			$country=$_POST['country'];
			$province=$_POST['province'];
			$city=$_POST['city'];
			$countryside=$_POST['countryside'];
			$reciver_data = input();
			$reciver_data['uid']=$uid;
			$reciver_data['country']=$country;
			$reciver_data['province']=$province;
			$reciver_data['city']=$city;
			$reciver_data['countryside']=$countryside;
			db('reciver')->insert($reciver_data);
			$this->redirect('http://localhost/youhong/web/Member_Address.html');
		}

		public function delete()
		{
			$id=input('id');
			$editlist=db('reciver')->where("id='$id'")->delete();
			$this->redirect('http://localhost/youhong/web/Member_Address.html');
		}

		public function status()
		{
			$id=input('id');
			$uid=input('uid');
		    db('reciver')->where("id='$id'")
		    ->setField('status',1);
			db('reciver')->where("id!='$id' and uid='$uid'")
			->setField('status',0);
			$this->redirect('http://localhost/youhong/web/Member_Address.html');
		}
	}
?>