<?php
//命名空间
namespace app\admin\controller;
//引入
use think\Controller;
use app\admin\controller\Auth;

class Goods extends Auth{

	public function index()
	{    
		 $list=db('goods')->alias('g')
		 ->field('g.id,g.g_price,g.g_name,g.g_thumb,g.inventory,c.cate_name')
		 ->order('g.id desc')
         ->join('category c','g.cate_id = c.id')
		 ->paginate(5);
		 $this->assign('list',$list);
		 return $this->fetch();
	}


	public function add()
	{  
        $cate_list = [];
        $addData=db('category')->alias('c')->order('c.id asc')->select();

        foreach ($addData as $key => $value) {
            if($value['pid']==0){
                // 子分类
                
                $cate_list[$value['id']]=$value;
            }
            else{
                $cate_list[$value['pid']]['son'][] = $value;
            }
        }
        foreach ($cate_list as $key => $value) {
            
            if(empty($value['son'])){
                
                $cate_list[$value['id']]['son'][]=null;
            
            }
        
        }
        
        //var_dump($cate_list);
        //exit();
        $this->assign('cate_list',$cate_list);
		return $this->fetch();
	}

	public function save()
	{   
		$data=input();
		$data['g_content'] =$_POST["g_content"];
		$many_thumb = [];
		$files = request()->file('g_thumb');
        foreach($files as $file){
        // 移动到框架应用根目录/public/uploads/ 目录下
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
        if($info){
            // 成功上传后 获取上传信息
            // 输出 42a79759f284b767dfcb2a0197904287.jpg
             $many_thumb[] = $info->getSaveName(); 
        }else{
            // 上传失败获取错误信息
            echo $file->getError();
        }  
        if($many_thumb){
        	$g_thumb = './uploads/'.time().md5(rand(1000,9999)).'.png';
	    	$image = \think\Image::open(ROOT_PATH.'/public/uploads/'.$many_thumb[0]);
			// 按照原图的比例生成一个最大为2000*2000的缩略图并保存为thumb.png
			$image->thumb(200, 200)->save($g_thumb);

	    	$data['g_thumb'] = $g_thumb;
	    	$data['many_thumb'] = implode(",", $many_thumb);
        }
    }

		db('goods')->insert($data);
        //var_dump($data);

	    $this->success('添加成功',url('index'));
	 
    }
    public function edit()
    {
    	$id=input('id');
    	$info=db('goods')->where("id=$id")->find();
    	$this->assign('info',$info);
        $cate_list = [];
        $addData=db('category')->alias('c')->order('c.id asc')->select();

        foreach ($addData as $key => $value) {
            if($value['pid']==0){
                // 子分类
                
                $cate_list[$value['id']]=$value;
            }
            else{
                $cate_list[$value['pid']]['son'][] = $value;
            }
        }
        foreach ($cate_list as $key => $value) {
            
            if(empty($value['son'])){
                
                $cate_list[$value['id']]['son'][]=null;
            
            }
        
        }
        
        //var_dump($cate_list);
        //exit();
        $this->assign('cate_list',$cate_list);
    	return $this->fetch();
    }
    public function update(){
    	$id=input('id');
    	$data=input();
		$data['g_content'] =$_POST["g_content"];
		$many_thumb = [];
		$files = request()->file('g_thumb');
        foreach($files as $file){
        // 移动到框架应用根目录/public/uploads/ 目录下
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
        if($info){
            // 成功上传后 获取上传信息
            // 输出 42a79759f284b767dfcb2a0197904287.jpg
             $many_thumb[] = $info->getSaveName(); 
        }else{
            // 上传失败获取错误信息
            echo $file->getError();
        }  
        if($many_thumb){
        	$g_thumb = './uploads/'.time().md5(rand(1000,9999)).'.png';
	    	$image = \think\Image::open(ROOT_PATH.'/public/uploads/'.$many_thumb[0]);
			// 按照原图的比例生成一个最大为2000*2000的缩略图并保存为thumb.png
			$image->thumb(200, 200)->save($g_thumb);

	    	$data['g_thumb'] = $g_thumb;
	    	$data['many_thumb'] = implode(",", $many_thumb);
        }
      }
    	db('goods')->where("id=$id")->update($data);
    	$this->success('更新成功',url('index'));
    }
    public function delete(){
    	$id =input('id');
    	db('goods')->where("id=$id")->delete();
    	$this->success('删除成功',url('index'));
    }
}

?>