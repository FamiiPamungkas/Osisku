<?php 

defined('BASEPATH') or exit('No Direct Access Allowed !');

/**
* 
*/
class User extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->model('Kandidat');
		$this->load->model('Mlogin');
		$this->load->model('Kelas');
		$this->load->model('Model_user');
		# code...
	}

	function Login()
	{
		$this->load->view('header');
		$this->load->view('login');
		$this->load->view('footer');
		# code...
	}

	function Login_to()
	{                                                             
		$inuser = $this->input->post('username');
		$inpass = $this->input->post('password');

		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('password','Password','required');

		$this->form_validation->set_message('required','{field} tidak boleh kosong');

		if ($this->form_validation->run()==false) {

			$this->load->view('header');
			$this->load->view('Login');
			$this->load->view('footer');

		}else{
			                                                             
			if ($inuser == 'firstlogin' && $inpass == '13131313') {

				if ($this->Model_user->count_user()==0) {
					redirect('First_login');
				}else{
					$data['info'] = array(
						'title' => 'Admin Sudah Terdaftar !',
						'message' => 'Silahkan login dengan akun Admin yang telah terdaftar !'
					);

					$this->load->view('header');
					$this->load->view('Login',$data);
					$this->load->view('footer');
				}                                                             

			}else
			if ($this->Mlogin->cek_user($inuser,$inpass)==false) {
				                                                             
				$no_user = array('no_user'=>'Kombinasi username dan password salah ');

				$this->load->view('header');
				$this->load->view('Login',$no_user);
				$this->load->view('footer');
			}else{
				                                                             
				$level = $this->Model_user->get_user($inuser)->level;
				$nama = $this->Model_user->get_user($inuser)->nama;
				$foto = $this->Model_user->get_user($inuser)->foto;
				$data_session = array(
					'username' => $inuser,
					'nama' => $nama,
					'level'	=> $level,
					'foto'	=>$foto,
					'status' => 'logged'
				);

				$this->session->set_userdata($data_session);
				if ($level == 'a') {                 

					redirect(base_url('Admin'));
				}else{
					redirect(base_url('User'));
																																																																																																																																																																																																																																																																																																																																																																														                                                             
				}                                                             

			}                                                             

		}	
	}                                                             

	function Index()
	{                   
		$data['pemilihan'] = $this->db->get('pemilihan')->row();
		$this->load->view('header');
		$this->load->view('User/Dashboard_user',$data);
		$this->load->view('footer');
	}                                                             

	function Logout()
	{                                                             
		session_destroy();
		redirect(base_url());
		# code...
	}                                                             

	function profile_user()
	{
		$id = $this->input->post('id');
		$data['user'] = $this->Model_user->get_user($id);
		$data['kelas'] = $this->Model_user->cek_kelas($id);
		$this->load->view('admin/profile_user', $data);
	}

	function lihat_kandidat()
	{
		$data['kandidat'] = $this->Kandidat->get_kandidat();
		$data['calon'] = $this->Kandidat->get_data_calon();
		$data['kelas'] = $this->Kelas->get_kelas_siswa();
		$data['visi_misi'] = $this->Kandidat->get_visi_misi();
		$data['visi'] = $this->db->get('visi_misi')->result_array();
		$this->load->view('user/kandidat_carousel', $data);
		// 'string';

	}

	function voting_page()
	{
		// $data['voting'] = $this->
		$data['kandidat'] = $this->Kandidat->get_kandidat();
		$data['calon'] = $this->Kandidat->get_data_calon();
		$data['visi'] = $this->db->get('visi_misi')->result_array();
		$this->load->view('user/voting_page',$data);
		# code...
	}

	function vote()
	{
		$data = array(
			'id_voting' => null,
			'no_kandidat' => $this->input->post('id'),
			'username' => $this->input->post('username'),
			'waktu' => null,
		);

		$data_s = array('status'=>'s');
		$data_k = array('no_kandidat'=>$this->input->post('id'));

		$this->db->trans_start();

		$this->db->insert('voting',$data);
		
		$this->db->where('username',$this->input->post('username'));
		$this->db->update('user',$data_s);

		$jml = $this->db->get_where('voting',$data_k)->num_rows();
		$this->db->where('id_kandidat',$this->input->post('id'));
		$this->db->update('kandidat',array('jumlah'=>$jml));

		$this->db->trans_complete();

		$this->load->view('user/thanks');
		# code...
	}


	


}














 ?>