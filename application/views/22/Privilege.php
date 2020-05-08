<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

#权限控制器
class Privilege extends CI_Controller{
    public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		 $this->load->model('admin/admin_model');
    }
    public function login(){
        if(!IS_AJAX){
            return $this->load->view('login.html'); 
        }
        #设置验证规则
        $this->form_validation->set_rules('user[user]','用户名','required');
        $this->form_validation->set_rules('user[password]','密码','required');
        if ($this->form_validation->run() == false){
            echo json_encode(array('msg'=>'账号密码不为空'));
        }else{
            $user = $this->input->post('user[user]',true);
            $password = $this->input->post('user[password]',true);
            if ($this->admin_model->get_admin($user,$password)){
                 $this->session->set_userdata('admin','1');
                //echo json_encode(array('msg'=>'22'));
                echo json_encode(array('code'=>1, 'url'=>site_url('admin/main/index'),'msg'=>'登陆成功'));
            }else{
                echo json_encode(array('msg'=>'用户名和密码错误，请重新填写'));
            }
        }	
    }

    public function logout(){
        $this->session->unset_userdata('admin');
		$this->session->sess_destroy();
		redirect('admin/privilege/login');
    }
    
}

?>