<?php
namespace app\api\controller;
use think\Controller;
use think\Session;
use think\Cookie;
/**
 * 
 */
class Cart extends Controller
{
	
	public function add()
	{
		session_start(); 
		$gid=input('id');

		//判断是否登录
		//登录之后
		if(array_key_exists('user',$_SESSION['think'])){
			//判断购物车是否存在这个商品
			$uid=$_SESSION['think']['user']['id'];
			$cart_data=db('cart')->where("gid='$gid' and uid='$uid'")->find();
			
			if($cart_data){
			   $cart_data['num']=$cart_data['num']+1;
			   db('cart')->where("gid='$gid'")->setField('num',$cart_data['num']);
			}else{
				$info=db('goods')->field('g_price,g_name,g_thumb')
				->where("id='$gid'")->find();

				$info['uid']=$uid;
				$info['gid']=$gid;
				$info['num']=1;
				//var_dump($info);
				//exit();
				db('cart')->insert($info);
			}
		}
		
		


	}

	public function get()
	{
		$a=Session::get('user','think') ;
		//已经登录之后，返回数据库购物车的数据
		$uid=$a['id'];
		$cart_data=db('cart')->where("uid='$uid'")->select();
	    return json($cart_data);
		
	}

	public function delete(){
		$gid=input('gid');
		db('cart')->where("gid='$gid'")->delete();
		$this->redirect('http://localhost/youhong/web/BuyCar.html');
	}

	public function tongbu()
	{
		$cart_list=json_decode(input('cart_list'),true);

		$a=Session::get('user','think') ;
		$uid=$a['id'];
		$cart_data=db('cart')->where("uid='$uid'")->select(); 
		//登录之后同步数据库数据；
		//获取数据库的数据gid
		foreach ($cart_data as $key => $value) {
			$ids[]=$value['gid'];
		}

		if($cart_data){
			//如果购物车数据不为空且数据已存在在数据库，改变商品数量，如果不存在直接添加
			foreach ($cart_list as $key => $value) {
				foreach ($cart_data as $k => $v) {
					if($value['id']==$v['gid']){
						    //如果在购物车，找到对应商品改变数量
							$num=$v['num']+$value['num'];
							$gid=$v['gid'];
							db('cart')->where("uid='$uid' and gid='$gid'")->setField('num',$num);
							continue;
						
						}else if(!in_array($value['id'], $ids)){
							//如果不在购物车直接添加
						    $add=[];
							$add['uid']=$uid;
							$add['gid']=$value['id'];
							$add['g_name']=$value['g_name'];
							$add['g_price']=$value['g_price'];
							$add['g_thumb']=$value['g_thumb'];
							$add['num']=$value['num'];
							db('cart')->insert($add);
							continue;
						}
				}
				
			}
			//如果购物车为空直接添加进数据库
		}else{
			foreach ($cart_list as $key => $value) {
				            $null_add=[];
							$null_add['uid']=$uid;
							$null_add['gid']=$value['id'];
							$null_add['g_name']=$value['g_name'];
							$null_add['g_price']=$value['g_price'];
							$null_add['g_thumb']=$value['g_thumb'];
							$null_add['num']=$value['num'];
							db('cart')->insert($null_add);
			}
		}
		
	}

	public function goComfirm()
	{
		$a=Session::get('user','think') ;
		$uid=$a['id'];
		//获取前端确认结算的商品id
		$ids=json_decode(input('ids'),true);
		if($ids=null){
			exit();
		}
		//生成订单
		//1.先创建订单，2.将订单id赋值给order_id 3.确定订单id，getLastInsID();再创建清单 
		//订单：订单号，时间，金额，状态,总件数，uid
	   //清单:订单号，商品，价格，数量，gid
		$total_num=0;
		$total_price=0;
		foreach ($ids as  $value) {
			//计算出总数量和总金额
			
			
			$orderInfo=db('cart')->field("g_name,g_price,num,gid")
			->where("gid='$value' and uid='$uid'")->find();
			$sum_price=$orderInfo['g_price'] * $orderInfo['num'];
			$total_price+=$sum_price;
			$total_num+=$orderInfo['num'];
			
		}

		//生成订单
		$order_data=[];
		$order_data['uid']=$uid;
		$order_data['order_time']=date('YmdHis',time());
		$order_data['order_serial']=date('YmdHis',time()).rand(1000,9999);
		$order_data['sum_price']=$total_price;
		$order_data['sum_num']=$total_num;
		db('order')->insert($order_data);
		$order_id=db('order')->getLastInsID();
		//生成清单
		foreach ($ids as  $value) {
			//计算出总数量和总金额
			$orderInfo=db('cart')->field("g_name,g_price,g_thumb,num,gid")
			->where("gid='$value' and uid='$uid'")->find();
			$orderInfo['order_id']=$order_id;
			//$tmpList=[];
			//$tmpLIst[]=$orderInfo
			db('order_goods')->insert($orderInfo);
		}
		//db('orderList')->insertAll($tmpList);
		//从购物车数据表删除相应数据，利用freach与delete
	  	foreach ($ids as  $value) {
			db('cart')->where("gid='$value' and uid='$uid'")->delete();
		}
		//跳转到订单页面。返回对应数据
		
	}
	

}
?>