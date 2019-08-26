<?php
namespace app\admin\controller;
use think\Controller;

/**
 * 
 */
class Order extends Controller
{
	
	public function index(){
		$list=db('order')
		 ->order('id desc')
		 ->paginate(5);
		 $this->assign('list',$list);
		 return $this->fetch();
	}

	public function orderList(){
		$orderId=input('id');
		$orderList=db('order_goods')->where("order_id='$orderId'")->select();
		$this->assign('orderList',$orderList);
		return $this->fetch();
	}

	
}
?>