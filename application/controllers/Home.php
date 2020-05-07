<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends Home_Controller{
    public $cart=array();
    public function __construct(){
    parent::__construct();
    $this->load->model('category_model');
    $this->load->model('goods_model');
    $this->load->model('card_model');
    $this->cart = $this->session->userdata('cart')?:array();
    //$this->load->model('goods_model');
    }

    public function index(){
      
      $cart=$this->cart;
      $goods = $this->goods_model->getAllGoods();
      foreach($goods as $k=>$v){
        $goods[$k]['image']=explode(';',$v['goods_images']);
      }
      $card = $list = $this->card_model->getAllCard();
      $list = $this->arraySort(array_merge($goods,$card),'sort','asc');
      $category = $this->category_model->getCacheTree();
      //$list =$this->arraySort($list,'sort','asc');
      $this->render('index',compact('cart','list','category'));
        
    }
}
?>