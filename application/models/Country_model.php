<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *  admin 模型，管理后台管理员
 */

class Country_model extends CI_Model{
    const TBL_COUNTRY = 'country';

    public function __construct() {
		parent::__construct();
		$this->load->library('my_cache');
	}

    public function getList($status = null,  $search = '', $postage_pid = 0, $continent_pid = 0, $page=1, $sortType = 'all', $listRows = 15){
		//return $this->db->get('category')->result_array();

        // 筛选条件
        $filter = array();
        $where =array();
        //where_in
        $postage_pid > 0 && $where['postage_pid'] = $postage_pid; 
        $continent_pid > 0 && $where['continent_pid'] = $continent_pid; 

        $status > 0 && $where['cy_status'] = $status;
        // $where['is_delete']='0';
        //like
        !empty($search) && $filter['cy_name_en'] = trim($search);
        !empty($search) && $filter['cy_name_cn'] = trim($search);
        // 排序规则
        // $sort =array();
        // if ($sortType === 'all') {
        //     $sort = ['goods_sort', 'goods_id' => 'desc'];
        // } elseif ($sortType === 'sales') {
        //     $sort = ['goods_sales' => 'desc'];
        // } elseif ($sortType === 'price') {
        //     $sort = $sortPrice ? ['goods_max_price' => 'desc'] : ['goods_min_price'];
        // }
        if(!empty($filter['cy_name_en'])){
            $this->db->like('cy_name_en',$filter['cy_name_en']);
            $this->db->or_like('cy_name_cn',$filter['cy_name_cn']);

        }
        // if(!empty($filter['cy_name_cn'])){
        //     $this->db->like('cy_name_cn',$filter['cy_name_cn']);
        // }
        $list =$this->db->where($where)->limit($listRows,$listRows*($page-1))->get(self::TBL_COUNTRY)->result_array();
        return $list;
    }

    //获取数量
    public function counts($status = null,  $search = '', $postage_pid = 0, $continent_pid = 0){
    // 筛选条件
        $filter = array();
        $where =array();
        //where_in
        $postage_pid > 0 && $where['postage_pid'] = $postage_pid; 
        $continent_pid > 0 && $where['continent_pid'] = $continent_pid; 
        $status > 0 && $where['cy_status'] = $status;
        // $where['is_delete']='0';
        //like
        !empty($search) && $filter['cy_name_en'] = trim($search);
        !empty($search) && $filter['cy_name_cn'] = trim($search);

        if(!empty($filter['cy_name_en'])){
            $this->db->like('cy_name_en',$filter['cy_name_en']);
            $this->db->or_like('cy_name_cn',$filter['cy_name_cn']);
        }
        // if(!empty($filter['cy_name_cn'])){
        //     $this->db->like('cy_name_cn',$filter['cy_name_cn']);
        // }
        return $this->db->where($where)->from(self::TBL_COUNTRY)->count_all_results();
    }

       //更改上下架 
       public function state($data=array(),$where=array()){
        $this->my_cache->delete("country");
        return $this->db
				->set($data)
				->where($where)
				->update(self::TBL_COUNTRY);
    }

    //添加国家
    public function add($data=array()){
        $this->my_cache->delete("country");
		return $this->db->insert(self::TBL_COUNTRY,$data);

    }

    //更改
	public function edit($data=array(),$where=array()){
		return $this->db
				->set($data)
				->where($where)
				->update(self::TBL_COUNTRY);
    }

      //获取
	public function get($data=array()){
		return $this->db
			->where($data)
			->get(self::TBL_COUNTRY)
			->row_array();
    }

    //获取国家数量
    public function getCountryTotal($where=array()){
        return $this->db->where($where)->count_all_results(self::TBL_COUNTRY);
    }
    
    //删除国家
    public  function remove($id){
        return $this->db->where('cy_id',$id)->delete(self::TBL_COUNTRY);
    }

    //获取全部list
    public function getAllList(){
        if(!$this->my_cache->get("country")){
            $where =array('cy_status'=>10);
            $data =$this->db->where($where)->get(self::TBL_COUNTRY)->result_array();
            $all = !empty($data) ? $data : array();
            $tree =array();
            foreach ($all as $first){
                $tree[$first['cy_id']]=$first;
            }
            $this->my_cache->save("country",  compact('all', 'tree'),24*60*60);
            return $this->my_cache->get("country");
        }
        return $this->my_cache->get("country");
    }
    //获取全部国家
    public function getTree(){
        $list = $this->getAllList();
        return $list['tree'];

        
    }



}