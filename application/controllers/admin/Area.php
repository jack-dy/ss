<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Area extends Admin_Controller{
    public function __construct(){
		parent::__construct();
        $this->load->model('country_model');
        $this->load->model('continent_model');
        $this->load->model('postage_model');
    }
    public function index(){
        $role=$this->role();
        $continent = $this->continent_model->getCacheTree();
        $postage = $this->postage_model->getCacheTree();
        $status =$this->input->get('status')? :null;
        $postage_pid =$this->input->get('postage_pid')? :null;
        $continent_pid = $this->input->get('continent_pid')? :null;
        $country_name = $this->input->get('country_name')?: '';
        $page = $this->input->get('page')?: 1;
        $list = $this->country_model->getList($status, $country_name, $postage_pid, $continent_pid,  $page);
        //print_r($list);
        return $this->render('country_list.php',compact('list', 'continent', 'postage'),$role);
    }

    public function add(){
      if(!IS_AJAX){
        $role=$this->role();
        $continent = $this->continent_model->getCacheTree();
        $postage = $this->postage_model->getCacheTree();
        return $this->render('country_add.php',compact('continent','postage'),$role);
      }
       $post = $this->input->post('country');
      if($this->country_model->add($post)){
        echo json_encode(array('code'=>1,'msg'=>'添加成功','url'=>site_url('admin/area/index')));
      }else{
        echo json_encode(array('code'=>0,'msg'=>'添加失败'));
      }

    }

    //更改
    public function edit(){
      $cy_id =$this->input->get('country_id')? :null;
      if(!IS_AJAX){
        $role=$this->role();
        $continent = $this->continent_model->getCacheTree();
        $postage = $this->postage_model->getCacheTree();
        $row = $this->country_model->get(compact('cy_id') );
        return $this->render('country_edit.php',compact('row','continent', 'postage'),$role);
      }
      $post = $this->input->post('country');
      if($this->country_model->edit($post,compact('cy_id'))){
        echo json_encode(array('code'=>1,'msg'=>'更改成功','url'=>site_url('admin/area/index')));
      }else{
        echo json_encode(array('code'=>0,'msg'=>'更改失败'));
      }
    }

    //删除
    public function delete(){
      $cy_id = $this->input->post('cy_id');
      if($this->country_model->remove($cy_id)){
        echo json_encode(array('code'=>1,'msg'=>'删除成功'));
      }else{
        //$this->error;
        echo json_encode(array('code'=>0,'msg'=>'删除失败'));
      }
      
    }

    //更改上架下架状态
    public function state(){
        $cy_id = $this->input->post('cy_id');
        $cy_status = $this->input->post('state');
  
        if($this->country_model->state(compact('cy_status'),compact('cy_id'))){
          echo json_encode(array('code'=>1,'msg'=>'操作成功'));
        }else{
          echo json_encode(array('code'=>0,'msg'=>'操作失败'));
        }
      }

}
?>