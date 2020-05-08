<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *  admin 模型，管理后台管理员
 */

class Rate_model extends CI_Model{

    public function __construct() {
		parent::__construct();
		$this->load->library('my_cache');
	}
    public function getRate(){
        if(!$this->my_cache->get("rate")){
            //return array();
            $this->load->library('conversion');
            $conversion = $this->conversion->rate();
            if($conversion){
                $rate=array(
                    array('name'=>'USD','sign'=>'$','rate'=>1.00)
                );
                foreach($conversion['result'][0] as $k=>$v){
                    if($v['code']=='EURUSD'){
                        $num= round(1/floatval($v['closePri']),2);
                        $rate[]=array('name'=>'EUR','sign'=>'€','rate'=>$num);
                    }
                    if($v['code']=='USDJPY'){
                        $num= round($v['closePri'],2);
                        $rate[]=array('name'=>'JPY','sign'=>'￥','rate'=>$num);
                    }
                    if($v['code']=='USDHKD'){
                        $num= round($v['closePri'],2);
                        $rate[]=array('name'=>'HKD','sign'=>'$','rate'=>$num);
                    }
                }
                $this->my_cache->save("rate",  $rate,24*60*60);
                return $rate;
            }
            
        }
        return $this->my_cache->get("rate");
    }
}