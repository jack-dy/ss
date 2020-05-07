<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_cache{
    private  $ci;
    public function __construct(){
        $this->ci =& get_instance();
        $this->ci->load->driver('cache',array('adapter' => 'file'));
    }
    
    public function save($id,$data,$time=0){
        
        
        if($time==0){
            $time=7200;
        }
       $this->ci->cache->save($id,$data,$time); 
       return true;
    }
    
    public function get($id){
        if ( ! $value =  $this->ci->cache->get($id))
        {
            return null;
        }else{
            return $value;
        }        
    }
    public function delete($id){
        $this->ci->cache->delete($id);
    }
    
}
