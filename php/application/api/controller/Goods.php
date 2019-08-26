<?php
namespace app\api\controller;
//引入
use think\Controller;
use think\Session;


    class Goods extends Controller
    {
    	
    	public function getlist()
    	{	
    	$goodlist=db('goods')->alias('g')
         ->field('g.id,g.g_price,g.g_name,g.g_thumb,c.pid')
         ->order('g.id desc')
         ->join('category c','g.cate_id = c.id')
         ->paginate(6);
    	return json($goodlist);
    	}

        public function SellDetails()
        {   
            $a=Session::get('user','think') ;
            $uid=$a['id'];
            $id=input('id');
            $info=db('goods')->where("id='$id'")->find();
            $info['uid']=$uid;
            return json($info);
        }

        public function uid()
        {
        $a=Session::get('user','think') ;
        $uid=$a['id'];
        return json($uid);
        }
    }    
?> 