<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *  admin 模型，管理后台管理员
 */

class Email_model extends CI_Model{

    public function sendEmail($init){
        
      $this->config->load('email', TRUE);
      $config_email = $this->config->item('email');
      $this->load->library('email'); 
      $this->email->initialize($config_email); 
      $this->email->from($config_email['smtp_user']); 
      $this->email->to($init['cart_option']['cart']['email']); 
      $this->email->subject("order"); 
      $this->email->message($this->body($init)); 
      $this->email->send(); 
    }

    private function body($init){
        $list =$init['list'];
      $calculation =$init['calculation'];
      $sel_rate = $init['sel_rate'];
        $cart_option = $init['cart_option'];
        $country=$init['country'];

        $body='<style>*{box-sizing: border-box;}.container{width: 100%;}.row{margin-right: -15px; margin-left: -15px;}.btn-group-vertical>.btn-group:after, .btn-group-vertical>.btn-group:before, .btn-toolbar:after, .btn-toolbar:before, .clearfix:after, .clearfix:before, .container-fluid:after, .container-fluid:before, .container:after, .container:before, .dl-horizontal dd:after, .dl-horizontal dd:before, .form-horizontal .form-group:after, .form-horizontal .form-group:before, .modal-footer:after, .modal-footer:before, .modal-header:after, .modal-header:before, .nav:after, .nav:before, .navbar-collapse:after, .navbar-collapse:before, .navbar-header:after, .navbar-header:before, .navbar:after, .navbar:before, .pager:after, .pager:before, .panel-body:after, .panel-body:before, .row:after, .row:before{display: table; content: " ";}.btn-group-vertical>.btn-group:after, .btn-group-vertical>.btn-group:before, .btn-toolbar:after, .btn-toolbar:before, .clearfix:after, .clearfix:before, .container-fluid:after, .container-fluid:before, .container:after, .container:before, .dl-horizontal dd:after, .dl-horizontal dd:before, .form-horizontal .form-group:after, .form-horizontal .form-group:before, .modal-footer:after, .modal-footer:before, .modal-header:after, .modal-header:before, .nav:after, .nav:before, .navbar-collapse:after, .navbar-collapse:before, .navbar-header:after, .navbar-header:before, .navbar:after, .navbar:before, .pager:after, .pager:before, .panel-body:after, .panel-body:before, .row:after, .row:before{display: table; content: " ";}.col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-xs-1, .col-xs-10, .col-xs-11, .col-xs-12, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9{position: relative; min-height: 1px; padding-right: 15px; padding-left: 15px; float: left;}.col-xs-4{width: 16.66666667%;} .col-xs-8{width: 66.66666667%;} .col-xs-3{width: 25%;}.col-xs-9{width: 75%;}@media (min-width: 768px){.col-sm-10{width: 83.33333333%;} .col-sm-2{width: 16.66666667%;}}@media (min-width: 992px){.col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9{float: left;} .col-md-offset-2{margin-left: 16.66666667%;} .col-md-offset-3{margin-left: 25%;} .col-md-8{width: 66.66666667%;} .col-md-6{width: 50%;}}@media (min-width: 1200px){.col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9{float: left;} .col-lg-12{width: 100%;}}.text-right{text-align: right;} .text-left{text-align: left;}.form-group{margin-bottom: 15px;}ul{}li{list-style: none;}.p15{padding: 15px;}.ml10{margin-left: 10px;}.box_t{width: 100%; height: auto; overflow: hidden; margin: 0 auto;}.box_t h2{font-size: 24px; color: #000000; line-height: 34px; text-align: center;}.border-top{border-top: 1px solid #ccc;}.cart_box{}.cart_lists{padding: 20px 0; border-bottom: 1px solid #ccc; margin: 0;}.cart_lists li{display: flex; align-items: center; justify-content: center; vertical-align: center; flex-wrap: wrap; align-content: center; flex: auto;}.item{display: flex; height: 100px; flex: 0 0 20%;}.pc_pic{max-height: 80%; max-width: 80%;}</style>';
        $body .='<div class=" container p15">
        <div class="row">
            <div class="col-lg-12">
                <div class="box_t">
                    <h2>Order Form</h2>
                </div>
            </div>
            <div class="col-md-8 col-md-offset-2 border-top">
            </div>
            <div class="cart_box">
            <div class="col-md-8 col-md-offset-2">
                <ul class="cart_lists">';
                foreach($list as $item){
            $body.='<li class="">
                        <div class="item pc_pic_box">
                            <img class="pc_pic" src="'.base_url('uploads/thumb/').$item['image'][0].'" alt="">
                        </div>
                        <div class="item">
                            <p class="pd_name">'.$item['goods_name'].'</p>
                        </div>
                        <div class="item">
                            <p class="pd_type">'.$item['category_name'].'</p>
                        </div>
                        <div class="item">
                            <h4 class="pd_price text-right">'.$sel_rate['name']." ".sprintf("%01.2f",$sel_rate['rate']*$item['goods_price']).'</h4>
                        </div>
                    </li>';
                }
                    
                $body.='</ul>
                <div class="cart_totle">
                    <div class="row p15">
                        <div class="col-sm-10 col-xs-8 text-right">Subototal:</div>
                        <div class="col-sm-2 col-xs-4 text-left">'.$sel_rate['name'].'<span class="ml10 subototal">'.$calculation['subototal'].'</span> </div>
                        <div class="col-sm-10 col-xs-8 text-right">Postage:</div>
                        <div class="col-sm-2 col-xs-4 text-left">'.$sel_rate['name'].'<span class="ml10 postage">'.$calculation['postage'].'</div>
                        <div class="col-sm-10 col-xs-8 text-right">Total amount:</div>
                        <div class="col-sm-2 col-xs-4 text-left">'.$sel_rate['name'].'<span class="ml10 amount">'.$calculation['amount'].'</div>
                    </div>
                </div>
                
                
            </div>
            <div class="col-md-6 col-md-offset-3">
                <div class="box_t">
                        <h2>Contact information</h2>
                    </div>
                    <div class="order_form">
                        <div class="form-group row">
                            <div class="col-xs-3 text-right">Country:</div>
                            <div class="col-xs-9">'.$country[$cart_option['cart']['country']]['cy_name_en'].'</div>
                        </div>
                        <div class="form-group row">
                            <div class="col-xs-3 text-right">Name:</div>
                            <div class="col-xs-9">'.$cart_option['cart']['name'].'</div>
                        </div>
                        <div class="form-group row">
                            <div class="col-xs-3 text-right">Address:</div>
                            <div class="col-xs-9">'.$cart_option['cart']['address'].'</div>
                        </div>
                        <div class="form-group row">
                            <div class="col-xs-3 text-right">Email:</div>
                            <div class="col-xs-9">'.$cart_option['cart']['email'].'</div>
                        </div>
                        <div class="form-group row">
                            <div class="col-xs-3 text-right">Phone:</div>
                            <div class="col-xs-9">'.$cart_option['cart']['phone'].'</div>
                        </div>
                        <div class="form-group row">
                            <div class="col-xs-3 text-right">Postal code:</div>
                            <div class="col-xs-9">'.$cart_option['cart']['postal'].'</div>
                        </div>
                        
                    </form>
                    </div>
            </div>
            </div>
           
            <?php endif;?>
        </div>
    </div>';
        return $body;
    }
}