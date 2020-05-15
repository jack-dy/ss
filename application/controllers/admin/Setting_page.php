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
        $page_data= file_get_contents("php://input");


        if($this->page_model->update(compact('page_data'))){
            echo json_encode(array('code'=>1,'msg'=>'成功'));
        }else{
            echo json_encode(array('code'=>0,'msg'=>'失败'));
        }

        
    }
}
?>