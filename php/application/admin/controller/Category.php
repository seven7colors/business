<?php
namespace app\admin\controller;
use think\Controller;
/**
 * 
 */
class Category extends Controller
{
	
	public function index()
	{
		$Catedata=db('category')->alias('g')->order('g.id asc')
		->where('level=1')->paginate(8);
		$this->assign('Catedata',$Catedata);
		return $this->fetch();
	}

	public function add()
	{	
		return $this->fetch();
	}

	public function save()
	{
		$Catedata=input();
		db('category')->insert($Catedata);
		$this->success('添加成功',url('index'));
	}

	public function edit()
	{
		$id=input('id');
		$editdata=db('category')->where("id='$id'")->find();
		$this->assign('editdata',$editdata);
		return $this->fetch();
	}

	public function update()
	{	
		$id=input('id');
		$update=input();
		bd('category')->where("id='$id'")->update($update);
		$this->success('修改成功',url('index'));
	}

	public function delete()
	{	
		$id=input('id');
		bd('category')->where("id='$id'")->delete();
		$this->success('删除成功',url('index'));

	}

	public function sonIndex()
	{	
		
		$id=input('id');
		$sondata=db('category')->where("pid='$id'")->select();
		$this->assign('pid',$id);
		$this->assign('sondata',$sondata);
		return $this->fetch();
	}

	public function addSon()
	{	
		$pid=input('pid');
		$pidData=db('category')->where("pid='$pid'")->select();
		$this->assign('pid',$pid);
		$this->assign('pidData',$pidData);
		return $this->fetch();
	}

	public function saveSon()
	{	

		$pid=input('pid');
		$savedata=input();
		db('category')->insert($savedata);
		$this->success('添加成功',url('sonIndex',['id'=>$pid]));
	}

	public function editSon()
	{
		$id=input('id');
		$editson=db('category')->where("id='$id'")->find();
		$this->assign('editson',$editson);
		return $this->fetch();
	}

	public function updateson()
	{
		$pid=input('pid');
		$id=input('id');
		$savedata=input();
		db('category')->where("id='$id'")->update($savedata);
		$this->success('修改成功',url('sonIndex',['id'=>$pid]));
	}

	public function deleteSon()
	{
		$id=input('id');
		$pid=input('pid');
		db('category')->where("id='$id'")->delete();
		$this->success('删除成功',url('sonIndex',['id'=>$pid]));
	}

}

?>