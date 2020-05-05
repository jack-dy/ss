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