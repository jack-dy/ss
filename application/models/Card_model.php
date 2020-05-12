<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *  admin 模型，管理后台管理员
 */

class Card_model extends CI_Model{

    const TBL_CARD = 'card';

    //获取列表
    public function getList($search = '',$page=1,$listRows = 15){
        // 筛选条件
        $filter = array();
        //like
        !empty($search) && $filter['card_name'] = trim($search);
        if(!empty($filter['card_name'])){
            $this->db->like('card_name',$filter['card_name']);
        }
        $list =$this->db->limit($listRows,$listRows*($page-1))->get(self::TBL_CARD)->result_array();
        return $list;

	}
	//获取全部列表
	public function getAllCard(){
		$list =$this->db->select('*, "card" as type')->order_by('sort','desc')->get(self::TBL_CARD)->result_array();
        return $list;
	} 

	
	//获取数量
    public function counts(  $search = ''){
		// 筛选条件
		$filter = array();
		//like
		!empty($search) && $filter['card_name'] = trim($search);
		if(!empty($filter['card_name'])){
			$this->db->like('card_name',$filter['card_name']);
		}
			return $this->db->from(self::TBL_CARD)->count_all_results();
	}

    	//获取
	public function get($data=array()){
		return $this->db
			->where($data)
			->get(self::TBL_CARD)
			->row_array();
    }
    
    	//添加
	public function add($data=array()){
		//删除缓存
		$data['create_time']=time();
		$data['update_time']=time();
		return $this->db->insert(self::TBL_CARD,$data);
	}

	//更改
	public function edit($data=array(),$where=array()){
		$data['update_time']=time();
		return $this->db
                ->set($data)
                ->where($where)
                ->update(self::TBL_CARD);
	}

	//删除
	public function remove($card_id){
		
		//判断是否存在国家
			return $this->db->where('card_id',$card_id)->delete(self::TBL_CARD);
	}

}