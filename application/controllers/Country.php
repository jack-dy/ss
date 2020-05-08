<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Country extends Home_Controller{
    public function __construct(){
    parent::__construct();
    $this->cart = $this->session->userdata('cart')?:array();
    $this->load->model('cart_model');
    $this->load->model('goods_model');
    $this->load->model('category_model');
    $this->load->model('rate_model');
    $this->load->model('country_model');
    $this->load->model('postage_model');

    }

    public function change_country(){
        if(IS_AJAX){
            $country = $this->input->post('country');
            $cart_option = $this->session->userdata('cart_option')?:array();
            $cart_option['cart']['country']=$country;
            $this->session->set_userdata('cart_option', $cart_option);
            echo json_encode(array('code'=>1));
          }
    }
    
}