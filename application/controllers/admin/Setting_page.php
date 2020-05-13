<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting_page extends Admin_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('page_model');
    }

    public function index(){
        if(!IS_AJAX){
            $role=$this->role();
            $data = $this->page_model->detail();
            $jsonData = $data['page_data'];
        return $this->render('setting/page.php',compact('jsonData'),$role);
        }
        $post =implode('',$this->input->post());
        $page_data=$post;
        //$post = json_decode(implode('',$this->input->post()),true);
        if($this->page_model->update(compact('page_data'))){
            echo json_encode(array('code'=>1,'msg'=>'成功'));
        }else{
            echo json_encode(array('code'=>0,'msg'=>'失败'));
        }

        //$aa = json_decode($post, true);
        //echo json_encode(array('code'=>0,'msg'=>'添加成功'));
        //echo json_encode(array('code'=>0,'msg'=>'成功','data'=>$post));
        // if (!$model->add(json_decode($post, true))) {
        //     return $this->renderError('添加失败');
        // }
        // return $this->renderSuccess('添加成功', url('wxapp.page/index'));
        
    }
}
?>