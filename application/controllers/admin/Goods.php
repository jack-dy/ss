<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Goods extends Admin_Controller{
    public function __construct(){
		parent::__construct();
    $this->load->model('category_model');
    $this->load->model('goods_model');
    $this->load->library('pagination');
    }

    public function index(){

        $role=$this->role();
        $category = $this->category_model->getCacheTree();
        $goods_status =$this->input->get('goods_status')? :null;
        $category_id = $this->input->get('category_id')? :null;
        $goods_name = $this->input->get('goods_name')?: '';
        $page = $this->input->get('page')?: 1;

        $type = $_SERVER['QUERY_STRING'] ;
        if(strpos($type,'&page')){
          $type = strstr ( $_SERVER['QUERY_STRING'] ,  '&page' ,  true );
        }
         $config['base_url'] = current_url()."?".$type;
         $config['total_rows'] = $this->goods_model->counts($goods_status, $category_id, $goods_name);
        $config['per_page'] = 15;
        $config['cur_page'] = $page;
        $config['use_page_numbers'] = true;
        $this->pagination->initialize($config);
        $links = $this->pagination->create_links();

        $list = $this->goods_model->getList($goods_status, $category_id, $goods_name,$page);
        foreach($list as $k=>$v){
          $list[$k]['image']=explode(';',$v['goods_images']);
        }
        return $this->render('goods_list.php',compact('category','list','links'),$role);

    }

    /**
     * 添加商品 
     *  */
    public function add(){
      if(!IS_AJAX){
        $role=$this->role();
        // 商品分类
        $category = $this->category_model->getCacheTree();
        return $this->render('goods_add.php',compact('category'),$role);
      }
      $post = $this->input->post('goods');
      if($this->goods_model->add($post)){
        echo json_encode(array('code'=>1,'msg'=>'添加成功','url'=>site_url('admin/goods/index')));
      }else{
        echo json_encode(array('code'=>0,'msg'=>'添加失败'));
      }
    }

    //更改
    public function edit(){
      $goods_id =$this->input->get('goods_id')? :null;
      if(!IS_AJAX){
        $role=$this->role();
        // 商品分类
        $category = $this->category_model->getCacheTree();
        $row = $this->goods_model->get(compact('goods_id') );
        $row['image']=explode(';',$row['goods_images']);
        return $this->render('goods_edit.php',compact('row','category'),$role);
      }
       $post = $this->input->post('goods');
      if($this->goods_model->edit($post,compact('goods_id'))){
        echo json_encode(array('code'=>1,'msg'=>'更改成功','url'=>site_url('admin/goods/index')));
      }else{
        echo json_encode(array('code'=>0,'msg'=>'更改失败'));
      }
    }

    //更改上架下架状态
    public function state(){
      $goods_id = $this->input->post('goods_id');
      $goods_status = $this->input->post('state');

      if($this->goods_model->state(compact('goods_status'),compact('goods_id'))){
        echo json_encode(array('code'=>1,'msg'=>'操作成功','url'=>site_url('admin/goods/index')));
      }else{
        echo json_encode(array('code'=>0,'msg'=>'操作失败'));
      }
      // echo json_encode(array('code'=>0,'msg'=>'操作失败'.$state));
    }

  /**
     * 删除商品
     * @param $goods_id
     * @return array
     */
    public function delete()
    {
        $goods_id = $this->input->post('goods_id');
        // // 商品详情
        if($this->goods_model->delete($goods_id)){
          echo json_encode(array('code'=>1,'msg'=>'删除成功','url'=>site_url('admin/goods/index')));
        }else{
          echo json_encode(array('code'=>0,'msg'=>'删除失败'.$goods_id));
        }
       
        
        
    }


}

?>