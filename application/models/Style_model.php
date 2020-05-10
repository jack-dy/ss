<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *  admin 模型，管理后台管理员
 */

class Style_model extends CI_Model{

    const TBL_STYLE = 'style';
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
		if(!$this->my_cache->get("style")){
			$data =$this->db
			->order_by("sort", "asc")
			->get(self::TBL_STYLE)
			->result_array();
			$all = !empty($data) ? $data : array();
			$tree =array();
			foreach ($all as $first){
				$tree[$first['style_id']] = $first;
			}
			$this->my_cache->save("style", compact('all', 'tree'),30*60);
		}
		return $this->my_cache->get("style");
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
		$this->my_cache->delete('style');
		$data['create_time']=time();
		$data['update_time']=time();
		return $this->db->insert(self::TBL_STYLE,$data);
	}

	//更改
	public function edit($data=array(),$where=array()){
		$this->my_cache->delete('style');
		$data['update_time']=time();
		return $this->db
				->set($data)
				->where($where)
				->update(self::TBL_STYLE);
	}

	//获取
	public function get($data=array()){
		return $this->db
			->where($data)
			->get(self::TBL_STYLE)
			->row_array();
	}

	//删除
	public function remove($style_id){
		
		// 判断是否存在商品
		$this->load->model('goods_style_model');
		if ($goodsCount = $this->goods_style_model->getGoodsStyleTotal(compact('style_id'))) {
			$msg = '该风格下存在' . $goodsCount . '个商品，不允许删除';
			return $msg;
		}else{
			$this->my_cache->delete('style');
			return $this->db->where('style_id',$style_id)->delete(self::TBL_STYLE);
		}
	}
}