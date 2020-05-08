<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *  admin 模型，管理后台管理员
 */

class Postage_model extends CI_Model{

    const TBL_POSTAGE = 'postage';

    public function __construct() {
		parent::__construct();
		$this->load->library('my_cache');
	}

    public  function getALL()
    {
		if(!$this->my_cache->get("postage")){
			$data =$this->db
			->order_by("sort", "asc")
			->get(self::TBL_POSTAGE)
			->result_array();
			$all = !empty($data) ? $data : array();
			$tree =array();
			foreach ($all as $first){
				$tree[$first['pt_id']] = $first;
			}
			$this->my_cache->save("postage", compact('all', 'tree'),30*60);
		}
		return $this->my_cache->get("postage");
    }

    public function getSubPostageId($parent_id, $all = array()){
        $arrIds = array($parent_id);
        empty($all) && $all = $this->getCacheAll();
        foreach($all as $key =>$item){
            if($item['pt_id']==$parent_id){
                unset($all[$key]);
                 $arrIds = array_merge($arrIds, $item['pt_id']);
            }
        }
        return $arrIds;
    }

    /**
     * 获取所有分类
     * @return mixed
     */
	public function getCacheAll()
    {
		$result =$this->getALL();
		return $result['all'];
        //return $this->db->get(self::TBL_CATEGORY)->result_array();
	}
	
	/**
     * 获取所有分类(树状结构)
     * @return mixed
     */
	
	public function getCacheTree(){
		$result =$this->getALL();
		return $result['tree'];
    }
    
    //添加
	public function add($data=array()){
		//删除缓存
		$this->my_cache->delete('postage');
		return $this->db->insert(self::TBL_POSTAGE,$data);
    }
    //更改
	public function edit($data=array(),$where=array()){
		$this->my_cache->delete('postage');
		return $this->db
				->set($data)
				->where($where)
				->update(self::TBL_POSTAGE);
    }
    
    //获取
	public function get($data=array()){
		return $this->db
			->where($data)
			->get(self::TBL_POSTAGE)
			->row_array();
    }

    //删除
	public function remove($pt_id){
		
		//判断是否存在国家
		$where =array('postage_pid'=>$pt_id);
		$this->load->model('country_model');
		if ($countryCount = $this->country_model->getCountryTotal($where)) {
			$msg = '该分类下存在' . $countryCount . '个国家，不允许删除';
			return $msg;
		}else{
			$this->my_cache->delete('postage');
			return $this->db->where('pt_id',$pt_id)->delete(self::TBL_POSTAGE);
		}
	}
    
}
?>