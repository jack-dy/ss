<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *  admin 模型，管理后台管理员
 */

class Express_model extends CI_Model{

    const TBL_EXPRESS = 'express';
    public function __construct() {
		parent::__construct();
		$this->load->library('my_cache');
    }
    
    /**
     * 所有分类
     * @return mixed
     */
	public  function getALL()
    {
		if(!$this->my_cache->get("express")){
			$data =$this->db
			->order_by("sort", "asc")
			->get(self::TBL_EXPRESS)
			->result_array();
			$all = !empty($data) ? $data : array();
			$tree =array();
			foreach ($all as $first){
				$tree[$first['express_id']] = $first;
			}
			$this->my_cache->save("express", compact('all', 'tree'),30*60);
		}
		return $this->my_cache->get("express");
    }

	/**
     * 获取所有分类
     * @return mixed
     */
	public function getCacheAll()
    {
		$result = $this->getALL();
		return $result['all'];
        //return $this->db->get(self::TBL_CATEGORY)->result_array();
	}
	
	/**
     * 获取所有分类(树状结构)
     * @return mixed
     */
	
	public function getCacheTree(){
		$result = $this->getALL();
		return $result['tree'];
	}

	//添加
	public function add($data=array()){
		//删除缓存
		$this->my_cache->delete('express');
		$data['create_time']=time();
		$data['update_time']=time();
		return $this->db->insert(self::TBL_EXPRESS,$data);
	}

	//更改
	public function edit($data=array(),$where=array()){
		$this->my_cache->delete('express');
		$data['update_time']=time();
		return $this->db
				->set($data)
				->where($where)
				->update(self::TBL_EXPRESS);
	}

	//获取
	public function get($data=array()){
		return $this->db
			->where($data)
			->get(self::TBL_EXPRESS)
			->row_array();
	}

	//删除
	public function remove($express_id){
        $this->my_cache->delete('express');
        return $this->db->where('express_id',$express_id)->delete(self::TBL_EXPRESS);
	}

}
?>