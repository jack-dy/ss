<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *  admin 模型，管理后台管理员
 */

class Category_model extends CI_Model{

	const TBL_CATEGORY = 'category';
	
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
		if(!$this->my_cache->get("category")){
			$data =$this->db
			->order_by("sort", "asc")
			->get(self::TBL_CATEGORY)
			->result_array();
			$all = !empty($data) ? $data : array();
			$tree =array();
			foreach ($all as $first){
				if($first['parent_id'] != 0) continue;
				$twoTree = array();
				foreach ($all as $two){
					if($two['parent_id'] != $two['category_id']) continue;
					$threeTree = array();
					foreach ($all as $three){
						$three['parent_id'] == $two['category_id'] && $threeTree[$three['category_id']] = $three;
					}
					!empty($threeTree) && $two['child'] = $threeTree;
    	             $twoTree[$two['category_id']] = $two;
				}
				if (!empty($twoTree)) {
                    array_multisort(array_column($twoTree, 'sort'), SORT_ASC, $twoTree);
                    $first['child'] = $twoTree;
				}
				$tree[$first['category_id']] = $first;
			}
			$this->my_cache->save("category", compact('all', 'tree'),30*60);
		}
		return $this->my_cache->get("category");
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

	public function getSubCategoryId($parent_id, $all = array()){
	$arrIds = array($parent_id);
	empty($all) && $all = $this->getCacheAll();
	foreach($all as $key =>$item){
		if($item['parent_id']==$parent_id){
			unset($all[$key]);
			$subIds =$this->getSubCategoryId($item['parent_id'],$all);
			!empty($subIds) && $arrIds = array_merge($arrIds, $subIds);
		}
	}
	return $arrIds;
	}
	//添加
	public function add($data=array()){
		//删除缓存
		$this->my_cache->delete('category');
		$data['create_time']=time();
		$data['update_time']=time();
		return $this->db->insert(self::TBL_CATEGORY,$data);
	}

	//更改
	public function edit($data=array(),$where=array()){
		$this->my_cache->delete('category');
		$data['update_time']=time();
		return $this->db
				->set($data)
				->where($where)
				->update(self::TBL_CATEGORY);
	}

	//获取
	public function get($data=array()){
		return $this->db
			->where($data)
			->get(self::TBL_CATEGORY)
			->row_array();
	}

	//删除
	public function remove($category_id){
		
		// 判断是否存在商品
		$where =array('category_id'=>$category_id);
		$this->load->model('goods_model');
		if ($goodsCount = $this->goods_model->getCountryTotal($where)) {
			$msg = '该分类下存在' . $goodsCount . '个商品，不允许删除';
			return $msg;
		}else{
			$this->my_cache->delete('category');
			return $this->db->where('category_id',$category_id)->delete(self::TBL_CATEGORY);
		}
	}

	
}