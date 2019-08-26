<?php
namespace app\api\controller;
use think\Controller;

/**
 * 
 */
class Carousel extends Controller
{
	
	public function get(){
		$list=db('carousel')->select();
		foreach ($list as $key => $value) {
            $temp=explode(",",$value['many_thumb']);
             $list[$key]['many_thumb']=$temp;
        }
		return json($list);
	}
}
?>