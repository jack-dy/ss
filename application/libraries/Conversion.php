<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//换算
class Conversion {
    public $key = '';
    public function __construct(){
        //parent::__construct();
         $CI =& get_instance();
         $CI->config->load('conversion', TRUE);
        $this->key =  $CI->config->item('AppKey', 'conversion');
        // $this->key = $CI->config->item('wechat');
    }
    public function rate(){
        $url = "http://web.juhe.cn:8080/finance/exchange/frate";
        $params = array(
            "key" => $this->key,//APP Key
            "type" => "0",//两种格式(0或者1,默认为0)
        );
        $paramstring = http_build_query($params);
        $content = $this->juhecurl($url,$paramstring);
        $result = json_decode($content,true);
        if($result){
            return $result;
            // if($result['error_code']=='0'){

            //     print_r($result);
            // }else{
            //     echo $result['error_code'].":".$result['reason'];
            // }
        }else{
            return false;
            //echo "请求失败";
        }
            //return 1;
    }
    
    private function juhecurl($url,$params=false,$ispost=0){
        $httpInfo = array();
        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1 );
        curl_setopt( $ch, CURLOPT_USERAGENT , 'JuheData' );
        curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT , 60 );
        curl_setopt( $ch, CURLOPT_TIMEOUT , 60);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER , true );
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        if( $ispost )
        {
            curl_setopt( $ch , CURLOPT_POST , true );
            curl_setopt( $ch , CURLOPT_POSTFIELDS , $params );
            curl_setopt( $ch , CURLOPT_URL , $url );
        }
        else
        {
            if($params){
                curl_setopt( $ch , CURLOPT_URL , $url.'?'.$params );
            }else{
                curl_setopt( $ch , CURLOPT_URL , $url);
            }
        }
        $response = curl_exec( $ch );
        if ($response === FALSE) {
            //echo "cURL Error: " . curl_error($ch);
            return false;
        }
        $httpCode = curl_getinfo( $ch , CURLINFO_HTTP_CODE );
        $httpInfo = array_merge( $httpInfo , curl_getinfo( $ch ) );
        curl_close( $ch );
        return $response;
    }
}
?>