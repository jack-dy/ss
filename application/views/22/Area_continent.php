<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Area_continent extends Admin_Controller{
    public function __construct(){
		parent::__construct();
        $this->load->model('continent_model');
    }
    public function index(){

        $role=$this->role();
        $list = $this->continent_model->getCacheTree();
        return $this->render('area/continent_list.php',compact('list'),$role);

    }
    public function add(){
      if(!IS_AJAX){
        $role=$this->role();
        return $this->render('area/continent_add.php',array(),$role);
      }
      $post = $this->input->post('continent');
      if($this->continent_model->add($post)){
        echo json_encode(array('code'=>1,'msg'=>'添加成功','url'=>site_url('admin/area_continent/index')));
      }else{
        echo json_encode(array('code'=>0,'msg'=>'添加失败'));
      }
    }

    //更改
    public function edit(){
      $c_id =$this->input->get('c_id')? :null;
      if(!IS_AJAX){
        $role=$this->role();
        $row = $this->continent_model->get(compact('c_id') );
        return $this->render('area/continent_edit.php',compact('row'),$role);
      }
      $post = $this->input->post('continent');
      if($this->continent_model->edit($post,compact('c_id'))){
        echo json_encode(array('code'=>1,'msg'=>'更改成功','url'=>site_url('admin/area_continent/index')));
      }else{
        echo json_encode(array('code'=>0,'msg'=>'更改失败'));
      }
    }

    //删除
    public function delete(){
      $c_id = $this->input->post('c_id');
      $res = $this->continent_model->remove($c_id);
      if($res===true){
        echo json_encode(array('code'=>1,'msg'=>'删除成功'));
      }else{
        echo json_encode(array('code'=>0,'msg'=>$res));
      }

    }

}
?>