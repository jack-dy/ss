<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *  admin 模型，管理后台管理员
 */

class Cart_model extends CI_Model{
    /* @var array $cart 购物车列表 */
    private $cart = array();

    /**
     * 构造方法
     * Cart constructor.
     * @param $user_id
     */
    public function __construct()
    {
        $this->cart = $this->session->userdata('cart')?:array();
    }

    //添加购物车
    public function add($goods_id){
        $index = $goods_id;
        $data=compact('goods_id');
        if(empty($this->cart)){
            $this->cart[$index]=$data;
            $this->session->set_userdata('cart',$this->cart);
            return true;
        }
        $this->cart[$index]=$data;
        $this->session->set_userdata('cart',$this->cart);
        return true;


    }
    //减少购物车
    public function reduce($goods_id){
        $index = $goods_id;
        unset($this->cart[$index]);
        $this->session->set_userdata('cart',$this->cart);
        return true;
    }


}