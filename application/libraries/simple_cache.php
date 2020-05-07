<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
  
class Simple_cache {  
  
    public $expire_after = 300;  
    public $cache_file   = BASEPATH.'cache/';  
  
    function Simple_cache($life_time = '')  
    {  
        if (!emptyempty($life_time))  
        {  
             $this->expire_after = $life_time;  
        }  
    }  
  
    function cache_item($key, $value)  
    {  
        if(!is_dir($this->cache_file))  
        {  
            $temp = explode('/',$this->cache_file);    
            $cur_dir = '';    
            for($i = 0; $i < count($temp); $i++)  
            {    
                $cur_dir .= $temp[$i].'/';    
                if (!is_dir($cur_dir))  
                {    
                    @mkdir($cur_dir,0755);    
                }    
            }    
        }  
  
        if(!emptyempty($value))  
        {  
            file_put_contents($this->cache_file.sha1($key).'.cache', serialize($value));   
        }  
    }  
      
    function is_cached($key)  
    {  
        if (file_exists($this->cache_file.sha1($key).'.cache'))
        {             
            if((filectime($this->cache_file.sha1($key).'.cache')+$this->expire_after) >= time())  
            {  
                return true;  
            }else{  
                delete_item($key);  
                return false;  
            }  
        } else {  
            return false;             
        }         
    }  
      
    function get_item($key)  
    {  
        $item = file_get_contents($this->cache_file.sha1($key).'.cache');  
        return unserialize($item);  
    }  
      
    function delete_item($key)  
    {  
        unlink($this->cache_file.sha1($key).'.cache');  
    }  
  
    function clear_all(){  
  
    }  
  
}  