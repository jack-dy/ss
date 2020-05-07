<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *  admin 模型，管理后台管理员
 */

class Admin_model extends CI_Model{

	const TBL_ADMIN = 'admin';


	public function get_admin($user,$password){
		$condition = array(
			'user' => $user,
			'password' => md5($password)
		);

		$query = $this->db->where($condition)->get(self::TBL_ADMIN);

		return $query->num_rows() > 0 ? true : false;
	}
}