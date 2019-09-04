<?php 

/**
* 
*/
class First_login extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');

	}

	function index()
	{
		$this->load->view('firstlogin');
		# code...
	}

	function input_admin()
	{
		$posisi = ($this->input->post('posisi')=='g')? 'g':'s';
		$pass = md5($this->input->post('password'));
		$this->form_validation->set_rules('username','Nomor Induk','required');
		$this->form_validation->set_rules('password','Password','required');
		$this->form_validation->set_rules('confirm','Konfirmasi Password','matches[password]');
		$this->form_validation->set_rules('nama','Nama Lengkap','required');
		$this->form_validation->set_rules('tmptlahir','Tempat Lahir','required');
		$this->form_validation->set_rules('tgllahir','Tanggal Lahir','required');
		// $this->form_validation->set_rules('foto','Foto','required');

		$this->form_validation->set_message('required','{field} harus diisi terlebih dahulu !');
		$this->form_validation->set_message('matches','{field} harus sama dengan Password');

		if ($this->form_validation->run()==false) {
			$this->load->view('firstlogin');
			# code...
		}else if (empty($_FILES['foto']['name'])) {
			# code...
			$data['error'] = 'Tidak ada foto !';
			$this->load->view('firstlogin',$data);

		}else{
			$extension = pathinfo($_FILES['foto']['name'],PATHINFO_EXTENSION);
			$config['upload_path'] = 'public/img/profile/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']     = '5000';
			$config['file_name'] = $this->input->post('username');
			
			$this->load->library('upload',$config);
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('foto')) {
				$data['error'] = 'Gagal memuat gambar !';
				$this->load->view('firstlogin',$data);

			}else{

			$data = array(
				'username' => $this->input->post('username'),
				'password' => $pass,
				'nama' => $this->input->post('nama'),
				'tempat_lahir' => $this->input->post('tmptlahir'),
				'foto' => $config['upload_path'].$config['file_name'].'.'.$extension,
				'tgl_lahir' => $this->input->post('tgllahir'),
				'level' => 'a',
				'posisi' => $posisi,
				'status' => 'b'
			);

			if ($this->db->insert('user',$data)) {
				$data['info'] = array(
					'title' => 'Pendaftaran Admin Sukses !',
					'message'	=> 'Silahkan login dengan akun yang telah didaftarkan.'

				);
				// $data['info'] = 'Registrasi admin berhasil, Silahkan Login sebagai admin !';
				$this->load->view('header');
				$this->load->view('Login',$data);
				$this->load->view('footer');

			}else{
				$data['error'] = 'Register gagal, coba lagi !';
				$this->load->view('firstlogin',$data);
			}
			}

		}
	}











}



 ?>