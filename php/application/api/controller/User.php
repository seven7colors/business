<?php
namespace app\api\controller;
//引入
use think\Controller;
use think\Session; 

    class User extends Controller
    {
    	
    	public function register()
    	{
             $file = request()->file('photo');
    
            // 移动到框架应用根目录/public/uploads/ 目录下
            if($file){
                $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
                if($info){
                    // 成功上传后 获取上传信息
                   
                    // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
                     $photo=$info->getSaveName();
                   
                }else{
                    // 上传失败获取错误信息
                    echo $file->getError();
                }
            }
            if($photo){
                $image = \think\Image::open(ROOT_PATH.'/public/uploads/'.$photo);
                $photo = './uploads/'.time().md5(rand(1000,9999)).'.png';
                $image->thumb(150, 150)->save($photo);
               
            }

    		$userdata=input();
            $userdata['photo']=$photo;
    		db('user')->insert($userdata);
            $this->redirect('http://localhost/youhong/web/Login.html');

    	}


    	public function dologin()
    	{      
            
    		$username=input('username');
    		$password=input('password');
    		$info=db('user')
    		->where("username='$username' and password='$password'")
    		->find();
    		if($info){
                Session::set('user',$info,'think');  
    			
                //var_dump($_SESSION['think']['user']['id']);
                //exit();
                //登录成功之后同步数据
                $this->redirect('http://localhost/youhong/web/BuyCar.html');
    		}else{
                $this->redirect('http://localhost/youhong/web/Login.html');
    		}
    	}




        public function info(){
            session_start();
            $username=$_SESSION['think']['user']['username'];
            $pwd=$_SESSION['think']['user']['password'];
            $info=db('user')->where("username='$username' and password='$pwd'")->find();
            return  json($info);
        }



        public function input(){
            $id=input('id');
            $file = request()->file('input_photo');
    
            // 移动到框架应用根目录/public/uploads/ 目录下
            if($file){
                $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
                if($info){
                    // 成功上传后 获取上传信息
                   
                    // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
                     $photo=$info->getSaveName();
                   
                }else{
                    // 上传失败获取错误信息
                    echo $file->getError();
                }
            }
            if($photo){
                $image = \think\Image::open(ROOT_PATH.'/public/uploads/'.$photo);
                $photo = './uploads/'.time().md5(rand(1000,9999)).'.png';
                $image->thumb(150, 150)->save($photo);
               
            }
            db('user')->where("id='$id'")
            ->setField('photo',$photo);
            $this->redirect('http://localhost/youhong/web/Member_User.html');
        }

        public function logout()
        {
            session('user',null);
            $this->redirect('http://localhost/youhong/web/Index.html');
        }
    }    
?>