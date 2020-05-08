<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *  admin 模型，管理后台管理员
 */

class Continent_model extends CI_Model{

    const TBL_CONTINNT = 'continent';

    public function __construct() {
		parent::__construct();
		$this->load->library('my_cache');
	}

    public  function getALL()
    {
		if(!$this->my_cache->get("continent")){
			$data =$this->db
			->order_by("sort", "asc")
			->get(self::TBL_CONTINNT)
			->result_array();
			$all = !empty($data) ? $data : array();
			$tree =array();
			foreach ($all as $first){
				$tree[$first['c_id']] = $first;
			}
			$this->my_cache->save("continent", compact('all', 'tree'),30*60);
		}
		return $this->my_cache->get("continent");
    }

    public function getSubContinentId($parent_id, $all = array()){
        $arrIds = array($parent_id);
        empty($all) && $all = $this->getCacheAll();
        foreach($all as $key =>$item){
            if($item['c_id']==$parent_id){
                unset($all[$key]);
                 $arrIds = array_merge($arrIds, $item['c_id']);
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
		$this->my_cache->delete('continent');
		return $this->db->insert(self::TBL_CONTINNT,$data);
    }
    //更改
	public function edit($data=array(),$where=array()){
		$this->my_cache->delete('continent');
		return $this->db
				->set($data)
				->where($where)
				->update(self::TBL_CONTINNT);
    }
    
    //获取
	public function get($data=array()){
		return $this->db
			->where($data)
			->get(self::TBL_CONTINNT)
			->row_array();
    }

    //删除
	public function remove($c_id){
		
		//判断是否存在国家
		$where =array('continent_pid'=>$c_id);
		$this->load->model('country_model');
		if ($countryCount = $this->country_model->getCountryTotal($where)) {
			$msg = '该分类下存在' . $countryCount . '个国家，不允许删除';
			return $msg;
		}else{
			$this->my_cache->delete('continent');
			return $this->db->where('c_id',$c_id)->delete(self::TBL_CONTINNT);
		}
	}
    

    
}
?>