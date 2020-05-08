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
        $role=$this->role();
        $page = $this->input->get('page')?: 1;

        // $type = $_SERVER['QUERY_STRING'] ;
        // if(strpos($type,'&page')){
        //   $type = strstr ( $_SERVER['QUERY_STRING'] ,  '&page' ,  true );
        // }
        //  $config['base_url'] = current_url()."?".$type;
        //  $config['total_rows'] = $this->order_model->counts($dataType);
        // $config['per_page'] = 15;
        // $config['cur_page'] = $page;
        // $config['use_page_numbers'] = true;
        // $this->pagination->initialize($config);
        // $links = $this->pagination->create_links();

        $list = $this->order_model->getList($dataType);
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
            // unset($list[$k]['goods_name']);
            // unset($list[$k]['image']);
            // unset($list[$k]['total_num']);
            // unset($list[$k]['goods_price']);
        }

        return $this->render('order_list.php',compact('list', 'title', 'dataType'),$role);
        //return $this->fetch('index', compact('title', 'dataType', 'list'));
    }

}

?>