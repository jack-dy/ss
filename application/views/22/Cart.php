<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cart extends Home_Controller{
    public function __construct(){
    parent::__construct();
    $cart = $this->session->userdata('cart');
      $this->cart_num = count($cart);
    $this->load->model('cart_model');
    }

    public function index(){
      $cart_num=$this->cart_num;
        $this->render('cart',compact('cart_num'));
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