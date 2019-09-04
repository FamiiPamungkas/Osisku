<?php 

defined('BASEPATH') or exit('No Direct Access !');

/**
* 
*/
class Mlogin extends CI_Model
{
	
	function __construct()
	{
		# code...
	}

	function Check($table,$where)
	{
		return $this->db->get_where($table,$where);

		# code...
	}


	function cek_user($user,$pass)
	{
		$password = md5($pass);
		$array = array('username'=>$user,'password'=>$password);
		$num =	$this->db->get_where('user',$array)->num_rows();
		if ($num==1) {
			return true;
		}else{
			return false;
		}
	}
}



















 ?>