<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

#前台父控制器
class Home_Controller extends CI_Controller{
	protected $layout = 'layout/main.php';
	public function __construct(){
		parent::__construct();
		$this->load->switch_themes_on();
	}

	protected function render($file, $viewData = array(), $role='')
	{
		//$data['menus'] =$this->adminmenu->getmenu($role);
		//$array=explode('/', $role);
		//$data['group']= strpos($array[1],'_')?strstr($array[1],'_',true):$array[1];
		$data['content'] = $this->load->view($file, $viewData, TRUE);
		//$data['layout'] = $layoutData;
		$this->load->view($this->layout, $data);
		
		$viewData = array();
	}
	protected function arraySort($array,$keys,$sort='asc') {
		$newArr = $valArr = array();
		foreach ($array as $key=>$value) {
			$valArr[$key] = $value[$keys];
		}
		($sort == 'asc') ?  asort($valArr) : arsort($valArr);
		reset($valArr);
		foreach($valArr as $key=>$value) {
			$newArr[$key] = $array[$key];
		}
		return $newArr;
	}

}

#后台父控制器
class Admin_Controller extends CI_Controller{
	protected $layout = 'layout/main.php';
    private $js_files = array();
	private $css_files = array();
		
	public function __construct(){
		parent::__construct();
		$this->load->switch_themes_off();
		$this->load->library('adminmenu');
		#权限验证
		if (! $this->session->userdata('admin')){
			redirect('admin/privilege/login');
		}
		
	}

	public function add_js()
	{
		//添加js文件
	}
	public function add_css(){
		//添加css文件
	}

	public function role() {
		$ci= &get_instance();//ci控制器超级对象，就是把所有执行的方法打印出来
		$directory = substr($ci->router->fetch_directory(),0,-1); //分组目录
		$controller = $ci->router->fetch_class();   //当前控制器
		$function = $ci->router->fetch_method();    // 当前使用方法

		return  $directory."/".$controller."/".$function;
	}

	protected function render($file, $viewData = array(), $role='')
	{
		$data['menus'] =$this->adminmenu->getmenu($role);
		$array=explode('/', $role);
		$data['group']= strpos($array[1],'_')?strstr($array[1],'_',true):$array[1];
		$data['content'] = $this->load->view($file, $viewData, TRUE);
		//$data['layout'] = $layoutData;
		$this->load->view($this->layout, $data);
		
		$viewData = array();
	}


}