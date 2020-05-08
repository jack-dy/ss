<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

#权限控制器
class Upload extends CI_Controller{

    public function index(){
        $this->load->view('file');
    }
    public function image(){
        $config['upload_path']      = './uploads/';
        $config['allowed_types']    = 'gif|jpg|png';
        $config['file_name']= date('YmdHis').rand(10,99);
        $config['max_size']     = 10240;
        $config['max_width']        = 1024*20;
        $config['max_height']       = 768*20;

        $this->load->library('upload', $config);
        $files = $_FILES;
        $key =array_keys($files);

        if ( ! $this->upload->do_upload($key[0]))
        {
            $error = array('error' => $this->upload->display_errors());
            echo json_encode(array('code'=>0, 'msg'=>'上传失败'.$error));
            //print_r($error);
            //$this->load->view('upload_form', $error);
        }
        else
        {
            $data =  $this->upload->data();
            $file=array(
                'file_name'=>$data['file_name'],
                'file_type'=>$data['file_type'],
                'file_path'=>base_url('uploads')."/"
            );
            echo json_encode(array('code'=>1,'msg'=>'图片上传成功','data'=>$file));
            //$this->load->view('upload_success', $data);
        }

    }
}