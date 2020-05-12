<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Card extends Admin_Controller{
    public function __construct(){
		parent::__construct();
    $this->load->model('card_model');
    $this->load->library('pagination');
    //$this->load->model('goods_model');
    }
    
    public function index(){

        $role=$this->role();
        $card_name = $this->input->get('card_name')?: '';
        $page = $this->input->get('page')?: 1;

        $type = $_SERVER['QUERY_STRING'] ;
        if(strpos($type,'&page')){
          $type = strstr ( $_SERVER['QUERY_STRING'] ,  '&page' ,  true );
        }
         $config['base_url'] = current_url()."?".$type;
         $config['total_rows'] = $this->card_model->counts($card_name);
        $config['per_page'] = 15;
        $config['cur_page'] = $page;
        $config['use_page_numbers'] = true;
        $this->pagination->initialize($config);
        $links = $this->pagination->create_links();

        $list = $this->card_model->getList($card_name,$page);
        return $this->render('card_list.php',compact('list', 'links'),$role);

        // $card_name = $this->input->get('card_name')?: '';
        // $page = $this->input->get('page')?: 1;
        // $list = $this->card_model->getList($card_name,$page);
        // return $this->render('card_list.php',compact('list'),$role);

    }

    /**
     * 添加卡片 
     *  */
    public function add(){
      if(!IS_AJAX){
        $role=$this->role();
        // 商品分类
        return $this->render('card_add.php',array(),$role);
      }
      $post = $this->input->post('card');
      if($this->card_model->add($post)){
        echo json_encode(array('code'=>1,'msg'=>'添加成功','url'=>site_url('admin/card/index')));
      }else{
        echo json_encode(array('code'=>0,'msg'=>'添加失败'));
      }
      //echo json_encode(array('code'=>0,'msg'=>'添加失败','post'=>$post));
    }

    //更改
    public function edit(){
      $card_id =$this->input->get('card_id')? :null;
      if(!IS_AJAX){
        $role=$this->role();
        // 商品分类
        $row = $this->card_model->get(compact('card_id') );
        return $this->render('card_edit.php',compact('row'),$role);
      }
        $post = $this->input->post('card');
      if($this->card_model->edit($post,compact('card_id'))){
        echo json_encode(array('code'=>1,'msg'=>'更改成功','url'=>site_url('admin/card/index')));
      }else{
        echo json_encode(array('code'=>0,'msg'=>'更改失败'));
      }
    }

    //删除
    public function delete(){
      $card_id = $this->input->post('card_id');
      $res = $this->card_model->remove($card_id);
      if($res===true){
        echo json_encode(array('code'=>1,'msg'=>'删除成功'));
      }else{
        echo json_encode(array('code'=>0,'msg'=>$res));
      }
    }


}