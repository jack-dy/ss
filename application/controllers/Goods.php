<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Goods extends Home_Controller{
    public $cart=array();
    public function __construct(){
		parent::__construct();
    $this->load->model('category_model');
    $this->load->model('goods_model');
    $this->load->model('goods_style_model');
    $this->load->model('rate_model');
    $this->cart = $this->session->userdata('cart')?:array();
    }

    public function index(){
      $id = $this->input->get('id');
      $category = $this->category_model->getCacheTree();
      $list = $this->goods_model->getAllGoods($id);
      foreach($list as $k=>$v){
        $list[$k]['image']=explode(';',$v['goods_images']);
      }
      $cart=$this->cart;
      //print_r($category);
      $title=$category[$id]['name'];
        $this->render('goods',compact('cart', 'title', 'cart_num','list','category'));
    }

    public function detail(){
      $rign = $this->session->userdata('rign')?:'USD';
      $id = $this->input->get('id');
      $rate = $this->rate_model->getRate();
      $category = $this->category_model->getCacheTree();
      $like = $this->goods_model->getAllGoods(0,6);
      foreach($like as $k=>$v){
        $like[$k]['image']=explode(';',$v['goods_images']);
      }
      $goods_style=$this->goods_style_model->getCacheTree();
      $cart=$this->cart;
      $goods = $this->goods_model->getDetail($id);
      if(!empty($goods)){
        $goods['image']=explode(';',$goods['goods_images']);
        if(!empty($goods['goodsStyle_id'])){
          $goods['goodsStyle']=explode(',',$goods['goodsStyle_id']);
        }
        
        $this->render('goods_detail',compact('cart','category','goods','like','rate','goods_style','rign'));
      }else{
        redirect('home/index');
      }
      
      
      
    }

    public function rign(){
      if(IS_AJAX){
        $rign = $this->input->post('rign');
        $this->session->set_userdata('rign',$rign);
      }
    }
}
?>