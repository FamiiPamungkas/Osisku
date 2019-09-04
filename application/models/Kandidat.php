<?php 

defined('BASEPATH') or exit('No Direct Access !!');

/**
 * 
 */
class Kandidat extends CI_Model
{
	
	function __construct()
	{
		# code...
	}

	function get_kandidat()
	{
		$data = $this->db->get('kandidat')->result_array();
		return $data;
	}


	function get_calon()
	{
		$data = $this->db->get('calon')->result_array();
		return $data;
		# code...
	}

	function get_visi_misi()
	{
		$this->db->select('*');
		$this->db->from('misi');
		$this->db->join('visi_misi', 'visi_misi.id_misi = misi.id_misi');
		$data = $this->db->get()->result_array();
		return $data;
		# code...
	}

	function cek_kandidat()
	{
		$data = $this->db->get('kandidat')->num_rows();
		return $data;
		# code...
	}

	function get_data_calon()
	{
		$this->db->select('*');
		$this->db->from('calon');
		$this->db->join('user', 'user.username = calon.nis');
		$data = $this->db->get()->result_array();
		return $data;
		# code...
	}

	function data_calon($ids)
	{
		$this->db->where_in('username',$ids);
		$data = $this->db->get('user')->result_array();
		return $data;
		# code...
	}

	function jml_calon()
	{
		$data = $this->db->get('calon')->num_rows();
		return $data;
		# code...
	}

	function get_tipe()
	{
		if ($this->db->get('kandidat')->num_rows()<>0) {
			$data = $this->db->get('kandidat')->result_array();
			foreach ($data as $dat) {
				$tipe = $dat['tipe'];
			}
			return $tipe;

		}else{

			return '';
		}
		# code...
	}

	function cek_calon_di_kandidat($id)
	{
		$data = array('nis'=>$id);
		$query = $this->db->get_where('calon',$data)->row();
		if ($query->nomor>0) {
			# code...
			return false;
		}
			return true;
		# code...
	}

	function get_waktu_pemilihan()
	{
		$data = $this->db->get('pemilihan')->row();
		return $data;
		# code...
	}

	function jml_voting_kandidat($no)
	{
		$data = array('no_kandidat'=>$no);
		$query = $this->db->get_where('voting',$data)->num_rows();
		return $query;
		# code...
	}

	// function FunctionName($value='')
	// {
		# code...
	// }
}














 ?>