<?php
namespace  app\admin\controller;
use think\Controller;

/**
 * 
 */
class Carousel extends Controller
{
	
	public function index(){
        $carousel_data=db('carousel')->alias('c')->order('c.id asc')->select();

        foreach ($carousel_data as $key => $value) {
            $temp=explode(",",$value['many_thumb']);
             $carousel_data[$key]['many_thumb']=$temp;
        }
        $this->assign('carousel_data',$carousel_data);
        return $this->fetch();
    }

    public function add(){
            
		$cate_list = [];
        $addData=db('category')->alias('c')->order('c.id asc')->select();

        foreach ($addData as $key => $value) {
            if($value['pid']==0){
                // 子分类
                
                $cate_list[$value['id']]=$value;
            }
        }
        $this->assign('cate_list',$cate_list);
        return $this->fetch();
	 
	}

    public function save(){
        $cid=input('cate_id');
        $exit=db('carousel')->where("cate_id='$cid'")->find();
        if($exit){
            $this->success('该轮播分类已存在，请重新选择分类',url('add'));
        }
        $Cinfo=db('category')->where("id='$cid'")->find();
        $many_thumb = [];
        $data=[];
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
        
    }
        $data['cate_id']=$cid;
        $data['cate_name']=$Cinfo['cate_name'];
        $data['many_thumb'] = implode(",", $many_thumb);
        db('carousel')->insert($data);

       

        $this->success('添加成功',url('index'));
    }
	
    public function edit(){
        $id=input('id');
        $info=db('carousel')->where("id='$id'")->find();
        $this->assign('info',$info);
        return $this->fetch();
    }

    public function update(){
        $cid=input('cate_id');
        $many_thumb = [];
        $data=[];
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
        
       }
       $data['many_thumb'] = implode(",", $many_thumb);
       db('carousel')->where("cate_id='$cid'")->update($data);
       $this->success('更新成功',url('index'));
    }

    public function LSDadd(){
        return $this->fetch();
    }

    public function LSDsave(){
        $cid=input('cate_id');
        $cname=input('cate_name');
        $exit=db('carousel')->where("cate_id='$cid'")->find();
        if($exit){
            $this->success('该轮播分类已存在，请重新选择分类',url('LSDadd'));
        }
        $many_thumb = [];
        $data=[];
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
        
    }
        $data['cate_id']=$cid;
        $data['cate_name']=$cname;
        $data['many_thumb'] = implode(",", $many_thumb);
        db('carousel')->insert($data);

       

        $this->success('添加成功',url('index'));
    }

}

?>