<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends Admin_Controller{
    public function __construct(){
		parent::__construct();
    $this->load->model('order_model');
    //$this->load->model('goods_model');
    }

    public function index(){

    }
    //全部订单
    public function all_list(){
        return $this->getList('全部订单列表', 'all');
    }

    //待发货
    public function delivery_list(){

    }

    //已完成
    public function complete_list(){

    }

    //已取消
    public function cancel_list(){

    }

    /**
     * 订单列表
     * @param string $title
     * @param string $dataType
     * @return mixed
     * @throws \think\exception\DbException
     */
    private function getList($title, $dataType)
    {
        $list = $this->order_model->getList($dataType);
        print_r($list);
        //return $this->fetch('index', compact('title', 'dataType', 'list'));
    }

}

?>