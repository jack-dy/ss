<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends Admin_Controller{
    public function __construct(){
		parent::__construct();
    $this->load->model('order_model');
    $this->load->model('express_model');
    $this->load->library('pagination');
    //$this->load->model('goods_model');
    }

    public function index(){

    }
    //全部订单
    public function all_list(){
        return $this->getList('全部订单列表', 'all');
    }
    /**
     * 待付款订单列表
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function pay_list()
    {
        return $this->getList('待付款订单列表', 'pay');
    }

    //待发货
    public function delivery_list(){
        return $this->getList('待发货订单列表', 'delivery');
    }

    //已发货
    public function send_list(){
        return $this->getList('已发货订单列表', 'send');
    }

    //已完成
    public function complete_list(){
        return $this->getList('已完成订单列表', 'complete');
    }

    //已取消
    public function cancel_list(){
        return $this->getList('已取消订单列表', 'cancel');
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
        $role=$this->role();
        $page = $this->input->get('page')?: 1;
        $start_time = $this->input->get('start_time')?: '';
        $end_time = $this->input->get('end_time')?: '';
        $order_no = $this->input->get('order_no')?: '';
        $type = $_SERVER['QUERY_STRING'] ;
        if(strpos($type,'&page')){
          $type = strstr ( $_SERVER['QUERY_STRING'] ,  '&page' ,  true );
        }
        $query =array();
        if(!empty($start_time)){
            $query['order.create_time >=']=strtotime($start_time." 00:00:00");
        }
        if(!empty($end_time)){
            $query['order.create_time <=']=strtotime($end_time." 00:00:00");
        }
        if(!empty($order_no)){
            $query['order_no']=$order_no;
        }
        $config['base_url'] = current_url()."?".$type;
        $config['total_rows'] = $this->order_model->counts($dataType,$query);
        $config['per_page'] = 5;
        $config['cur_page'] = $page;
        $config['use_page_numbers'] = true;
        $this->pagination->initialize($config);
        $links = $this->pagination->create_links();

        $list = $this->order_model->getList($dataType,$query,$config['cur_page'],$config['per_page']);
        foreach($list as $k=>$v){
            $temp_goods_name =  explode(';',$v['goods_name']);
            $temp_image =  explode(';',$v['image']);
            $temp_total_num =  explode(';',$v['total_num']);
            $temp_goods_price =  explode(';',$v['goods_price']);
            $list[$k]['goods']=array();
            for($i=0;$i<count($temp_goods_name);$i++){
                $arr = array(
                    'goods_name'=>$temp_goods_name[$i],
                    'image'=>$temp_image[$i],
                    'total_num'=>$temp_total_num[$i],
                    'goods_price'=>$temp_goods_price[$i]
                );
                $list[$k]['goods'][]=$arr;
            }
        }

        return $this->render('order_list.php',compact('list', 'title', 'dataType','links'),$role);
    }

    /* 订单详情
     */
    public function detail(){
        $role=$this->role();
        $order_id = $this->input->get('order_id');
        $row = $this->order_model->getDetail($order_id);
        $detail = $row['detail'];
        $goods = $row['goods'];
        $address = $row['address'];
        $express_list=$this->express_model->getCacheTree();

        return $this->render('order_detail.php',compact('detail','goods','address','express_list'),$role);
        //return $this->render('order_detail.php',compact('detail','goods','address'),$role);
    }

    //填写发货信息
    public function delivery(){
        $order_id = $this->input->get('order_id');
        $post = $this->input->post('order');
        $express_list=$this->express_model->getCacheTree();
        $post['express_company']=$express_list[$post['express_id']]['express_name'];
        $post['delivery_status']=20;
        $post['delivery_time']=time();
        unset($post['express_id']);
        if($this->order_model->update($post,compact('order_id'))){
            redirect('admin/order/detail?order_id='.$order_id);
        }
    }




    public function delete(){
        if(IS_AJAX){
            $set=array(
                'order_status'=>20
            );
            $order_id = $this->input->post('order_id');
            if(!$this->order_model->update($set, compact('order_id') )){
            echo json_encode(array('code'=>0,'msg'=>'取消失败'));
            }else{
            echo json_encode(array('code'=>1,'msg'=>'取消成功'));
            }
        }
    }

    public function toPay(){
        if(IS_AJAX){
            $order_id = $this->input->post('order_id');
            $set=array(
                'pay_status'=>20
            );
            if(!$this->order_model->update($set, compact('order_id') )){
            echo json_encode(array('code'=>0,'msg'=>'手动支付失败'));
            }else{
            echo json_encode(array('code'=>1,'msg'=>'手动支付成功'));
            }
        } 
    }

}

?>