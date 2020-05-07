<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends Home_Controller{
    public function __construct(){
    parent::__construct();
    $cart = $this->session->userdata('cart');
      $this->cart_num = count($cart);
    //$this->load->model('goods_model');
    }

    public function index(){
      $cart_num=$this->cart_num;
        $this->render('index',compact('cart_num'));
        
    }
}
?>