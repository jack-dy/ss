<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *  admin 模型，管理后台管理员
 */

class Goods_model extends CI_Model{

	const TBL_GOODS = 'goods';
    const TBL_GOODS_STYLE = 'goods_style';

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
        if(count($in)>0){
            $this->db->where_in('goods_id',$in);
        }
        $list =$this->db->select('*, "goods" as type')->where($where)->order_by('sort','desc')->get(self::TBL_GOODS)->result_array();
        return $list;
    }

    //获取随机产品
    public function getLike($category_id=0,$limit=0){
        $where=array(
            'goods_status'=>'10',
            'is_delete'=>0
         ); 
         if($category_id!=0){
            $where['category_id']=$category_id;
        }
        $list =$this->db->select('*, "goods" as type')->where($where)->get(self::TBL_GOODS)->result_array();
        $lists = $this->shuffle_assoc($list);
        $limit=$limit>count($lists)?count($lists):$limit;
        $result=array();
        for($i=0;$i<$limit;$i++){
            $result[]=$lists[$i];  
        }
        return $result;
    }
    private function shuffle_assoc($list) {
        if (!is_array($list)) return $list;
        $keys = array_keys($list);
        shuffle($keys);
        $random = array();
        foreach ($keys as $key)
            $random[] = $list[$key];
        return $random;
   }

    


    //获取全部产品
    public function getAllStyleGoods($styleid=0,$limit=0){
        $where=array(
            'goods_status'=>'10',
            'is_delete'=>0
         );
         $aa =1;
        if($styleid!=0){
             $goodsStyle = $this->db->where('style_id',$styleid)->get(self::TBL_GOODS_STYLE)->result_array();
             $in = array();
             foreach($goodsStyle as $key=>$item){
                 $in[]=$item['goods_id'];
                 //$in[$key]=$item['goods_id'];
                //return $item['goods_id'];
             }
            // $aa =$this->db->last_query();
            
        }
        if($limit!=0){
            $this->db->limit($limit,0);
        }
        if(count($in)>0){
            return $this->db->select('*, "goods" as type')->where($where)->where_in('goods_id',$in)->order_by('sort','desc')->get(self::TBL_GOODS)->result_array();
        }else{
            return array();
        }
        // $list =$this->db->select('*, "goods" as type')->where($where)->order_by('sort','desc')->get(self::TBL_GOODS)->result_array();
        // return $list;
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
        $data['goods.goods_id'] =$data['goods_id'];
        unset($data['goods_id']);
        $select = array(
            'goods.goods_id',
            'goods_name',
            'category_id',
            'content',
            'goods_images',
            'goods_no',
            'goods_price',
            'stock_num',
            'goods_weight',
            'sort',
            'goods_status',
            'is_delete',
            'GROUP_CONCAT(style_id SEPARATOR ";") as style_ids'
        );
        return $this->db
            ->select($select)
            ->from(self::TBL_GOODS)
            ->join(self::TBL_GOODS_STYLE,'goods.goods_id = goods_style.goods_id','left')
            ->where($data)
            ->group_by('goods.goods_id')
			->get()
            ->row_array();
        //return $this->db->last_query();
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
    public function creatGoods($data=array()){
        if (!isset($data['images']) || empty($data['images'])) {
            $this->error = '请上传商品图片';
            return false;
        }
        $data['goods_images']=implode(';',$data['images']);
        
        $data['create_time']=time();
        $data['update_time']=time();
        $styles = $data['style_id'];
        unset($data['images']);
        unset($data['style_id']);
        //开启事务
        $this->db->trans_begin();
        $goods_id = $this->add($data);
        if(count($styles)>0){
            $this->saveGoodsStyle($goods_id,$styles);
        }
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            return false;
        }else{
            $this->db->trans_commit();
            return true;
        }
    }

    //更改
	public function edit($data=array(),$where=array()){
        if (!isset($data['images']) || empty($data['images'])) {
            $this->error = '请上传商品图片';
            return false;
        }
        $data['goods_images']=implode(';',$data['images']);
        $styles = $data['style_id'];
        unset($data['images']);
        unset($data['style_id']);
        //开启事务
        $this->db->trans_begin();
        $data['update_time']=time();
        $this->update($data,$where);
        $goods_id = $where['goods_id'];
        $this->delGoodsStyle($goods_id);
        if(count($styles)>0){
            $this->saveGoodsStyle($goods_id,$styles);
        }
        

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            return false;
        }else{
            $this->db->trans_commit();
            return true;
        }
    }

    //添加产品
    private function add($data=array()){
        $this->db->insert(self::TBL_GOODS,$data);
        return $this->db->insert_id(self::TBL_GOODS);
    }
    private function saveGoodsStyle($goods_id, $styles){
        $goodsStyle = array();
        foreach($styles as $style){
            $goodsStyle[]=array(
                'goods_id'=>$goods_id,
                'style_id'=>$style,
                'create_time'=>time()
            );
        }
        return $this->db->insert_batch(self::TBL_GOODS_STYLE,$goodsStyle);
    }
    private function delGoodsStyle($goods_id){
        return $this->db->where('goods_id',$goods_id)->delete(self::TBL_GOODS_STYLE);
    }
    //
    private function update($data=array(),$where=array()){
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