<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting_express extends Admin_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('express_model');
    }

    public function index(){

        $role=$this->role();
        $list = $this->express_model->getCacheTree();
        return $this->render('setting/express_list.php',compact('list'),$role);

    }
    public function add(){
      if(!IS_AJAX){
        $role=$this->role();
        return $this->render('setting/express_add.php',array(),$role);
      }
      $post = $this->input->post('express');
      if($this->express_model->add($post)){
        echo json_encode(array('code'=>1,'msg'=>'添加成功','url'=>site_url('admin/setting_express/index')));
      }else{
        echo json_encode(array('code'=>0,'msg'=>'添加失败'));
      }
    }

    //更改
    public function edit(){
      $express_id =$this->input->get('express_id')? :null;
      if(!IS_AJAX){
        $role=$this->role();
        $row = $this->express_model->get(compact('express_id') );
        return $this->render('setting/express_edit.php',compact('row'),$role);
      }
      $post = $this->input->post('express');
      if($this->express_model->edit($post,compact('express_id'))){
        echo json_encode(array('code'=>1,'msg'=>'更改成功','url'=>site_url('admin/setting_express/index')));
      }else{
        echo json_encode(array('code'=>0,'msg'=>'更改失败'));
      }
    }

    //删除
    public function delete(){
      $express_id = $this->input->post('express_id');
      $res = $this->express_model->remove($express_id);
      if($res===true){
        echo json_encode(array('code'=>1,'msg'=>'删除成功'));
      }else{
        echo json_encode(array('code'=>0,'msg'=>$res));
      }
    }

}

?>