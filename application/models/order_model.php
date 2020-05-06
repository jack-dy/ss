<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *  admin 模型，管理后台管理员
 */

class Order_model extends CI_Model{

    const TBL_ORDER = 'order';
    const TBL_ORDER_GOODS = 'order_goods';
    const TBL_ORDER_ADDRESS = 'order_address';

    public function getList($dataType, $query = array()){
        // if(!empty($query)){
        //     $this->db->where($query);

        // }
        $select = array(
            'order.order_id',
            'order_no',
            'pay_price',
            'express_price',
            'order_status',
            'order.create_time',
            'GROUP_CONCAT(goods_name SEPARATOR ";") as goods_name',
            'GROUP_CONCAT(image SEPARATOR ";") as image',
            'GROUP_CONCAT(total_num SEPARATOR ";") as total_num',
            'GROUP_CONCAT(goods_price SEPARATOR ";") as goods_price',
        );
        $str_select =implode(',',$select);

        return $this->db->from(self::TBL_ORDER)
                        ->select($str_select,false)
                        ->join(self::TBL_ORDER_GOODS, 'order.order_id = order_goods.order_id', 'left')
                        ->where($this->transferDataType($dataType))
                        ->group_by('order.order_id')
                        ->get()->result_array();
    }

    
    /**
     * 创建订单
     * @param 
     * @return array
     */

     public function createOrder($init){

        //开启事务
        $this->db->trans_begin();

         //记录订单信息
         $order_id = $this->add($init);
        // 保存订单商品信息
        $this->saveOrderGoods($order_id, $init);
        // 记录收货地址
        $this->saveOrderAddress($order_id, $init);

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            return false;
        }else{
            $this->db->trans_commit();
            return true;
        }
     }

        private function add($init){
            $order = array(
                'order_no'=>time().round(10,99),
                'currency'=>$init['sel_rate']['name'],
                'total_weight'=>$init['calculation']['all_weight'],
                'total_price'=>$init['calculation']['subototal'],
                'pay_price'=>$init['calculation']['amount'],
                'express_price'=>$init['calculation']['postage'],
                'pay_status'=>10,
                'order_status'=>10,
                'create_time'=>time()
            );
            $this->db->insert(self::TBL_ORDER,$order);
            return $this->db->insert_id(self::TBL_ORDER);
        }

        //
        private function saveOrderGoods($order_id, $init){
            $goodsList = array();
            $sel_rate =$init['sel_rate'];
            foreach($init['list'] as $goods){
                $goodsList[]=array(
                    'goods_id'=>$goods['goods_id'],
                    'goods_name'=>$goods['goods_name'],
                    'image'=>$goods['image'][0],
                    'content'=>$goods['content'],
                    'goods_no'=>$goods['goods_no'],
                    'goods_price'=>$goods['goods_price']*$sel_rate['rate'],
                    'goods_weight'=>$goods['goods_weight'],
                    'total_num'=>'1',
                    'total_price'=>$goods['goods_price']*$sel_rate['rate'],
                    'total_pay_price'=>$goods['goods_price']*$sel_rate['rate'],
                    'order_id'=>$order_id,
                    'create_time'=>time()
                );
            }
            return $this->db->insert_batch(self::TBL_ORDER_GOODS,$goodsList);
        }

        private function saveOrderAddress($order_id, $init){
            $cart_option=$init['cart_option'];
            $country=$init['country'];
            $address=array(
                'name'=>$cart_option['cart']['name'],
                'phone_fix'=>'',
                'phone'=>$cart_option['cart']['phone'],
                'order_id'=>$order_id,
                'detail'=>$cart_option['cart']['address'],
                'email'=>$cart_option['cart']['email'],
                'country'=>$country[$cart_option['cart']['country']]['cy_name_en'],
                'create_time'=>time()
            );
            return $this->db->insert(self::TBL_ORDER_ADDRESS,$address);
        }


    /**
     * 转义数据类型条件
     * @param $dataType
     * @return array
     */
    private function transferDataType($dataType)
    {
        // 数据类型
        $filter = array();
        switch ($dataType) {
            case 'receipt':
                $filter = array('receipt_status' => 10);
                break;
            case 'complete':
                $filter = array('order_status' => 30);
                break;
            case 'cancel':
                $filter = array('order_status' => 20);
                break;
            case 'all':
                $filter = array();
                break;
        }
        return $filter;
    }
}
?>