<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Goods_style extends Admin_Controller{
    public function __construct(){
		parent::__construct();
    $this->load->model('goods_style_model');
    }

    public function index(){

        $role=$this->role();
        $list = $this->goods_style_model->getCacheTree();
        return $this->render('goods/style_list.php',compact('list'),$role);

    }

    /**
     * 添加风格 
     *  */
    public function add(){
      if(!IS_AJAX){
        $role=$this->role();
        return $this->render('goods/style_add.php',array(),$role);
      }
      $post = $this->input->post('goods_style');
      if($this->goods_style_model->add($post)){
        echo json_encode(array('code'=>1,'msg'=>'添加成功','url'=>site_url('admin/goods_style/index')));
      }else{
        echo json_encode(array('code'=>0,'msg'=>'添加失败'));
      }
    }

    //更改
    public function edit(){
      $goodsStyle_id =$this->input->get('goodsStyle_id')? :null;
      if(!IS_AJAX){
        $role=$this->role();
        $row = $this->goods_style_model->get(compact('goodsStyle_id') );
        return $this->render('goods/style_edit.php',compact('row'),$role);
      }
      $post = $this->input->post('goods_style');
      if($this->goods_style_model->edit($post,compact('goodsStyle_id'))){
        echo json_encode(array('code'=>1,'msg'=>'更改成功','url'=>site_url('admin/goods_style/index')));
      }else{
        echo json_encode(array('code'=>0,'msg'=>'更改失败'));
      }
    }

    //删除
    public function delete(){
      $goodsStyle_id = $this->input->post('goodsStyle_id');
      $res = $this->goods_style_model->remove($goodsStyle_id);
      if($res===true){
        echo json_encode(array('code'=>1,'msg'=>'删除成功'));
      }else{
        echo json_encode(array('code'=>0,'msg'=>$res));
      }
    }


}

?>