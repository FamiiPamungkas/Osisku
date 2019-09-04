<?php 
defined('BASEPATH') or exit('No Direct Access');

/**
* 
*/
class Admin extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->load->model('Model_user');
		$this->load->model('Kelas');
		$this->load->model('Kandidat');
	}

	function index()
	{
		// $this->load->view('header');
		$this->load->view('dashboard');
	}


	function delete_user()
	{
		// $id = $this->input->post('id');
		$kelas = $this->input->post('kelas');
		$link = $this->input->post('link');
		$id = $this->input->post('id');
		$id = substr($id,1);

        $data = array('nis'=>$id);
        if ($this->db->get_where('calon',$data)->num_rows()>0) {
            echo "<script>alert('User sudah terdaftar sebagai calon !')</script>";
            $this->lihat_user();
        }elseif ($this->Model_user->cek_milih($id)==true) {
        	echo "<script>alert('Tidak bisa hapus user yang sudah Voting !')</script>";
            $this->lihat_user();
			        
        }else{

            if ($this->Model_user->cek_kelas($id)=='') {

               if ($kelas=='') {
                    # code...
                    $this->db->query("DELETE FROM user WHERE username ='".$id."'");
                    $this->lihat_user_filter();
                }else{

                    $this->db->query("DELETE FROM user WHERE username ='".$id."'");
                    $this->lihat_user_filter($kelas);
                }

            }else{

                if ($kelas=='') {
                    # code...
                    $this->db->query("DELETE FROM siswa WHERE nis ='".$id."'");
                    $this->db->query("DELETE FROM user WHERE username ='".$id."'");
                    $this->lihat_user_filter();
                }else{

                    $this->db->query("DELETE FROM siswa WHERE nis ='".$id."'");
                    $this->db->query("DELETE FROM user WHERE username ='".$id."'");
                    $this->lihat_user_filter($kelas);
                }
            
            }

        }

		// echo "DELETE FROM user WHERE username ='".$id."'";

	}

	function Import_user($error='',$data_show='')
	{
		// $data['a'] = $this->Model_user->list_user();
		// print_r($data);
		// $this->load->view('admin/overview');
		$data['kelas'] = $this->Kelas->list_kelas();
		if ($error<>'') {
			$data['error'] = $error;
		}
		if ($data_show<>'') {
			$data['data_show'] = $data_show;
		}
		$this->load->view('admin/import_user',$data);
	}

    function reset_pemilihan()
    {
        $this->db->empty_table('pemilihan');
        $this->db->empty_table('voting');
        $this->db->update('kandidat',array('jumlah'=>0));
        $this->db->update('user',array('status'=>'b'));
        $this->Overview();
    }

    function set_tgl_pemilihan()
    {
        $this->form_validation->set_rules('tgl_mulai', 'Tanggal Mulai', 'required');
        $this->form_validation->set_rules('tgl_akhir', 'Tanggal Berakhir', 'required');

        if ($this->Kandidat->cek_kandidat()<2) {
            echo '<script>alert("Jumlah kandidat tidak memenuhi syarat pemilihan !")</script>';            
            $this->Overview();

        }else{

            if ($this->form_validation->run()==false) {
                echo '<script>alert("Isi tanggal mulai dan akhir pemilihan !")</script>';            
                $this->Overview();
            }else{
                $tgl_mulai = new DateTime($this->input->post('tgl_mulai')." 00:00:00");
                $tgl_akhir = new DateTime($this->input->post('tgl_akhir')." 23:59:59");
                if ($tgl_akhir<$tgl_mulai) {

                echo '<script>alert("Tanggal berakhir kurang dari tanggal dimulai !")</script>';            
                
                }else{

                $data = array(
                    'id_pemilihan' => null,
                    'tgl_mulai' => $tgl_mulai->format('Y-m-d H:i:s'),
                    'tgl_akhir' => $tgl_akhir->format('Y-m-d H:i:s'),
                );
                $this->db->insert('pemilihan', $data);
                }

            $this->Overview();
            
            }
        }               
    }

    function voting_result()
    {
    	$data['kandidat'] = $this->Kandidat->get_kandidat();
        $data['calon'] = $this->Kandidat->get_data_calon();
        $data['jml_voting'] = $this->Model_user->jml_voting();
        $data['jml_user'] = $this->Model_user->jml_user();
    	$this->load->view('admin/voting_result',$data);
    	# code...
    }

    function jml_memilih()
    {
    	$data['jml_voting'] = $this->Model_user->jml_voting();
    	echo $data['jml_voting'];
    	// echo "string";
    	# code...
    }

	function Overview($tgl=null)
	{
        $data['pemilihan'] = $this->Kandidat->get_waktu_pemilihan();
        $data['kandidat'] = $this->Kandidat->get_kandidat();
        $data['calon'] = $this->Kandidat->get_data_calon();
        $data['jml_kandidat'] = $this->Kandidat->cek_kandidat();
        $data['jml_user'] = $this->Model_user->jml_user();
        $data['jml_voting'] = $this->Model_user->jml_voting();
		$this->load->view('admin/overview',$data);
	}

	function input_user()
	{
		$data['kelas'] = $this->Kelas->list_kelas();
		$this->load->view('admin/input_user',$data);
	}

	function lihat_user_filter($filter='')
	{
		# code...
		if ($filter=='') {
			$input = $this->input->post('kelas');
			# code...
		}else{
			$input = $filter;
			
		}

		$where = $this->Model_user->siswa_perkelas($input);


		$data['siswa'] = $this->db->get('siswa')->result_array();
		$data['kelas'] = $this->Kelas->list_kelas();

		if ($input=='') {
			$this->Lihat_user();
		}else if ($input=='guru') {
			$data['id_kelas'] = 'guru';
			$data['user'] = $this->db->get_where('user',array('posisi'=>'g'))->result_array();
			$this->load->view('admin/lihat_user',$data);
		}else{
			$data['id_kelas'] = $input;
			$data['user'] = $this->Model_user->list_user_where_in($where);
			// $data['num_rows'] = $this->Model_user->list_user_where_in($where)->num_rows();
			$this->load->view('admin/lihat_user',$data);	
		}
	}

	function Lihat_user()
	{
		$data['siswa'] = $this->db->get('siswa')->result_array();
		$data['kelas'] = $this->Kelas->list_kelas();

		$config['base_url'] = base_url('Admin/Lihat_user');
		$config['total_rows'] = $this->db->get('user')->num_rows();
		$config['per_page'] = 15;
		$from = $this->uri->segment(3);
		$this->pagination->initialize($config);

		$data['user'] = $this->Model_user->list_user_complex($config['per_page'],$from);
		// $data['num_rows'] = $this->Model_user->list_user_complex($config['per_page'],$from)->num_rows();
		$this->load->view('admin/lihat_user',$data);
	}

	function Parameter_kelas()
	{
		$this->load->database();
		$jml_kelas= $this->Kelas->jumlah_kelas();
		$config['base_url']	= base_url('admin/parameter_kelas');
		$config['total_rows'] = $jml_kelas;
		$config['per_page']	=	5;
		$from	= $this->uri->segment(3);
		$this->pagination->initialize($config);

		$data['kelas'] = $this->Kelas->get_kelas($config['per_page'],$from);
		// $data['kelas'] = $this->db->get('kelas')->result_array();
		$this->load->view('admin/parameter_kelas',$data);
		# code...
	}

	function Input_kelas()
	{
		$kelas = $this->input->post('kelas');
		$data = array(
			'id_kelas'	=> null,
			'kelas' 	=> $kelas
		);
		$this->form_validation->set_rules('kelas','Kelas', 'required|max_length[6]');

		$this->form_validation->set_message('required','Mohon isi {field} terlebih dahulu');
		// $this->form_validation->set_message('max_length','{field} maksimal');
		// echo "string";
		if ($this->form_validation->run() == false) {

			// echo validation_errors();
			$errors = validation_errors();
			echo json_encode(['error'=>$errors]);
			# code...
		}else{


			if ($this->Kelas->cek_kelas($kelas) == true) {
				$errors = 'Kelas Sudah Terdaftar';
				echo json_encode(['error'=>$errors]);
				# code...
			}else{
				echo json_encode(['success'=>'Record added successfully.']);
				$this->db->insert('kelas',$data);
				
			}
			
		}

		// echo json_encode($data);
		// echo $data;
		# code...
	}

	function Hapus_kelas()
	{
		$data = array(
			'id_kelas' => $this->input->post('id')
		);

        if ($this->db->get_where('siswa',$data)->num_rows()>0) {
            echo "<script>alert('Kelas sudah memiliki data !')</script>";
            $this->parameter_kelas();
        }else{
            $this->db->delete('kelas',$data);
            $this->parameter_kelas();

        }

		# code...
	}

	function import_post()
	{
		$this->form_validation->set_rules('kelas','Kelas','required');
		$this->form_validation->set_message('required', 'Pilih {field} terlebih dahulu !');

		if ($this->form_validation->run()==false) {
			$this->import_user();
		}elseif (empty($_FILES['csv']['name'])) {
			$this->import_user('Upload file csv terlebih dahulu !');
			
		}else{
			$temp_name = date("Ymdhis");
			$extension = pathinfo($_FILES['csv']['name'],PATHINFO_EXTENSION);
			$config['upload_path'] = 'public/file/temp/';
			$config['allowed_types'] = 'csv';
			$config['max_size']     = '1000';
			$config['file_name'] = $temp_name;

			$this->load->library('upload',$config);
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('csv')) {
				$this->import_user('Gagal memuat File !');
			}else{
				$path = base_url('public/file/temp/') . $temp_name .'.'. $extension;
				$file = fopen($path,'r');
				fgetcsv($file);
				$array_user = array();
				while (($data = fgetcsv($file))== true) {
					foreach ($data as $row) {
						$col = explode(';',$row);
						$date = explode('/', $col[4]);
						$pos = ($this->input->post('kelas')=='guru')? 'g':'s';
						if ($this->Model_user->cek_user_by_id($col[0])==true || ($col[0]=='')) {

						}else{
							$data_user = array(
								'username' => $col[0],
								'password' => md5($col[2]),
								'nama' => $col[1],
								'tempat_lahir' => $col[3],
								'tgl_lahir' => $date[2].'-'.$date[1].'-'.$date[0],
								'foto' => '',
								'level' => 'u',
								'posisi' => $pos,
								'status' => 'b',
							);
							$data_siswa = array(
								'nis' =>$col[0],
								'id_kelas' => $this->input->post('kelas')
							);

							$this->db->insert('user',$data_user);
							if ($pos<>'g') {
								$this->db->insert('siswa',$data_siswa);		
							};

							$data_show = array(
								'username' => $col[0],
								'nama' => $col[1],
								'tempat_lahir' => $col[3],
								'tgl_lahir' => $date[2].'-'.$date[1].'-'.$date[0],
								'posisi' => $this->input->post('kelas')
							);
							array_push($array_user,$data_show);
							// print_r($array_user);
						}
					}
				}
				$this->import_user(null,$array_user);

			}

		}

	
		
	}
	function Input_user_import()
	{
		// echo "string";
		// $this->load->view('login');
		# code...

		$this->form_validation->set_rules('kelas', 'Kelas', 'required'); 
		// $this->form_validation->set_rules('csv', 'File', 'required'); 
		$this->form_validation->set_message('required', 'Pilih {field} terlebih dahulu !');

		if ($this->form_validation->run()== false) {
			# code...
			$data['kelas'] = $this->Kelas->list_kelas();
			$this->load->view('admin/import_user',$data);
			// $this->load->view('admin/Import_user');
		}else if (empty($_FILES['file']['name'])) {
			# code...
			$data['kelas'] = $this->Kelas->list_kelas();
			$data['error'] = 'Upload file terlebih dahulu !'; 
			$this->load->view('admin/import_user',$data);
		}else{
			$temp_name = date("Ymdhis");
			$extension = pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);
			$config['upload_path'] = 'public/file/temp/';
			$config['allowed_types'] = 'csv';
			$config['max_size']     = '1000';
			$config['file_name'] = $temp_name;

			$this->load->library('upload',$config);
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('file')) {
				$data['kelas'] = $this->Kelas->list_kelas();
				$data['error'] = 'Gagal memuat file !';
				$this->load->view('admin/import_user',$data);

			}else{
				// $path = base_url('public/file/temp/');
				$path = base_url('public/file/temp/') . $temp_name .'.'. $extension;
				// $file = fopen($path,'r');
				// fgetcsv($file);
				// $data['user'] = fgetcsv($file);

				$data['id_user'] = $this->Model_user->list_id();
				$data['kelas'] = $this->Kelas->list_kelas();
				$data['data_import'] = $path;
				if ($this->input->post('kelas')== 'guru') {
					# code...
					$data['posisi'] = array(
						'id_kelas' => 'guru',
						'kelas' => 'Guru'
					);

				}else{
					$data['posisi'] = $this->Kelas->get_kelas_by_id($this->input->post('kelas'));
				}
				// $data['posisi'] = ;

				$this->load->view('admin/import_user',$data);

				// $this->load->view('admin/overview');


			}

		}
	}

	function clear_temp()
	{
		$this->load->helper('file');
		delete_files('./public/file/temp/');
		# code...
	}
	function save_import()
	{

		$data_user = array(
			'username' => $this->input->post('username'),
			'password' => md5($this->input->post('password')),
			'nama' => $this->input->post('nama'),
			'tempat_lahir' => $this->input->post('tempat_lahir'),
			'tgl_lahir' => $this->input->post('tgl_lahir'),
			'foto' => $this->input->post('foto'),
			'level' => $this->input->post('level'),
			'posisi' => $this->input->post('posisi'),
			'status' => $this->input->post('status')
		);

		$data_siswa = array(
			'nis' => $this->input->post('username'),
			'id_kelas' => $this->input->post('id_kelas')
		);

		if ($this->input->post('posisi')=='s') {
			# code...
			$this->db->insert('user',$data_user);
			$this->db->insert('siswa',$data_siswa);
		}else{
			$this->db->insert('user',$data_user);

		}
	}

	function cek_user($str)
	{
		$id = $str;

		if ($this->Model_user->cek_user_by_id($id)== false) {
			return true;
		}else{
			return false;
		}
	}

	function simpan_user()
	{

		if ($this->input->post('mode')=='edit') {
			$this->form_validation->set_rules('username', 'Username', 'required');
		}else{
			$this->form_validation->set_rules('username', 'Username', 'required|callback_cek_user');
		}

		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('confirm', 'Konfirmasi Password', 'required|matches[password]');
		$this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
		$this->form_validation->set_rules('tmptlahir', 'Tempat Lahir', 'required');
		$this->form_validation->set_rules('tgllahir', 'Tanggal Lahir', 'required');
		// $this->form_validation->set_rules('foto', 'Tanggal Lahir', 'required');

		$this->form_validation->set_message('cek_user','Nomor Induk sudah terdaftar');
		$this->form_validation->set_message('required','{field} masih kosong');
		$this->form_validation->set_message('matches','{field} tidak sesuai dengan Password');

		$pass = md5($this->input->post('password'));
		$posisi = ($this->input->post('posisi')=='g')? 'g':'s';

		if ($this->form_validation->run() == false) {
		
			$ft = $this->Model_user->get_user($this->input->post('username'))->foto;
			$photo = ($ft=='')? '':$ft;

			$data['kelas'] = $this->Kelas->list_kelas();
			$data['form'] = array(
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password'),
				'nama' => $this->input->post('nama'),
				'tmptlahir' => $this->input->post('tmptlahir'),
				'tgllahir' => $this->input->post('tgllahir'),
				'posisi' => $this->input->post('posisi'),
				'foto' => $photo,
				'mode' => $this->input->post('mode')
			);
			$this->load->view('admin/input_user',$data);

		} else if (empty($_FILES['foto']['name'])) {
		
			if ($this->input->post('mode')=='edit') {

			$data = array(
				'username' => $this->input->post('username'),
				'password' => $pass,
				'nama' => $this->input->post('nama'),
				'tempat_lahir' => $this->input->post('tmptlahir'),
				'tgl_lahir' => $this->input->post('tgllahir'),
				'level' => $this->input->post('level'),
				'posisi' => $posisi,
				'status' => $this->Model_user->get_user($this->input->post('username'))->status
			);

			$this->db->where('username',$this->input->post('username'));
			$this->db->update('user', $data);

			if ($posisi=='s') {
				$data_siswa = array(
					'nis' => $this->input->post('username'),
					'id_kelas' => $this->input->post('posisi')
				);
				$this->db->where('nis',$this->input->post('username'));
				$this->db->update('siswa',$data_siswa);

			}
			$data['info'] = array(
				'title' => 'Edit User Sukses !',
				'message'	=> 'User telah berhasil dirubah'
			);

			
			}else{

			$data = array(
				'username' => $this->input->post('username'),
				'password' => $pass,
				'nama' => $this->input->post('nama'),
				'tempat_lahir' => $this->input->post('tmptlahir'),
				'tgl_lahir' => $this->input->post('tgllahir'),
				'foto' => '',
				'level' => $this->input->post('level'),
				'posisi' => $posisi,
				'status' => 'b'
			);	

			$this->db->insert('user',$data);
			if ($posisi=='s') {
				$data_siswa = array(
					'nis' => $this->input->post('username'),
					'id_kelas' => $this->input->post('posisi')
				);

				$this->db->insert('siswa',$data_siswa);

			}

			$data['info'] = array(
				'title' => 'Input User Sukses !',
				'message'	=> 'User telah berhasil ditambahkan'
			);

			}

			$data['kelas'] = $this->Kelas->list_kelas();
			$this->load->view('Admin/input_user',$data);
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
				$data['kelas'] = $this->Kelas->list_kelas();
				$this->load->view('input_user',$data);
			}else{

				if ($this->input->post('mode')=='edit') {

					$data = array(
						'username' => $this->input->post('username'),
						'password' => $pass,
						'nama' => $this->input->post('nama'),
						'tempat_lahir' => $this->input->post('tmptlahir'),
						'foto' => $config['upload_path'].$config['file_name'].'.'.$extension,
						'tgl_lahir' => $this->input->post('tgllahir'),
						'level' => $this->input->post('level'),
						'posisi' => $posisi,
						'status' => $this->Model_user->get_user($this->input->post('username'))->status
					);

					$this->db->where('username',$this->input->post('username'));
					
					if ($this->db->update('user', $data)) {
						if ($posisi=='s') {
							$data_siswa = array(
								'nis' => $this->input->post('username'),
								'id_kelas' => $this->input->post('posisi')
							);
							$this->db->where('nis',$this->input->post('username'));

							$this->db->update('siswa',$data_siswa);

						}

						$data['info'] = array(
							'title' => 'Update User Sukses !',
							'message'	=> 'Data User telah berhasil dirubah'

						);

						$data['kelas'] = $this->Kelas->list_kelas();
						$this->load->view('Admin/input_user',$data);
					}else{
						$data['error'] = 'Edit User gagal, coba lagi !';
						$data['kelas'] = $this->Kelas->list_kelas();
						$data['form'] = array(
										'username' => $this->input->post('username'),
										'password' => $this->input->post('password'),
										'nama' => $this->input->post('nama'),
										'tmptlahir' => $this->input->post('tmptlahir'),
										'tgllahir' => $this->input->post('tgllahir'),
										'posisi' => $this->input->post('posisi'),
										'foto' => $photo,
										'mode' => $this->input->post('mode')
									);
						$this->load->view('admin/input_user',$data);
					}
// akhir
				}else{
					$data = array(
						'username' => $this->input->post('username'),
						'password' => $pass,
						'nama' => $this->input->post('nama'),
						'tempat_lahir' => $this->input->post('tmptlahir'),
						'foto' => $config['upload_path'].$config['file_name'].'.'.$extension,
						'tgl_lahir' => $this->input->post('tgllahir'),
						'level' => $this->input->post('level'),
						'posisi' => $posisi,
						'status' => 'b'
					);
					if ($this->db->insert('user',$data)) {
						if ($posisi=='s') {
							$data_siswa = array(
								'nis' => $this->input->post('username'),
								'id_kelas' => $this->input->post('posisi')
							);

							$this->db->insert('siswa',$data_siswa);

						}

						$data['info'] = array(
							'title' => 'Input User Sukses !',
							'message'	=> 'User telah berhasil ditambahkan'

						);

						$data['kelas'] = $this->Kelas->list_kelas();
						$this->load->view('Admin/input_user',$data);
					}else{
						$data['error'] = 'Input User gagal, coba lagi !';
						$data['kelas'] = $this->Kelas->list_kelas();
						$data['form'] = array(
							'username' => $this->input->post('username'),
							'password' => $this->input->post('password'),
							'nama' => $this->input->post('nama'),
							'tmptlahir' => $this->input->post('tmptlahir'),
							'tgllahir' => $this->input->post('tgllahir'),
							'posisi' => $this->input->post('posisi'),
						);
						$this->load->view('admin/input_user',$data);
					}

				}

			}


		}
	}

	function edit_user()
	{
		// echo "string";
		$id = $this->input->post('id');
		$user = $this->Model_user->get_user($id);
		$kls = $this->Model_user->cek_kelas($id);
		$kelas = ($kls=='')? '':$kls->id_kelas;

		$data['form'] = array(
			'username' => $user->username,
			'password' => '',
			'nama' => $user->nama,
			'tmptlahir' => $user->tempat_lahir,
			'tgllahir' => $user->tgl_lahir,
			'posisi' => $kelas,
			'level' => $user->level,
			'foto'	=> $user->foto,
			'mode'	=> 'edit',
		);

		$data['kelas'] = $this->Kelas->list_kelas();

		$this->load->view('admin/input_user', $data);
		# code...
	}

	function kandidat_page()
	{
		$data['jml_kandidat'] = $this->Kandidat->cek_kandidat();
		$data['kandidat'] = $this->Kandidat->get_kandidat();
		$this->load->view('admin/kandidat_page',$data);
	}
	function kandidat_calon()
	{
		$data['pemilihan'] = $this->Kandidat->get_waktu_pemilihan();
		$data['murid'] = $this->db->get('siswa')->result_array();
		$data['calon'] = $this->db->get('calon')->result_array();


		$data['kelas'] = $this->Kelas->list_kelas();
		$data['siswa'] = $this->db->get_where('user',array('posisi'=>'s'))->result_array();
		$this->load->view('admin/kandidat_calon',$data);
		// print_r($data['siswa']);
	}

	function reset_kandidat()
	{
		$this->db->empty_table('kandidat');
		$this->kandidat_page();
	}

	function calon_tambah()
	{
		// echo "okeee";
		$data = array('id_calon'=>'','nis'=>$this->input->post('id'));
		$jml_calon = $this->db->get('calon')->num_rows();
		if ($jml_calon<6) {
			
			if ($this->db->insert('calon',$data)) {
				// echo "string";
				$this->kandidat_calon();
				# code...
			}else{
				echo "gagal";
			}

		}else{
			$data['error'] = array('title'=> 'Pilih Calon Gagal !', 'message'=>'Maksimal calon kandidat 6 orang');
			$data['murid'] = $this->db->get('siswa')->result_array();
			$data['calon'] = $this->db->get('calon')->result_array();
			$data['kelas'] = $this->Kelas->list_kelas();
			$data['siswa'] = $this->db->get_where('user',array('posisi'=>'s'))->result_array();
			$this->load->view('admin/kandidat_calon',$data);

		}
		# code...
	}

	function calon_hapus()
	{
		// echo "okeee";
        if ($this->Kandidat->cek_calon_di_kandidat($this->input->post('id'))==true) {
            # code...
            $data = array('nis'=>$this->input->post('id'));
            if ($this->db->delete('calon',$data)) {
                // echo "string";
                $this->kandidat_calon();
                # code...
            }else{
                echo "gagal";
            }
        }else{            
            echo "<script>alert('Tidak bisa menghapus calon yang sudah menjadi kandidat !')</script>";
            $this->kandidat_calon();

        }
		# code...
	}

	function kandidat_no()
	{
		$data['pemilihan'] = $this->Kandidat->get_waktu_pemilihan();
		$data['jml_kandidat'] = $this->Kandidat->cek_kandidat();
		$data['kandidat'] = $this->Kandidat->get_kandidat();
		if ($this->Kandidat->get_tipe()==null) {
			# code...

		}else{
			$nama_tipe = ($this->Kandidat->get_tipe()==0)? 'Kandidat Tunggal':'Kandidat Pasangan'; 
			$data['tipe'] = array('tipe'=>$this->Kandidat->get_tipe(),'nama'=>$nama_tipe);
		}
		$data['calon'] = $this->Kandidat->get_data_calon();
		$data['visi_misi'] = $this->Kandidat->get_visi_misi();
        $ids = array();
        foreach ($data['calon'] as $calon) {
            array_push($ids,$calon['nis']);
        }
        // $data['data_kandidat'] = $this->Kandidat->data_calon($ids);
        // $data['data_calon'] = $this->Kandidat->get_data_calon();
        // print_r($data['data_calon']);
        # code...
		$this->load->view('admin/kandidat_no',$data);
        // echo "string";
	}

	function kandidat_tipe()
	{	
		$data['kandidat'] = $this->Kandidat->get_kandidat();
		$data['jml_kandidat'] = $this->Kandidat->cek_kandidat();
		$nama_tipe = ($this->input->post('tipe')==0)? 'Kandidat Tunggal':'Kandidat Pasangan'; 
		$data['tipe'] = array('tipe'=>$this->input->post('tipe'),'nama'=>$nama_tipe);
		$this->load->view('admin/kandidat_no',$data);
	}

	function kandidat_tambah($tipe=null,$id_edit=null)
	{	
		$data['pemilihan'] = $this->Kandidat->get_waktu_pemilihan();
        $data['calon'] = $this->Kandidat->get_data_calon();
        $data['visi_misi'] = $this->Kandidat->get_visi_misi();
		// $data['calon'] = $this->db->get('calon')->result_array();
		$data['kandidat'] = $this->Kandidat->get_kandidat();
		$data['jml_kandidat'] = $this->Kandidat->cek_kandidat();
		$data['jml_calon'] = $this->Kandidat->jml_calon();
		$id_calon = array();
			foreach ($data['calon'] as $cal) {
				array_push($id_calon, $cal['nis']);
			};

		$data['data_calon'] = $this->Kandidat->data_calon($id_calon);

		if ($tipe==null) {
			$nama_tipe = ($this->input->post('tipe')==0)? 'Kandidat Tunggal':'Kandidat Pasangan'; 
			$data['tipe'] = array('tipe'=>$this->input->post('tipe'),'nama'=>$nama_tipe);
		}else{
            // print_r($id_edit);
			$nama_tipe = ($this->Kandidat->get_tipe()==0)? 'Kandidat Tunggal':'Kandidat Pasangan'; 
			$data['tipe'] = array('tipe'=>$this->Kandidat->get_tipe(),'nama'=>$nama_tipe);
		}

        // edit kandidat jika tunggal
        if ($this->Kandidat->get_tipe()==0) {
            # code...
            if ($id_edit<>null) {
                // print_r($id_edit);
                foreach ($data['calon'] as $d_c) {
                    if ($d_c['nomor']==$id_edit) {
                        $id_foto_nama = $d_c['username'].';'.$d_c['foto'].';'.$d_c['nama'];
                    }
                }

                $visi = $this->db->get_where('visi_misi',array('id_vismis'=>$id_edit))->row();
                $misi = array();
                foreach ($data['visi_misi'] as $v_m) {
                    if ($v_m['id_vismis']==$id_edit) {
                        array_push($misi, $v_m['misi']);
                    }
                }

                $data['form'] = array(
                    'tipe' => $this->Kandidat->get_tipe(),
                    'mode' => 'edit',
                    'no_kandidat' => $id_edit,
                    'calon1' => $id_foto_nama,
                    'visi' => $visi->visi,
                    'misi1' => $misi[0],
                    'misi2' => (isset($misi[1]))? $misi[1]:'' ,
                    'misi3' => (isset($misi[2]))? $misi[2]:'',
                    'misi4' => (isset($misi[3]))? $misi[3]:'',
                    'misi5' => (isset($misi[4]))? $misi[4]:''
                );
            }
        }

		$data['tambah'] = array();
		$this->load->view('admin/kandidat_no',$data);
	
    }


	function kandidat_simpan()
	{
		$data['pemilihan'] = $this->Kandidat->get_waktu_pemilihan();
        if ($this->input->post('mode')=='edit') {


            
        }else{
            
            $this->form_validation->set_rules('no_kandidat','Nomor Kandidat','callback_cek_no_calon');
            
            if ($this->input->post('tipe')==0) {
                $this->form_validation->set_rules('calon1','Calon','required|callback_cek_id_kandidat');
            }else{
                $this->form_validation->set_rules('calon1','Calon Pertama','required|callback_cek_id_kandidat');
                $this->form_validation->set_rules('calon2','Calon Kedua','required|callback_cek_id_kandidat');
            }

        }

		$this->form_validation->set_rules('visi','Visi','required');
		$this->form_validation->set_rules('misi1','Misi','required');

		$this->form_validation->set_message('required','{field} Harus Diisi !');
        $data['visi_misi'] = $this->Kandidat->get_visi_misi();
        $data['calon'] = $this->Kandidat->get_data_calon();
		// $data['calon'] = $this->db->get('calon')->result_array();
		$data['kandidat'] = $this->Kandidat->get_kandidat();
		$data['jml_kandidat'] = $this->Kandidat->cek_kandidat();
		$data['jml_calon'] = $this->Kandidat->jml_calon();
		$id_calon = array();
			foreach ($data['calon'] as $cal) {
				array_push($id_calon, $cal['nis']);
			};

		$data['data_calon'] = $this->Kandidat->data_calon($id_calon);

		$nama_tipe = ($this->input->post('tipe')==0)? 'Kandidat Tunggal':'Kandidat Pasangan'; 
		$data['tipe'] = array('tipe'=>$this->input->post('tipe'),'nama'=>$nama_tipe);

		$data['tambah'] = array();
		
		if ($this->form_validation->run()==false) {
			$data['form'] = $this->input->post();
			$this->load->view('admin/kandidat_no',$data);

		}else{

            if ($this->input->post('mode')=='edit') {
                $this->db->delete('kandidat',array('id_kandidat'=>$this->input->post('no_kandidat')));
            }
			// delete data kandidat
			$id_misi = array('id_misi'=>$this->input->post('no_kandidat'));
			$id_visi = array('id_vismis'=>$this->input->post('no_kandidat'));
			$this->db->delete('visi_misi',$id_visi);
			$this->db->delete('misi',$id_misi);
			
			$this->db->set('nomor',0);
			// $i_cal = explode(';', $this->input->post('calon1'));
			$this->db->where('nomor',$this->input->post('no_kandidat'));
			$this->db->update('calon');

			// insert data misi
			for ($i=0; $i < 5; $i++) { 
				# code...
				if ($this->input->post('misi'.($i+1))<>'') {
					$data_misi = array(
						'id_misi' => $this->input->post('no_kandidat'),
						'misi' => $this->input->post('misi'.($i+1))
					);

					$this->db->insert('misi', $data_misi);
				}
			};

			// data visi misi
			$data_visi = array(
				'id_vismis' => $this->input->post('no_kandidat'),
				'visi' => $this->input->post('visi'),
				'id_misi' => $this->input->post('no_kandidat')
			);

			// insert data visi
			$this->db->insert('visi_misi',$data_visi);

			// update nomor calon
			if ($this->input->post('tipe')==0) {
				
				$this->db->set('nomor',$this->input->post('no_kandidat'));
				$i_cal = explode(';', $this->input->post('calon1'));
				$this->db->where('nis',$i_cal[0]);
				$this->db->update('calon');

			}else{

				for ($i=0; $i < 2; $i++) { 
					$i_cal = explode(';', $this->input->post('calon'.($i+1)));
					
					$this->db->set('nomor',$this->input->post('no_kandidat'));
					$this->db->where('nis',$i_cal[0]);
					$this->db->update('calon');
				}

			}

			// inset kandidat
			$data_kandidat = array(
				'id_kandidat' => $this->input->post('no_kandidat'),
				'id_vismis' =>  $this->input->post('no_kandidat'),
				'no_calon' => $this->input->post('no_kandidat'),
				'tipe' => $this->input->post('tipe'),
				'jumlah' => 0
			);
            
            $this->db->insert('kandidat',$data_kandidat);
			// $this->load->view('admin/kandidat_no',$data);
			$this->kandidat_no();

		}
		# code...
	}
	
    function cek_id_kandidat($id)
    {
        $i_cal = explode(';',$id);
        $data = array('nis'=>$i_cal[0]);
        $query = $this->db->get_where('calon',$data)->row();
        if ($query->nomor>0) {
            $this->form_validation->set_message('cek_id_kandidat','{field} telah Terdaftar');
            return false;
        }else{
            return true;
        }
    }

    function cek_no_calon($no)
    {
        $data = array('nomor' => $no );
        if ($this->db->get_where('calon',$data)->num_rows()>0) {
            $this->form_validation->set_message('cek_no_calon','{field} telah Terdaftar');
            return false;
        }else{
            return true;
        }
        # code...
    }

    function kandidat_edit()
    {

        # code...
    }
    function kandidat_hapus()
    {

        $data = array('id_kandidat' => $this->input->post('id') );
        $data_kandidat = $this->db->get_where('kandidat',$data)->row();
        $no_calon = $data_kandidat->no_calon;
        $id_vismis = array('id_vismis'=>$data_kandidat->id_vismis);
        $id_misi = array('id_misi'=>$data_kandidat->id_vismis);


        $this->db->delete('kandidat',$data);

        $this->db->where('nomor',$no_calon);
        $this->db->update('calon',array('nomor'=>0));

        $this->db->delete('visi_misi',$id_vismis);
        $this->db->delete('misi',$id_misi);

        $this->kandidat_no();

    }
} ?>