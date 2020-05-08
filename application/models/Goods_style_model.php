<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *  admin 模型，管理后台管理员
 */

class Goods_style_model extends CI_Model{

    const TBL_GOODS_STYLE = 'goods_style';
    public function __construct() {
		parent::__construct();
		//$this->load->library('my_cache');
    }
    //获取产品风格数量
    public function getGoodsStyleTotal($where=array()){
        return $this->db->where($where)->count_all_results(self::TBL_GOODS_STYLE);
    }
}