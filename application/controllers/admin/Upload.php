<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

#权限控制器
class Upload extends CI_Controller{

    public function index(){
        $this->load->view('file');
    }
    public function image(){
        $config['upload_path']      = './uploads/original/';
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
            $image_height= $data['image_height'];
            $image_width= $data['image_width'];
           // $this->thumb_img($data,'./uploads/original/','./uploads/',1200);
            $this->thumb_img($data);

            $file=array(
                'file_name'=>$data['file_name'],
                'file_type'=>$data['file_type'],
                'file_path'=>base_url('uploads')."/"
            );
            echo json_encode(array('code'=>1,'msg'=>'图片上传成功','data'=>$file));
            //$this->load->view('upload_success', $data);
        }

    }
    private function thumb_img($data){
        //正常大小
        $min = 1200;
        $image_height= $data['image_height'];
        $image_width= $data['image_width'];
        $config['height'] =  $image_height;
        $config['width'] = $image_width;
        if($image_height>$image_width && $image_height>$min){
            $config['height'] = $min;
            $config['width'] = intval($image_width*$min/$image_height);
        }else if($image_height<$image_width && $image_width>$min){
            $config['width'] = $min;
            $config['widheightth'] = intval($image_height*$min/$image_width);
        }
        $config['image_library'] = 'gd2';
        $config['source_image'] = './uploads/original/' . $data['file_name'];
        $config['thumb_marker'] = '';
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['new_image'] ='uploads/';
        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
        //小图
        $min= 300;
        $config['height'] =  $image_height;
        $config['width'] = $image_width;
        if($image_height>$image_width && $image_height>$min){
            $config['height'] = $min;
            $config['width'] = intval($image_width*$min/$image_height);
        }else if($image_height<$image_width && $image_width>$min){
            $config['width'] = $min;
            $config['widheightth'] = intval($image_height*$min/$image_width);
        }
        $config['source_image'] = './uploads/' . $data['file_name'];
        $config['new_image'] ='./uploads/thumb/';
        $this->image_lib->initialize( $config);
        $this->image_lib->resize();
    }

}