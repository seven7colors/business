<?php
namespace app\api\controller;
use think\Controller;
use think\Session;

/**
 * 
 */
class Order extends Controller
{
	public function index()
	{
		$a=Session::get('user','think') ;
		$uid=$a['id'];
		$list=db('order')->alias('g')
		 ->field('g.order_time,g.order_serial,g.sum_price,g.sum_num,g.status,c.g_name,c.g_price,c.g_thumb,c.num')
		 ->order('c.id desc')
         ->join('order_goods c','g.id = c.order_id')
		 ->paginate(5);
		 return json($list);
	}
	
}
?>