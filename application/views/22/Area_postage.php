<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Area_postage extends Admin_Controller{
    public function __construct(){
		parent::__construct();
        $this->load->model('postage_model');
    }
    public function index(){

        $role=$this->role();
        $list = $this->postage_model->getCacheTree();
        return $this->render('area/postage_list.php',compact('list'),$role);

    }
    public function add(){
      if(!IS_AJAX){
        $role=$this->role();
        return $this->render('area/postage_add.php',array(),$role);
      }
      $post = $this->input->post('postage');
      if($this->postage_model->add($post)){
        echo json_encode(array('code'=>1,'msg'=>'添加成功','url'=>site_url('admin/area_postage/index')));
      }else{
        echo json_encode(array('code'=>0,'msg'=>'添加失败'));
      }
    }

    //更改
    public function edit(){
      $pt_id =$this->input->get('pt_id')? :null;
      if(!IS_AJAX){
        $role=$this->role();
        $row = $this->postage_model->get(compact('pt_id') );
        return $this->render('area/postage_edit.php',compact('row'),$role);
      }
      $post = $this->input->post('postage');
      if($this->postage_model->edit($post,compact('pt_id'))){
        echo json_encode(array('code'=>1,'msg'=>'更改成功','url'=>site_url('admin/area_postage/index')));
      }else{
        echo json_encode(array('code'=>0,'msg'=>'更改失败'));
      }
    }

    //删除
    public function delete(){
      $pt_id = $this->input->post('pt_id');
      $res = $this->postage_model->remove($pt_id);
      if($res===true){
        echo json_encode(array('code'=>1,'msg'=>'删除成功'));
      }else{
        echo json_encode(array('code'=>0,'msg'=>$res));
      }
    }

}
?>