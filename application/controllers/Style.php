<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Style extends Home_Controller{
    public function __construct(){
    parent::__construct();
    $this->cart = $this->session->userdata('cart')?:array();
    $this->load->model('goods_model');
    $this->load->model('category_model');
    $this->load->model('style_model');

    }
    public function index(){
      $id = $this->input->get('id');
      $category = $this->category_model->getCacheTree();
      $style = $this->style_model->getCacheTree();
      $list = $this->goods_model->getAllStyleGoods($id);
      foreach($list as $k=>$v){
        $list[$k]['image']=explode(';',$v['goods_images']);
      }
      $cart=$this->cart;
      $title=$style[$id]['name'];
      
        $this->render('style',compact('cart', 'title','list','category','style'));
    }

    
}
?>