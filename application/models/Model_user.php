<?php 
defined('BASEPATH') or exit('No DIrecct Access !');

/**
* 
*/
class Model_user extends CI_Model
{
	
	function __construct()
	{
		# code...
	}

	function get_user($user)
	{
		$username = array('username'=>$user);
		return $this->db->get_where('user',$username)->row();
		# code...
	}


	function jlm_siswa_perkelas($kls)
	{
		$kelas = array('id_kelas' =>$kls);
		$data = $this->db->get_where('siswa',$kelas);
		// $data = $this->db->count_all_results();
		return $data->num_rows();
	}

	function siswa_perkelas($kls)
	{
		$kelas = array('id_kelas' =>$kls);
		$this->db->select('nis');
		$data = $this->db->get_where('siswa',$kelas)->result_array();
		// return $data;
		$str = '';
		foreach ($data as $dat) {
			$str = $str.$dat['nis'].',';
		}
		$str = substr($str, 0,-1);

		return $str;
	}

	function list_user_where_in($where)
	{
		// $this->db->order_by('nama','ASC');
		$wa = explode(',', $where);
		$this->db->where_in('username', $wa);
		$data = $this->db->get('user')->result_array();
		return $data;
		# code...
	}

	function list_user_complex($per_page,$from)
	{
		// $this->db->order_by('nama','ASC');
		$data = $this->db->get('user', $per_page,$from)->result_array();
		return $data;
		# code...
	}

	function list_user()
	{
		$data = $this->db->get('user');
		return $data->result_array();
	}

	function list_id()
	{
		$this->db->select('username');
		$data = $this->db->get('user')->result_array();
		return $data;
		# code...
	}

	function count_user()
	{
		$data =  $this->db->get('user');
		return $data->num_rows();
		# code...
	}

	function cek_user_by_id($id)
	{
		$data = $this->db->get_where('user',array('username'=>$id))->num_rows();

		if ($data>0) {
			return true;
		}else{
			return false;
		}

		# code...
	}

	function cek_kelas($id)
	{
		
		$idk = $this->db->get_where('siswa', array('nis'=>$id))->row();
		if ($idk=='') {
			# code...
			return '';
		}else{

		$kelas = $this->db->get_where('kelas', array('id_kelas'=>$idk->id_kelas))->row();
		// $kelas = $kls->kelas;
		return $kelas;

		}

	}

	function jml_user()
	{
		$data = $this->db->get('user')->num_rows();
		return $data;
		# code...
	}

	function jml_voting()
	{
		$data = $this->db->get('voting')->num_rows();
		return $data;
		# code...
	}

	function cek_voting($user)
	{
		$data = array('username'=>$user);
		$query = $this->db->get_where('voting',$data)->num_rows();
		if ($query>0) {
			return true;
		}else{
			return false;
		}
		# code...
	}

	function cek_milih($id)
	{
		$data = array('username'=>$id);
		$query = $this->db->get_where('voting',$data)->num_rows();
		if ($query>0) {
					# code...
				return true;
			}else{
				return false;
			}		

		# code...
	}
}


 ?>