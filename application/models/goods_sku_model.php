<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *  admin 模型，管理后台管理员
 */

class Goods_sku_model extends CI_Model{

	const TBL_GOODS_SKU = 'goods_sku';


	public function getList(){
        $query = $this->db->get(self::TBL_GOODS_SKU);
        return $query->result_array();
    }
}