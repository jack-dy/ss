<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cart extends Home_Controller{
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

    public function index(){
      $cart_option = $this->session->userdata('cart_option')?:array();
      // print_r($cart_option);
      $rign = $this->session->userdata('rign')?:'USD';
      $rate = $this->rate_model->getRate();
      $country = $this->country_model->getTree();
      $postage= $this->postage_model->getCacheTree();
      $sel_rate =array();
      foreach($rate as $k=>$v){
        if($v['name']==$rign){
          $sel_rate=$v;
        }
      }

      $calculation=array(
        'subototal'=>0.00,
        'postage'=>0.00,
        'amount' =>0.00
      );
      $all_weight=0;

      $cart=$this->cart;
      $cart_ids = array();
      $lists = array();
      $list = array();
      $category = $this->category_model->getCacheTree();
      foreach($cart as $k=>$v){
        $cart_ids[] =$k;
      }
      if(count($cart_ids)){
        $lists = $this->goods_model->getAllGoods(0,0,$cart_ids);
        if(count($lists)){
          foreach($lists as $k=>$v){
            
            $lists[$k]['image']=explode(';',$v['goods_images']);
            $lists[$k]['category_name']=$category[$v['category_id']]['name'];
            $list[$v['goods_id']]=$lists[$k];
            $calculation['subototal']+=floatval($v['goods_price'])*$sel_rate['rate'];
            $all_weight+=$v['goods_weight'];
          }
        }
      }

      //计算邮费
      if(!empty($cart_option['cy_id'])){
        if($all_weight<0.5 && $all_weight>0){
          $calculation['postage']=sprintf("%01.2f",$postage[$country[$cart_option['cy_id']]['pt_pid']]['pt_price']*$sel_rate['rate']);
        }else if($all_weight>0.5){
          $calculation['postage']=sprintf("%01.2f",($postage[$country[$cart_option['cy_id']]['pt_pid']]['pt_price']+ceil(($all_weight-0.5)/0.5)*$postage[$country[$cart_option['cy_id']]['pt_pid']]['pt_price_add'])*$sel_rate['rate']);
        }
      }
      $calculation['subototal']= sprintf("%01.2f",$calculation['subototal']);
      $calculation['amount'] = sprintf("%01.2f",$calculation['subototal']+$calculation['postage']);
        // if($all_weight){

        // }
        // echo $all_weight;

      $like = $this->goods_model->getAllGoods(0,6);
        foreach($like as $k=>$v){
          
          $like[$k]['image']=explode(';',$v['goods_images']);
        }
      $this->render('cart',compact('cart','list','like','category','sel_rate','country', 'postage','cart_option','calculation'));
    }

    public function reconfirmed(){
      $cart_option = $this->session->userdata('cart_option')?:array();
      //print_r($cart_option);
      $rign = $this->session->userdata('rign')?:'USD';
      $rate = $this->rate_model->getRate();
      $country = $this->country_model->getTree();
      $postage= $this->postage_model->getCacheTree();
      $sel_rate =array();
      foreach($rate as $k=>$v){
        if($v['name']==$rign){
          $sel_rate=$v;
        }
      }

      $calculation=array(
        'subototal'=>0.00,
        'postage'=>0.00,
        'amount' =>0.00
      );
      $all_weight=0;

      $cart=$this->cart;
      $cart_ids = array();
      $lists = array();
      $list = array();
      $category = $this->category_model->getCacheTree();
      foreach($cart as $k=>$v){
        $cart_ids[] =$k;
      }
      if(count($cart_ids)){
        $lists = $this->goods_model->getAllGoods(0,0,$cart_ids);
        if(count($lists)){
          foreach($lists as $k=>$v){
            
            $lists[$k]['image']=explode(';',$v['goods_images']);
            $lists[$k]['category_name']=$category[$v['category_id']]['name'];
            $list[$v['goods_id']]=$lists[$k];
            $calculation['subototal']+=floatval($v['goods_price'])*$sel_rate['rate'];
            $all_weight+=$v['goods_weight'];
          }
        }
      }

      //计算邮费
      if(!empty($cart_option['cy_id'])){
        if($all_weight<0.5 && $all_weight>0){
          $calculation['postage']=sprintf("%01.2f",$postage[$country[$cart_option['cy_id']]['pt_pid']]['pt_price']*$sel_rate['rate']);
        }else if($all_weight>0.5){
          $calculation['postage']=sprintf("%01.2f",($postage[$country[$cart_option['cy_id']]['pt_pid']]['pt_price']+ceil(($all_weight-0.5)/0.5)*$postage[$country[$cart_option['cy_id']]['pt_pid']]['pt_price_add'])*$sel_rate['rate']);
        }
      }
      $calculation['subototal']= sprintf("%01.2f",$calculation['subototal']);
      $calculation['amount'] = sprintf("%01.2f",$calculation['subototal']+$calculation['postage']);
        // if($all_weight){

        // }
        // echo $all_weight;

      $like = $this->goods_model->getAllGoods(0,6);
        foreach($like as $k=>$v){
          
          $like[$k]['image']=explode(';',$v['goods_images']);
        }
      $this->render('reconfirmed',compact('cart','list','like','category','sel_rate','country', 'postage','cart_option','calculation'));
    }

    // /**
    //  * 加入购物车
    //  * @param $goods_id
    //  * @param $goods_num
    //  * @param $goods_sku_id
    //  * @return array
    //  */

    public function add()
    {
      if(IS_AJAX){
        $goods_id = $this->input->post('goods_id');
        if(!$this->cart_model->add($goods_id)){
          echo json_encode(array('code'=>0,'msg'=>'加入购物车失败'));
        }else{
          echo json_encode(array('code'=>1,'msg'=>'加入购物成功','goods_id'=>$goods_id));
        }
      }
    }
    public function reduce(){
      if(IS_AJAX){
        $goods_id = $this->input->post('goods_id');
        if(!$this->cart_model->reduce($goods_id)){
          echo json_encode(array('code'=>0,'msg'=>''));
        }else{
          echo json_encode(array('code'=>1,'msg'=>'','goods_id'=>$goods_id));
        }
      }
    }
    public function submit(){
      if(IS_AJAX){
        $data= $this->input->post('cart');
        $cart_option = $this->session->userdata('cart_option')?:array();
        $cart_option['cart']=$data;
        $this->session->set_userdata('cart_option',$cart_option);
        echo json_encode(array('code'=>1,'msg'=>'提交成功'));
        
      }
    }

    public function toOrder(){
      //$this->session->unset_userdata('cart');
      echo json_encode(array('code'=>1,'msg'=>'提交成功'));

    }




    // /**
    //  * 购物车列表
    //  * @return array
    //  * @throws \think\Exception
    //  * @throws \think\db\exception\DataNotFoundException
    //  * @throws \think\db\exception\ModelNotFoundException
    //  * @throws \think\exception\DbException
    //  */
    // public function lists()
    // {
    //     return $this->renderSuccess($this->model->getList($this->user));
    // }

    // /**
    //  * 加入购物车
    //  * @param $goods_id
    //  * @param $goods_num
    //  * @param $goods_sku_id
    //  * @return array
    //  */
    // public function add($goods_id, $goods_num, $goods_sku_id)
    // {
    //     if (!$this->model->add($goods_id, $goods_num, $goods_sku_id)) {
    //         return $this->renderError($this->model->getError() ?: '加入购物车失败');
    //     }
    //     $total_num = $this->model->getTotalNum();
    //     return $this->renderSuccess(['cart_total_num' => $total_num], '加入购物车成功');
    // }

    // /**
    //  * 减少购物车商品数量
    //  * @param $goods_id
    //  * @param $goods_sku_id
    //  * @return array
    //  */
    // public function sub($goods_id, $goods_sku_id)
    // {
    //     $this->model->sub($goods_id, $goods_sku_id);
    //     return $this->renderSuccess();
    // }

    // /**
    //  * 删除购物车中指定商品
    //  * @param $goods_sku_id (支持字符串ID集)
    //  * @return array
    //  */
    // public function delete($goods_sku_id)
    // {
    //     $this->model->delete($goods_sku_id);
    //     return $this->renderSuccess();
    // }
}
?>