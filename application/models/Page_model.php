<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *  admin 模型，管理后台管理员
 */

class Page_model extends CI_Model{

    const TBL_PAGE = 'page';
    public function __construct() {
		parent::__construct();
		$this->load->library('my_cache');
    }
    
    public function detail(){
        return $this->db->get(self::TBL_PAGE)->row_array();
    }

    public function update($data){
        return $this->db->set($data)->update(self::TBL_PAGE);
    }

}
?>