<?php 
/**
 * 
 */
//load model
class Pelanggan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('pelanggan_model');
		$this->load->model('wilayah_model');
		//proteksi halaman
		$this->simple_login->cek_login();
		$this->simple_login->admin();
	}
	//menampilkan data customer
	public function customer(){
		$id = $this->pelanggan_model->get_last_id();
		$provinsi = $this->wilayah_model->listing();

		if($id){
			$id = $id[0]->id_pelanggan;
			$id_pelanggan = generate_code('cus',$id);
		}else{
			$id_pelanggan = 'cus001';
		}

		$customer = $this->pelanggan_model->customer();
		$data = array(	'title' => 'Data Pelanggan',
						'id'	=> $id_pelanggan,
						'cus'	=> $customer, 
						'prov'	=> $provinsi,
						'provinsi'	=> $provinsi,
						'customer' => $customer,
						'isi' => 'admin/customer/list' );
		$this->load->view('admin/layout/wrapper',$data, FALSE);
	}
	//tambah data customer
	public function add_customer()
	{
		//get provinsi
		$provinsi = $this->wilayah_model->listing();
		//validation
		$valid = $this-> form_validation;

		$valid->set_rules('nama_pelanggan', 'Nama Pelanggan','required',
				array(	'required' 		=> '%s harus diisi'
						));
		$valid->set_rules('alamat', 'Alamat','required',
				array(	'required' 		=> '%s harus diisi'
						));
		$valid->set_rules('no_hp', 'No. Telp','required',
				array(	'required' 		=> '%s harus diisi',
						));
		$valid->set_rules('provinsi', 'provinsi','required',
				array(	'required' 		=> '%s harus diisi'
						));
		$valid->set_rules('kabupaten', 'kabupaten','required',
				array(	'required' 		=> '%s harus diisi'
						));
		$valid->set_rules('kecamatan', 'kecamatan','required',
				array(	'required' 		=> '%s harus diisi',
						));
		$valid->set_rules('komoditi', 'komoditi','required',
				array(	'required' 		=> '%s harus diisi',
						));

		if($valid->run()===FALSE){
			//end validation
			$customer = $this->pelanggan_model->customer();
			$id = $this->pelanggan_model->get_last_id();

			if($id){
				$id = $id[0]->id_pelanggan;
				$id_pelanggan = generate_code('cus',$id);
			}else{
				$id_pelanggan = 'cus001';
			}
			
			$data = array(	'title'		=> 'Tambah Data Pelanggan',
							'customer'	=> $customer,
							'id'		=> $id,
							'provinsi'	=> $provinsi,
							'isi'		=> 'admin/customer/list'
						);
			$this->load->view('admin/layout/wrapper', $data, FALSE);
		}else{
			$i 	= $this->input;
			$data = array(	'id_pelanggan'		=> $i->post('id_pelanggan'),
							'nama_pelanggan'	=> $i->post('nama_pelanggan'),
							'alamat'			=> $i->post('alamat'),
							'no_hp'				=> $i->post('no_hp'),
							'komoditi'			=> $i->post('komoditi'),
							'tanggal_daftar'	=> $i->post('tanggal_daftar'),
							'provinsi'			=> $i->post('prov'),
							'kabupaten'			=> $i->post('kab'),
							'kecamatan'			=> $i->post('kec'),
							'jenis_pelanggan'	=>'Customer'
						);
			$this->pelanggan_model->tambah($data);
			$this->session->set_flashdata('sukses','Data telah ditambah');
			redirect(base_url('admin/pelanggan/customer'), 'refresh');
		}
	}
	//edit data customer
	public function edit_customer($id_pelanggan){
		$customer = $this->pelanggan_model->detail($id_pelanggan);
		//get provinsi
		$provinsi = $this->wilayah_model->listing();
		//validation
		$valid = $this-> form_validation;

		$valid->set_rules('nama_pelanggan', 'Nama Pelanggan','required',
				array(	'required' 		=> '%s harus diisi'
						));
		$valid->set_rules('alamat', 'Alamat','required',
				array(	'required' 		=> '%s harus diisi'
						));
		$valid->set_rules('no_hp', 'No. Telp','required',
				array(	'required' 		=> '%s harus diisi',
						));
		$valid->set_rules('provinsi', 'provinsi','required',
				array(	'required' 		=> '%s harus diisi'
						));
		$valid->set_rules('kabupaten', 'kabupaten','required',
				array(	'required' 		=> '%s harus diisi'
						));
		$valid->set_rules('kecamatan', 'kecamatan','required',
				array(	'required' 		=> '%s harus diisi',
						));
		$valid->set_rules('komoditi', 'komoditi','required',
				array(	'required' 		=> '%s harus diisi',
						));


		if($valid->run()===FALSE){
			//end validation

			$data = array(	'title'		=> 'Edit Pelanggan',
							'customer'	=> $customer,
							'provinsi'	=> $provinsi,
							'isi'		=> 'admin/customer/edit'
						);
			$this->load->view('admin/layout/wrapper', $data, FALSE);
		}else{
			$i = $this->input;
			$prov = $i->post('prov');
			$kab = $i->post('kab');
			$kec = $i->post('kec');
			if((!empty($prov)) and (!empty($kab)) and (!empty($kec))){
				$data = array(	'id_pelanggan'		=> $id_pelanggan,
								'nama_pelanggan'	=> $i->post('nama_pelanggan'),
								'alamat'			=> $i->post('alamat'),
								'no_hp'				=> $i->post('no_hp'),
								'komoditi'		=> $i->post('komoditi'),
								'provinsi'			=> $i->post('prov'),
								'kabupaten'			=> $i->post('kab'),
								'kecamatan'			=> $i->post('kec')
							);
			}else{
				$data = array(	'id_pelanggan'		=> $id_pelanggan,
								'nama_pelanggan'	=> $i->post('nama_pelanggan'),
								'alamat'			=> $i->post('alamat'),
								'no_hp'				=> $i->post('no_hp'),
								'komoditi'		=> $i->post('komoditi')
							);
			}
			$this->pelanggan_model->edit($data);
			$this->session->set_flashdata('sukses','Data telah diedit');
			redirect(base_url('admin/pelanggan/customer'), 'refresh');
		}
	}
	//delete data customer
	public function delete($id_pelanggan){
		$data = array('id_pelanggan' => $id_pelanggan);
		$this->pelanggan_model->delete($data);
		$this->session->set_flashdata('sukses', 'Data telah dihapus');
		redirect(base_url('admin/pelanggan/customer'), 'refresh');
	}
	//menampilkan data mitra
	public function mitra(){
		$id = $this->pelanggan_model->get_last_id();
		$provinsi = $this->wilayah_model->listing();

		if($id){
			$id = $id[0]->id_pelanggan;
			$id_pelanggan = generate_code('mit',$id);
		}else{
			$id_pelanggan = 'mit001';
		}

		$mitra = $this->pelanggan_model->mitra();
		$data = array(	'title' => 'Data Pelanggan',
						'id'	=> $id_pelanggan,
						'provinsi'	=> $provinsi,
						'mitra' => $mitra,
						'isi' => 'admin/mitra/list' );
		$this->load->view('admin/layout/wrapper',$data, FALSE);
	}
	//tambah data mitra
	public function add_mitra()
	{
		//get provinsi
		$provinsi = $this->wilayah_model->listing();
		//validation
		$valid = $this-> form_validation;

		$valid->set_rules('nama_pelanggan', 'Nama Pelanggan','required',
				array(	'required' 		=> '%s harus diisi'
						));
		$valid->set_rules('alamat', 'Alamat','required',
				array(	'required' 		=> '%s harus diisi'
						));
		$valid->set_rules('no_hp', 'No. Telp','required',
				array(	'required' 		=> '%s harus diisi',
						));
		$valid->set_rules('provinsi', 'provinsi','required',
				array(	'required' 		=> '%s harus diisi'
						));
		$valid->set_rules('kabupaten', 'kabupaten','required',
				array(	'required' 		=> '%s harus diisi'
						));
		$valid->set_rules('kecamatan', 'kecamatan','required',
				array(	'required' 		=> '%s harus diisi',
						));
		$valid->set_rules('komoditi', 'komoditi','required',
				array(	'required' 		=> '%s harus diisi',
						));

		if($valid->run()===FALSE){
			//end validation
			$mitra = $this->pelanggan_model->mitra();
			$id = $this->pelanggan_model->get_last_id();

			if($id){
				$id = $id[0]->id_pelanggan;
				$id_pelanggan = generate_code('mit',$id);
			}else{
				$id_pelanggan = 'mit001';
			}
			
			$data = array(	'title'		=> 'Tambah Data Pelanggan',
							'mitra'		=> $mitra,
							'id'		=> $id,
							'komoditi'	=> $komoditi,
							'provinsi'	=> $provinsi,
							'isi'		=> 'admin/mitra/list'
						);
			$this->load->view('admin/layout/wrapper', $data, FALSE);
		}else{
			$i 	= $this->input;
			$data = array(	'id_pelanggan'		=> $i->post('id_pelanggan'),
							'nama_pelanggan'	=> $i->post('nama_pelanggan'),
							'alamat'			=> $i->post('alamat'),
							'no_hp'				=> $i->post('no_hp'),
							'komoditi'			=> $i->post('komoditi'),
							'tanggal_daftar'	=> $i->post('tanggal_daftar'),
							'provinsi'			=> $i->post('prov'),
							'kabupaten'			=> $i->post('kab'),
							'kecamatan'			=> $i->post('kec'),
							'jenis_pelanggan'	=>'Mitra'
						);
			$this->pelanggan_model->tambah($data);
			$this->session->set_flashdata('sukses','Data telah ditambah');
			redirect(base_url('admin/pelanggan/mitra'), 'refresh');
		}
	}
	//edit data mitra
	public function edit_mitra($id_pelanggan){
		$mitra = $this->pelanggan_model->detail($id_pelanggan);
		//get provinsi
		$provinsi = $this->wilayah_model->listing();
		//validation
		$valid = $this-> form_validation;

		$valid->set_rules('nama_pelanggan', 'Nama Pelanggan','required',
				array(	'required' 		=> '%s harus diisi'
						));
		$valid->set_rules('alamat', 'Alamat','required',
				array(	'required' 		=> '%s harus diisi'
						));
		$valid->set_rules('no_hp', 'No. Telp','required',
				array(	'required' 		=> '%s harus diisi',
						));
		$valid->set_rules('provinsi', 'provinsi','required',
				array(	'required' 		=> '%s harus diisi'
						));
		$valid->set_rules('kabupaten', 'kabupaten','required',
				array(	'required' 		=> '%s harus diisi'
						));
		$valid->set_rules('kecamatan', 'kecamatan','required',
				array(	'required' 		=> '%s harus diisi',
						));
		$valid->set_rules('komoditi', 'komoditi','required',
				array(	'required' 		=> '%s harus diisi',
						));


		if($valid->run()===FALSE){
			//end validation

			$data = array(	'title'		=> 'Edit Pelanggan',
							'mitra'		=> $mitra,
							'provinsi'	=> $provinsi,
							'isi'		=> 'admin/mitra/edit'
						);
			$this->load->view('admin/layout/wrapper', $data, FALSE);
		}else{
			$i = $this->input;
			$prov = $i->post('prov');
			$kab = $i->post('kab');
			$kec = $i->post('kec');
			if((!empty($prov)) and (!empty($kab)) and (!empty($kec))){
				$data = array(	'id_pelanggan'		=> $id_pelanggan,
								'nama_pelanggan'	=> $i->post('nama_pelanggan'),
								'alamat'			=> $i->post('alamat'),
								'no_hp'				=> $i->post('no_hp'),
								'komoditi'		=> $i->post('komoditi'),
								'provinsi'			=> $i->post('prov'),
								'kabupaten'			=> $i->post('kab'),
								'kecamatan'			=> $i->post('kec')
							);
			}else{
				$data = array(	'id_pelanggan'		=> $id_pelanggan,
								'nama_pelanggan'	=> $i->post('nama_pelanggan'),
								'alamat'			=> $i->post('alamat'),
								'no_hp'				=> $i->post('no_hp'),
								'komoditi'		=> $i->post('komoditi'),
							);
			}
			$this->pelanggan_model->edit($data);
			$this->session->set_flashdata('sukses','Data telah diedit');
			redirect(base_url('admin/pelanggan/mitra'), 'refresh');
		}
	}
	//delete data mitra
	public function delete_mitra($id_pelanggan){
		$data = array('id_pelanggan' => $id_pelanggan);
		$this->pelanggan_model->delete($data);
		$this->session->set_flashdata('sukses', 'Data telah dihapus');
		redirect(base_url('admin/pelanggan/mitra'), 'refresh');
	}
	//menampilkan data distributor
	public function distributor(){
		$id = $this->pelanggan_model->get_last_id();
		$provinsi = $this->wilayah_model->listing();

		if($id){
			$id = $id[0]->id_pelanggan;
			$id_pelanggan = generate_code('dis',$id);
		}else{
			$id_pelanggan = 'dis001';
		}

		$distributor = $this->pelanggan_model->distributor();
		$data = array(	'title' => 'Data Pelanggan',
						'id'	=> $id_pelanggan,
						'provinsi'	=> $provinsi,
						'distributor' => $distributor,
						'isi' => 'admin/distributor/list' );
		$this->load->view('admin/layout/wrapper',$data, FALSE);
	}
	//tambah data distributor
	public function add_distributor()
	{
		//get provinsi
		$provinsi = $this->wilayah_model->listing();
		//validation
		$valid = $this-> form_validation;

		$valid->set_rules('nama_pelanggan', 'Nama Pelanggan','required',
				array(	'required' 		=> '%s harus diisi'
						));
		$valid->set_rules('alamat', 'Alamat','required',
				array(	'required' 		=> '%s harus diisi'
						));
		$valid->set_rules('no_hp', 'No. Telp','required',
				array(	'required' 		=> '%s harus diisi',
						));
		$valid->set_rules('provinsi', 'provinsi','required',
				array(	'required' 		=> '%s harus diisi'
						));
		$valid->set_rules('kabupaten', 'kabupaten','required',
				array(	'required' 		=> '%s harus diisi'
						));
		$valid->set_rules('kecamatan', 'kecamatan','required',
				array(	'required' 		=> '%s harus diisi',
						));
		$valid->set_rules('komoditi', 'komoditi','required',
				array(	'required' 		=> '%s harus diisi',
						));

		if($valid->run()===FALSE){
			//end validation
			$distributor = $this->pelanggan_model->distributor();
			$id = $this->pelanggan_model->get_last_id();

			if($id){
				$id = $id[0]->id_pelanggan;
				$id_pelanggan = generate_code('dis',$id);
			}else{
				$id_pelanggan = 'dis001';
			}
			
			$data = array(	'title'		=> 'Tambah Data Pelanggan',
							'distributor'	=> $distributor,
							'id'		=> $id,
							'provinsi'	=> $provinsi,
							'isi'		=> 'admin/distributor/list'
						);
			$this->load->view('admin/layout/wrapper', $data, FALSE);
		}else{
			$i 	= $this->input;
			$data = array(	'id_pelanggan'		=> $i->post('id_pelanggan'),
							'nama_pelanggan'	=> $i->post('nama_pelanggan'),
							'alamat'			=> $i->post('alamat'),
							'no_hp'				=> $i->post('no_hp'),
							'komoditi'		=> $i->post('komoditi'),
							'tanggal_daftar'	=> $i->post('tanggal_daftar'),
							'provinsi'			=> $i->post('prov'),
							'kabupaten'			=> $i->post('kab'),
							'kecamatan'			=> $i->post('kec'),
							'jenis_pelanggan'	=>'Distributor'
						);
			$this->pelanggan_model->tambah($data);
			$this->session->set_flashdata('sukses','Data telah ditambah');
			redirect(base_url('admin/pelanggan/distributor'), 'refresh');
		}
	}
	//edit data distributor
	public function edit_distributor($id_pelanggan){
		$distributor = $this->pelanggan_model->detail($id_pelanggan);
		//get provinsi
		$provinsi = $this->wilayah_model->listing();
		//validation
		$valid = $this-> form_validation;

		$valid->set_rules('nama_pelanggan', 'Nama Pelanggan','required',
				array(	'required' 		=> '%s harus diisi'
						));
		$valid->set_rules('alamat', 'Alamat','required',
				array(	'required' 		=> '%s harus diisi'
						));
		$valid->set_rules('no_hp', 'No. Telp','required',
				array(	'required' 		=> '%s harus diisi',
						));
		$valid->set_rules('provinsi', 'provinsi','required',
				array(	'required' 		=> '%s harus diisi'
						));
		$valid->set_rules('kabupaten', 'kabupaten','required',
				array(	'required' 		=> '%s harus diisi'
						));
		$valid->set_rules('kecamatan', 'kecamatan','required',
				array(	'required' 		=> '%s harus diisi',
						));
		$valid->set_rules('komoditi', 'komoditi','required',
				array(	'required' 		=> '%s harus diisi',
						));


		if($valid->run()===FALSE){
			//end validation

			$data = array(	'title'		=> 'Edit Pelanggan',
							'distributor'	=> $distributor,
							'provinsi'	=> $provinsi,
							'isi'		=> 'admin/distributor/edit'
						);
			$this->load->view('admin/layout/wrapper', $data, FALSE);
		}else{
			$i = $this->input;
			$prov = $i->post('prov');
			$kab = $i->post('kab');
			$kec = $i->post('kec');
			if((!empty($prov)) and (!empty($kab)) and (!empty($kec))){
				$data = array(	'id_pelanggan'		=> $id_pelanggan,
								'nama_pelanggan'	=> $i->post('nama_pelanggan'),
								'komoditi'			=> $i->post('komoditi'),
								'alamat'			=> $i->post('alamat'),
								'no_hp'				=> $i->post('no_hp'),
								'provinsi'			=> $i->post('prov'),
								'kabupaten'			=> $i->post('kab'),
								'kecamatan'			=> $i->post('kec')
							);
			}else{
				$data = array(	'id_pelanggan'		=> $id_pelanggan,
								'nama_pelanggan'	=> $i->post('nama_pelanggan'),
								'komoditi'		=> $i->post('komoditi'),
								'alamat'			=> $i->post('alamat'),
								'no_hp'				=> $i->post('no_hp'),
							);
			}
			$this->pelanggan_model->edit($data);
			$this->session->set_flashdata('sukses','Data telah diedit');
			redirect(base_url('admin/pelanggan/distributor'), 'refresh');
		}
	}
	//delete data distributor
	public function delete_distributor($id_pelanggan){
		$data = array('id_pelanggan' => $id_pelanggan);
		$this->pelanggan_model->delete($data);
		$this->session->set_flashdata('sukses', 'Data telah dihapus');
		redirect(base_url('admin/pelanggan/distributor'), 'refresh');
	}
}