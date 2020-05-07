<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *  admin 模型，管理后台管理员
 */

class Goods_model extends CI_Model{

	const TBL_GOODS = 'goods';


	public function getList($status = null, $category_id = 0, $search = '', $page=1, $sortType = 'all', $sortPrice = false, $listRows = 15){
		//return $this->db->get('category')->result_array();

        // 筛选条件
        $filter = array();
        $where =array();
        $this->load->model('category_model');
        //where_in
        $category_id > 0 && $filter['category_id'] =  $this->category_model->getSubCategoryId($category_id);
        $status > 0 && $where['goods_status'] = $status;
        $where['is_delete']='0';
        //like
        !empty($search) && $filter['goods_name'] = trim($search);
        // 排序规则
        // $sort =array();
        // if ($sortType === 'all') {
        //     $sort = ['goods_sort', 'goods_id' => 'desc'];
        // } elseif ($sortType === 'sales') {
        //     $sort = ['goods_sales' => 'desc'];
        // } elseif ($sortType === 'price') {
        //     $sort = $sortPrice ? ['goods_max_price' => 'desc'] : ['goods_min_price'];
        // }

        if(!empty($filter['category_id'])){
            $this->db->where_in('category_id',$filter['category_id']);
        }
        if(!empty($filter['goods_name'])){
            $this->db->like('goods_name',$filter['goods_name']);
        }
        $list =$this->db->where($where)->limit($listRows,$listRows*($page-1))->get(self::TBL_GOODS)->result_array();
        return $list;
    }

    //获取全部产品
    public function getAllGoods($category_id=0,$limit=0,$in=array()){
        $where=array(
            'goods_status'=>'10',
            'is_delete'=>0
         );
        if($category_id!=0){
            $where['category_id']=$category_id;
        }
        if($limit!=0){
            $this->db->limit($limit,0);
        }
        if(count($in)){
            $this->db->where_in('goods_id',$in);
        }
        $list =$this->db->select('*, "goods" as type')->where($where)->order_by('sort','desc')->get(self::TBL_GOODS)->result_array();
        return $list;
    }

    //获取产品详情
    public function getDetail($id){
        $where=array(
            'goods_id'=>$id,
            'goods_status'=>10,
            'is_delete'=>0
        );
        return $this->db->where($where)->get(self::TBL_GOODS)->row_array();
    }

    //获取数量
    public function counts(  $status = null, $category_id = 0, $search = ''){
		// 筛选条件
        $filter = array();
        $where =array();
        $this->load->model('category_model');
        //where_in
        $category_id > 0 && $filter['category_id'] =  $this->category_model->getSubCategoryId($category_id);
        $status > 0 && $where['goods_status'] = $status;
        $where['is_delete']='0';
        //like
        !empty($search) && $filter['goods_name'] = trim($search);
        if(!empty($filter['category_id'])){
            $this->db->where_in('category_id',$filter['category_id']);
        }
        if(!empty($filter['goods_name'])){
            $this->db->like('goods_name',$filter['goods_name']);
        }
		return $this->db->where($where)->from(self::TBL_GOODS)->count_all_results();
	}

    //获取
	public function get($data=array()){
		return $this->db
			->where($data)
			->get(self::TBL_GOODS)
			->row_array();
	}
    
    //获取货物数量
    public function getGoodsTotal($where=array()){
        $where['is_delete']=0;
        return $this->db->where($where)->count_all_results(self::TBL_GOODS);
    }
    //获取风格数量
    public function getGoodsStyleTotal($id){
        $where=array(
            'is_delete'=>0
        );
        $lists = $this->db->like('goodsStyle_id', $id, 'both')->where($where)->get(self::TBL_GOODS)->result_array();
        $count = 0;
        foreach($lists as $list){
            if($list['goodsStyle_id']!=''){
                $goodsStyle = explode(',',$list['goodsStyle_id']);
                if(in_array($id,$goodsStyle)){
                    $count+=1;
                }
            }
        }
        return $count;

    }

    //添加产品
    public function add($data=array()){
        if (!isset($data['images']) || empty($data['images'])) {
            $this->error = '请上传商品图片';
            return false;
        }
        $data['goods_images']=implode(';',$data['images']);
        unset($data['images']);
        $data['create_time']=time();
		$data['update_time']=time();
		return $this->db->insert(self::TBL_GOODS,$data);

    }

    //更改
	public function edit($data=array(),$where=array()){
        $data['goods_images']=implode(';',$data['images']);
        unset($data['images']);
		$data['update_time']=time();
		return $this->db
				->set($data)
				->where($where)
				->update(self::TBL_GOODS);
    }
    //更改上下架 
    public function state($data=array(),$where=array()){
        return $this->db
				->set($data)
				->where($where)
				->update(self::TBL_GOODS);
    }

    //删除产品
    public  function delete($goods_id){
        return $this->db
        ->set(array('is_delete'=>1)
        )->where('goods_id',$goods_id)
        ->update(self::TBL_GOODS);
    }
}