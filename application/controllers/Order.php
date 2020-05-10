<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends Home_Controller{
    public function __construct(){
    parent::__construct();
    $this->cart = $this->session->userdata('cart')?:array();

    }
    // public function index(){
    //   $this->config->load('email', TRUE);
    //   $config_email = $this->config->item('email');
    // }
    public function finish(){
      $cart=$this->cart;
      $this->render('order_finish',compact('cart'));
    }
    
}
?>