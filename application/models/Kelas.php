<?php 

defined('BASEPATH') or exit('NO Dirrect Access !!');

/**
* 
*/
class Kelas extends CI_Model
{
	
	function __construct()
	{
		# code...
	}

	function get_kelas($banyak,$offset)
	{
		$this->db->order_by('kelas','ASC');
		return $query = $this->db->get('kelas', $banyak, $offset)->result();

	}

	function jumlah_kelas()
	{
		return $this->db->get('kelas')->num_rows();
		# code...
	}

	function list_kelas()
	{
		$this->db->order_by('kelas','ASC');
		$query = $this->db->get('kelas');
		return $query->result_array();
		# code...
	}
	function cek_kelas($kelas)
	{
		$num = $this->db->get_where('kelas', array('kelas'=>$kelas))->num_rows();
		if ($num > 0) {
			return true;
		} else{
			return false;
		}
		# code...
	}

	function get_kelas_by_id($id)
	{
		$query = $this->db->get_where('kelas',array('id_kelas'=>$id))->row_array();
		return $query;
		# code...
	}

	function cek_kelas_user($id)
	{
		# code...
	}

	function get_kelas_siswa()
	{
		$this->db->select('*');
		$this->db->from('siswa');
		$this->db->join('kelas','kelas.id_kelas = siswa.id_kelas');
		$data  = $this->db->get()->result_array();
		return $data;
	}

}


 ?>