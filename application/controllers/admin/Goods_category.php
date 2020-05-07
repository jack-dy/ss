<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Goods_category extends Admin_Controller{
    public function __construct(){
		parent::__construct();
    $this->load->model('category_model');
    //$this->load->model('goods_model');
    }

    public function index(){

        $role=$this->role();
        $list = $this->category_model->getCacheTree();
        return $this->render('goods/category_list.php',compact('list'),$role);

    }
    public function add(){
      if(!IS_AJAX){
        $role=$this->role();
        return $this->render('goods/category_add.php',array(),$role);
      }
      $post = $this->input->post('category');
      if($this->category_model->add($post)){
        echo json_encode(array('code'=>1,'msg'=>'添加成功','url'=>site_url('admin/goods_category/index')));
      }else{
        echo json_encode(array('code'=>0,'msg'=>'添加失败'));
      }
    }

    //更改
    public function edit(){
      $category_id =$this->input->get('category_id')? :null;
      if(!IS_AJAX){
        $role=$this->role();
        $row = $this->category_model->get(compact('category_id') );
        return $this->render('goods/category_edit.php',compact('row'),$role);
      }
      $post = $this->input->post('category');
      if($this->category_model->edit($post,compact('category_id'))){
        echo json_encode(array('code'=>1,'msg'=>'更改成功','url'=>site_url('admin/goods_category/index')));
      }else{
        echo json_encode(array('code'=>0,'msg'=>'更改失败'));
      }
    }

    //删除
    public function delete(){
      $category_id = $this->input->post('category_id');
      $res = $this->category_model->remove($category_id);
      if($res===true){
        echo json_encode(array('code'=>1,'msg'=>'删除成功'));
      }else{
        echo json_encode(array('code'=>0,'msg'=>$res));
      }
    }


}

?>