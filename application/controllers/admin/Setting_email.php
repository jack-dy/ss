<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting_email extends Admin_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('email_model');
    }

    public function index(){
        if(!IS_AJAX){
            $role=$this->role();
            $row = $this->email_model->detail();
            return $this->render('setting/email.php',compact('row'),$role);
        }
        $post = $this->input->post('email');
        if($this->email_model->edit($post)){
            echo json_encode(array('code'=>1,'msg'=>'更改成功'));
          }else{
            echo json_encode(array('code'=>0,'msg'=>'更改失败'));
          }
    }
    public function aa(){
        $row = $this->email_model->detail();
        if(!empty($row['emails'])){
            $aa =explode("\n",$row['emails']);
            print_r($aa);
        }
        print_r($row);
    }
}
?>