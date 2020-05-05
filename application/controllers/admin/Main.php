<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends Admin_Controller{
    public function __construct(){
		parent::__construct();
		// $this->output->enable_profiler(true);
    }

    public function index(){
        $role=$this->role();
        $data=array();
        $this->render('index.php',$data,$role);

    }


}

?>