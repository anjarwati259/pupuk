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
		$this->load->model('order_model');
		$this->load->model('pelanggan_model');
		$this->load->model('marketing_model');
		$this->load->model('wilayah_model');
		$this->load->model('dashboard_model');
		//proteksi halaman
		$this->simple_login->cek_login();
		//$this->simple_login->admin();
	}
	//menampilkan data customer
	public function customer(){
		$id_user 	= $this->session->userdata('id_user');
		$market 	=  $this->marketing_model->get_marketing($id_user);

		$pelanggan_id = $this->pelanggan_model->get_last_id();
		$marketing = $this->pelanggan_model->marketing();
		$id_user = $this->session->userdata('id_user');
		$provinsi = $this->wilayah_model->listing();

		//last id pelanggan
		if($pelanggan_id){
			$id = substr($pelanggan_id[0]->id_pelanggan, 1);
			$id_pelanggan = generate_code('C', $id);
		}else{
			$id_pelanggan = 'C001';
		}
		$hak_akses = $this->session->userdata('hak_akses');
		if($hak_akses==1){
			$customer = $this->pelanggan_model->customer();
		}else if($hak_akses==5){
			$marketing =  $this->marketing_model->get_marketing($id_user);
			$id_marketing = $marketing->id_marketing;
			$customer = $this->pelanggan_model->get_marketing($id_marketing,'Customer');
		}

		
		$data = array(	'title' => 'Data Pelanggan',
						'id'	=> $id_pelanggan,
						'marketing' => $marketing,
						'cus'	=> $customer, 
						'prov'	=> $provinsi,
						'market' =>$market,
						'provinsi'	=> $provinsi,
						'customer' => $customer,
						'isi' => 'admin/customer/list' );
		$this->load->view('admin/layout/wrapper',$data, FALSE);
	}
	//tambah data customer
	public function add_customer()
	{
		
		//get provinsi
		$id_user 	= $this->session->userdata('id_user');
		$market 	= $this->marketing_model->get_marketing($id_user);
		$provinsi = $this->wilayah_model->listing();
		$id = $this->pelanggan_model->get_last_id();
		$marketing = $this->pelanggan_model->marketing();
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
		$valid->set_rules('jenis_pelanggan', 'Jenis Pelanggan','required',
				array(	'required' 		=> '%s harus diisi',
						));
		//end validation
			$customer = $this->pelanggan_model->customer();
			$pelanggan_id = $this->pelanggan_model->get_last_id();

			//last id pelanggan
			if($pelanggan_id){
				$id = substr($pelanggan_id[0]->id_pelanggan, 1);
				$id_pelanggan = generate_code('C', $id);
			}else{
				$id_pelanggan = 'C001';
			}
			

		if($valid->run()===FALSE){
			
			$data = array(	'title'		=> 'Tambah Data Pelanggan',
							'customer'	=> $customer,
							'marketing' => $marketing,
							'market'	=> $market,
							'id'		=> $id,
							'provinsi'	=> $provinsi,
							'isi'		=> 'admin/customer/list'
						);
			$this->load->view('admin/layout/wrapper', $data, FALSE);
		}else{
			$i 	= $this->input;
			$data = array(	'id_pelanggan'		=> $id_pelanggan,
							'nama_pelanggan'	=> $i->post('nama_pelanggan'),
							'id_marketing'		=> $i->post('id_marketing'),
							'alamat'			=> $i->post('alamat'),
							'no_hp'				=> $i->post('no_hp'),
							'tanggal_daftar'	=> $i->post('tanggal_daftar'),
							'provinsi'			=> $i->post('prov'),
							'kabupaten'			=> $i->post('kab'),
							'kecamatan'			=> $i->post('kec'),
							'jenis_pelanggan'	=> $i->post('jenis_pelanggan')
						);
			$this->pelanggan_model->tambah($data);
			$this->session->set_flashdata('sukses','Data telah ditambah');
			redirect(base_url('admin/pelanggan/customer'), 'refresh');
		}
	}
	//edit data customer
	public function edit_customer($id_pelanggan){
		$customer = $this->pelanggan_model->detail($id_pelanggan);
		$id_user 	= $this->session->userdata('id_user');
		$market 	=  $this->marketing_model->get_marketing($id_user);
		//get provinsi
		$marketing = $this->pelanggan_model->marketing();
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
		$valid->set_rules('jenis_pelanggan', 'Jenis Pelanggan','required',
				array(	'required' 		=> '%s harus diisi',
						));

		if($valid->run()===FALSE){
			//end validation

			$data = array(	'title'		=> 'Edit Pelanggan',
							'customer'	=> $customer,
							'market'	=> $market,
							'marketing' => $marketing,
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
								'id_marketing'		=> $i->post('id_marketing'),
								'jenis_pelanggan'		=> $i->post('jenis_pelanggan'),
								'provinsi'			=> $i->post('prov'),
								'kabupaten'			=> $i->post('kab'),
								'kecamatan'			=> $i->post('kec')
							);
			}else if(!empty($prov)){
				$data = array(	'id_pelanggan'		=> $id_pelanggan,
								'nama_pelanggan'	=> $i->post('nama_pelanggan'),
								'alamat'			=> $i->post('alamat'),
								'no_hp'				=> $i->post('no_hp'),
								'id_marketing'		=> $i->post('id_marketing'),
								'jenis_pelanggan'		=> $i->post('jenis_pelanggan'),
								'provinsi'			=> $i->post('prov')
							);
			}else if(!empty($kab)){
				$data = array(	'id_pelanggan'		=> $id_pelanggan,
								'nama_pelanggan'	=> $i->post('nama_pelanggan'),
								'alamat'			=> $i->post('alamat'),
								'no_hp'				=> $i->post('no_hp'),
								'id_marketing'		=> $i->post('id_marketing'),
								'jenis_pelanggan'		=> $i->post('jenis_pelanggan'),
								'kabupaten'			=> $i->post('kab')
							);
			}else if(!empty($kec)){
				$data = array(	'id_pelanggan'		=> $id_pelanggan,
								'nama_pelanggan'	=> $i->post('nama_pelanggan'),
								'alamat'			=> $i->post('alamat'),
								'no_hp'				=> $i->post('no_hp'),
								'id_marketing'		=> $i->post('id_marketing'),
								'jenis_pelanggan'		=> $i->post('jenis_pelanggan'),
								'kecamatan'			=> $i->post('kec')
							);
			}else{
				$data = array(	'id_pelanggan'		=> $id_pelanggan,
								'nama_pelanggan'	=> $i->post('nama_pelanggan'),
								'id_marketing'		=> $i->post('id_marketing'),
								'jenis_pelanggan'		=> $i->post('jenis_pelanggan'),
								'alamat'			=> $i->post('alamat'),
								'no_hp'				=> $i->post('no_hp'),
							);
			}
			$this->pelanggan_model->edit($data);
			$this->session->set_flashdata('sukses','Data telah diedit');
			redirect(base_url('admin/pelanggan/customer'), 'refresh');
		}
	}
	//delete data customer
	public function delete($id_pelanggan){
		$kode = $this->pelanggan_model->get_invoice($id_pelanggan);
		$kode_transaksi = $kode->kode_transaksi;
		//print_r($kode_transaksi);
		if(!empty($kode_transaksi)){
			$data = array('id_pelanggan' => $id_pelanggan);
			$this->pelanggan_model->delete($data);
			$this->order_model->delete_stok($kode_transaksi);
			$this->order_model->delete_order($kode_transaksi);
			$this->order_model->delete_detail($kode_transaksi);
			$this->session->set_flashdata('sukses', 'Data telah dihapus');
			redirect(base_url('admin/pelanggan/customer'), 'refresh');
		}else{
			$data = array('id_pelanggan' => $id_pelanggan);
			$this->pelanggan_model->delete($data);
			$this->session->set_flashdata('sukses', 'Data telah dihapus');
			redirect(base_url('admin/pelanggan/customer'), 'refresh');
		}
	}
	//menampilkan data mitra
	public function mitra(){
		$pelanggan_id = $this->pelanggan_model->get_last_id();
		$id_user 	= $this->session->userdata('id_user');
		$market 	=  $this->marketing_model->get_marketing($id_user);
		$id_user = $this->session->userdata('id_user');
		$marketing = $this->pelanggan_model->marketing();
		$provinsi = $this->wilayah_model->listing();

		//last id pelanggan
		if($pelanggan_id){
			$id = substr($pelanggan_id[0]->id_pelanggan, 1);
			$id_pelanggan = generate_code('C', $id);
		}else{
			$id_pelanggan = 'C001';
		}

		$hak_akses = $this->session->userdata('hak_akses');
		if($hak_akses==1){
			$mitra = $this->pelanggan_model->mitra();
		}else if($hak_akses==5){
			$marketing =  $this->marketing_model->get_marketing($id_user);
			$id_marketing = $marketing->id_marketing;
			$mitra = $this->pelanggan_model->get_marketing($id_marketing,'Mitra');
		}
		$data = array(	'title' => 'Data Pelanggan',
						'id'	=> $id_pelanggan,
						'provinsi'	=> $provinsi,
						'market'	=> $market,
						'marketing' => $marketing,
						'mitra' => $mitra,
						'isi' => 'admin/mitra/list' );
		$this->load->view('admin/layout/wrapper',$data, FALSE);
	}
	//tambah data mitra
	public function add_mitra()
	{
		//get provinsi
		$provinsi = $this->wilayah_model->listing();
		$id_user 	= $this->session->userdata('id_user');
		$market 	=  $this->marketing_model->get_marketing($id_user);
		$id = $this->pelanggan_model->get_last_id();
		$marketing = $this->pelanggan_model->marketing();
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
		$valid->set_rules('jenis_pelanggan', 'Jenis Pelanggan','required',
				array(	'required' 		=> '%s harus diisi',
						));

		//end validation
			$mitra = $this->pelanggan_model->mitra();
			$pelanggan_id = $this->pelanggan_model->get_last_id();

			//last id pelanggan
		if($pelanggan_id){
			$id = substr($pelanggan_id[0]->id_pelanggan, 1);
			$id_pelanggan = generate_code('C', $id);
		}else{
			$id_pelanggan = 'C001';
		}

		if($valid->run()===FALSE){
			
			
			$data = array(	'title'		=> 'Tambah Data Pelanggan',
							'mitra'		=> $mitra,
							'id'		=> $id,
							'marketing' => $marketing,
							'market'	=> $market,
							'komoditi'	=> $komoditi,
							'provinsi'	=> $provinsi,
							'isi'		=> 'admin/mitra/list'
						);
			$this->load->view('admin/layout/wrapper', $data, FALSE);
		}else{
			$i 	= $this->input;
			$data = array(	'id_pelanggan'		=> $id_pelanggan,
							'nama_pelanggan'	=> $i->post('nama_pelanggan'),
							'id_marketing'		=> $i->post('id_marketing'),
							'alamat'			=> $i->post('alamat'),
							'no_hp'				=> $i->post('no_hp'),
							'tanggal_daftar'	=> $i->post('tanggal_daftar'),
							'provinsi'			=> $i->post('prov'),
							'kabupaten'			=> $i->post('kab'),
							'kecamatan'			=> $i->post('kec'),
							'jenis_pelanggan'	=> $i->post('jenis_pelanggan')
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
		$id_user 	= $this->session->userdata('id_user');
		$market 	=  $this->marketing_model->get_marketing($id_user);
		$marketing = $this->pelanggan_model->marketing();
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
		$valid->set_rules('jenis_pelanggan', 'Jenis Pelanggan','required',
				array(	'required' 		=> '%s harus diisi',
						));


		if($valid->run()===FALSE){
			//end validation

			$data = array(	'title'		=> 'Edit Pelanggan',
							'mitra'		=> $mitra,
							'market'	=> $market,
							'provinsi'	=> $provinsi,
							'marketing' => $marketing,
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
								'id_marketing'		=> $i->post('id_marketing'),
								'jenis_pelanggan'		=> $i->post('jenis_pelanggan'),
								'provinsi'			=> $i->post('prov'),
								'kabupaten'			=> $i->post('kab'),
								'kecamatan'			=> $i->post('kec')
							);
			}else if(!empty($prov)){
				$data = array(	'id_pelanggan'		=> $id_pelanggan,
								'nama_pelanggan'	=> $i->post('nama_pelanggan'),
								'alamat'			=> $i->post('alamat'),
								'no_hp'				=> $i->post('no_hp'),
								'id_marketing'		=> $i->post('id_marketing'),
								'jenis_pelanggan'		=> $i->post('jenis_pelanggan'),
								'provinsi'			=> $i->post('prov')
							);
			}else if(!empty($kab)){
				$data = array(	'id_pelanggan'		=> $id_pelanggan,
								'nama_pelanggan'	=> $i->post('nama_pelanggan'),
								'alamat'			=> $i->post('alamat'),
								'no_hp'				=> $i->post('no_hp'),
								'id_marketing'		=> $i->post('id_marketing'),
								'jenis_pelanggan'		=> $i->post('jenis_pelanggan'),
								'kabupaten'			=> $i->post('kab')
							);
			}else if(!empty($kec)){
				$data = array(	'id_pelanggan'		=> $id_pelanggan,
								'nama_pelanggan'	=> $i->post('nama_pelanggan'),
								'alamat'			=> $i->post('alamat'),
								'no_hp'				=> $i->post('no_hp'),
								'id_marketing'		=> $i->post('id_marketing'),
								'jenis_pelanggan'		=> $i->post('jenis_pelanggan'),
								'kecamatan'			=> $i->post('kec')
							);
			}else{
				$data = array(	'id_pelanggan'		=> $id_pelanggan,
								'nama_pelanggan'	=> $i->post('nama_pelanggan'),
								'id_marketing'		=> $i->post('id_marketing'),
								'jenis_pelanggan'		=> $i->post('jenis_pelanggan'),
								'alamat'			=> $i->post('alamat'),
								'no_hp'				=> $i->post('no_hp'),
							);
			}
			$this->pelanggan_model->edit($data);
			$this->session->set_flashdata('sukses','Data telah diedit');
			redirect(base_url('admin/pelanggan/mitra'), 'refresh');
		}
	}
	//delete data mitra
	public function delete_mitra($id_pelanggan){
		$kode = $this->pelanggan_model->get_invoice($id_pelanggan);
		$kode_transaksi = $kode->kode_transaksi;
		//print_r($kode_transaksi);
		if(!empty($kode_transaksi)){
			$data = array('id_pelanggan' => $id_pelanggan);
			$this->pelanggan_model->delete($data);
			$this->order_model->delete_stok($kode_transaksi);
			$this->order_model->delete_order($kode_transaksi);
			$this->order_model->delete_detail($kode_transaksi);
		}else{
			$data = array('id_pelanggan' => $id_pelanggan);
			$this->pelanggan_model->delete($data);
		}
		 $this->session->set_flashdata('sukses', 'Data telah dihapus');
		redirect(base_url('admin/pelanggan/mitra'), 'refresh');
	}
	//menampilkan data distributor
	public function distributor(){
		$pelanggan_id = $this->pelanggan_model->get_last_id();
		$id_user = $this->session->userdata('id_user');
		$provinsi = $this->wilayah_model->listing();
		$market 	=  $this->marketing_model->get_marketing($id_user);
		$marketing = $this->pelanggan_model->marketing();
		//last id pelanggan
		if($pelanggan_id){
			$id = substr($pelanggan_id[0]->id_pelanggan, 1);
			$id_pelanggan = generate_code('C', $id);
		}else{
			$id_pelanggan = 'C001';
		}

		$hak_akses = $this->session->userdata('hak_akses');
		if($hak_akses==1){
			$distributor = $this->pelanggan_model->distributor();
		}else if($hak_akses==5){
			$marketing =  $this->marketing_model->get_marketing($id_user);
			$id_marketing = $marketing->id_marketing;
			$distributor = $this->pelanggan_model->get_marketing($id_marketing,'Distributor');
		}
		
		$data = array(	'title' => 'Data Pelanggan',
						'id'	=> $id_pelanggan,
						'market' => $market,
						'provinsi'	=> $provinsi,
						'marketing'	=> $marketing,
						'distributor' => $distributor,
						'isi' => 'admin/distributor/list' );
		$this->load->view('admin/layout/wrapper',$data, FALSE);
	}
	//tambah data distributor
	public function add_distributor()
	{
		//get provinsi
		$provinsi = $this->wilayah_model->listing();
		$id = $this->pelanggan_model->get_last_id();
		$id_user 	= $this->session->userdata('id_user');
		$market 	=  $this->marketing_model->get_marketing($id_user);
		$marketing = $this->pelanggan_model->marketing();
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
		$valid->set_rules('jenis_pelanggan', 'Jenis Pelanggan','required',
				array(	'required' 		=> '%s harus diisi',
						));

		//end validation
			$distributor = $this->pelanggan_model->distributor();
			$pelanggan_id = $this->pelanggan_model->get_last_id();
		//last id pelanggan
		if($pelanggan_id){
			$id = substr($pelanggan_id[0]->id_pelanggan, 1);
			$id_pelanggan = generate_code('C', $id);
		}else{
			$id_pelanggan = 'C001';
		}

		if($valid->run()===FALSE){
			$data = array(	'title'		=> 'Tambah Data Pelanggan',
							'distributor'	=> $distributor,
							'id'		=> $id,
							'market'	=> $market,
							'marketing' => $marketing,
							'provinsi'	=> $provinsi,
							'isi'		=> 'admin/distributor/list'
						);
			$this->load->view('admin/layout/wrapper', $data, FALSE);
		}else{
			$i 	= $this->input;
			$data = array(	'id_pelanggan'		=> $id_pelanggan,
							'nama_pelanggan'	=> $i->post('nama_pelanggan'),
							'alamat'			=> $i->post('alamat'),
							'no_hp'				=> $i->post('no_hp'),
							'tanggal_daftar'	=> $i->post('tanggal_daftar'),
							'id_marketing'		=> $i->post('id_marketing'),
							'provinsi'			=> $i->post('prov'),
							'kabupaten'			=> $i->post('kab'),
							'kecamatan'			=> $i->post('kec'),
							'jenis_pelanggan'	=> $i->post('jenis_pelanggan')
						);
			$this->pelanggan_model->tambah($data);
			$this->session->set_flashdata('sukses','Data telah ditambah');
			redirect(base_url('admin/pelanggan/distributor'), 'refresh');
		}
	}
	//edit data distributor
	public function edit_distributor($id_pelanggan){
		$distributor = $this->pelanggan_model->detail($id_pelanggan);
		$id_user 	= $this->session->userdata('id_user');
		$market 	=  $this->marketing_model->get_marketing($id_user);
		//get provinsi
		$marketing = $this->pelanggan_model->marketing();
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
		$valid->set_rules('jenis_pelanggan', 'Jenis Pelanggan','required',
				array(	'required' 		=> '%s harus diisi',
						));


		if($valid->run()===FALSE){
			//end validation

			$data = array(	'title'		=> 'Edit Pelanggan',
							'distributor'	=> $distributor,
							'market'	=> $market,
							'provinsi'	=> $provinsi,
							'marketing' => $marketing,
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
								'alamat'			=> $i->post('alamat'),
								'no_hp'				=> $i->post('no_hp'),
								'id_marketing'		=> $i->post('id_marketing'),
								'jenis_pelanggan'		=> $i->post('jenis_pelanggan'),
								'provinsi'			=> $i->post('prov'),
								'kabupaten'			=> $i->post('kab'),
								'kecamatan'			=> $i->post('kec')
							);
			}else if(!empty($prov)){
				$data = array(	'id_pelanggan'		=> $id_pelanggan,
								'nama_pelanggan'	=> $i->post('nama_pelanggan'),
								'alamat'			=> $i->post('alamat'),
								'no_hp'				=> $i->post('no_hp'),
								'id_marketing'		=> $i->post('id_marketing'),
								'jenis_pelanggan'		=> $i->post('jenis_pelanggan'),
								'provinsi'			=> $i->post('prov')
							);
			}else if(!empty($kab)){
				$data = array(	'id_pelanggan'		=> $id_pelanggan,
								'nama_pelanggan'	=> $i->post('nama_pelanggan'),
								'alamat'			=> $i->post('alamat'),
								'no_hp'				=> $i->post('no_hp'),
								'id_marketing'		=> $i->post('id_marketing'),
								'jenis_pelanggan'		=> $i->post('jenis_pelanggan'),
								'kabupaten'			=> $i->post('kab')
							);
			}else if(!empty($kec)){
				$data = array(	'id_pelanggan'		=> $id_pelanggan,
								'nama_pelanggan'	=> $i->post('nama_pelanggan'),
								'alamat'			=> $i->post('alamat'),
								'no_hp'				=> $i->post('no_hp'),
								'id_marketing'		=> $i->post('id_marketing'),
								'jenis_pelanggan'		=> $i->post('jenis_pelanggan'),
								'kecamatan'			=> $i->post('kec')
							);
			}else{
				$data = array(	'id_pelanggan'		=> $id_pelanggan,
								'nama_pelanggan'	=> $i->post('nama_pelanggan'),
								'id_marketing'		=> $i->post('id_marketing'),
								'jenis_pelanggan'		=> $i->post('jenis_pelanggan'),
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
		$kode = $this->pelanggan_model->get_invoice($id_pelanggan);
		$kode_transaksi = $kode->kode_transaksi;
		//print_r($kode_transaksi);
		if(!empty($kode_transaksi)){
			$data = array('id_pelanggan' => $id_pelanggan);
			$this->pelanggan_model->delete($data);
			$this->order_model->delete_stok($kode_transaksi);
			$this->order_model->delete_order($kode_transaksi);
			$this->order_model->delete_detail($kode_transaksi);
		}else{
			$data = array('id_pelanggan' => $id_pelanggan);
			$this->pelanggan_model->delete($data);
		}
		 $this->session->set_flashdata('sukses', 'Data telah dihapus');
		redirect(base_url('admin/pelanggan/distributor'), 'refresh');
	}

	public function detail($id_pelanggan){
		$pelanggan = $this->pelanggan_model->detail($id_pelanggan);
		$data = array(	'title' => 'Detail Pelanggan',
						'pelanggan' => $pelanggan,
						'isi' => 'admin/customer/detail' );
		//print_r($pelanggan);
		$this->load->view('admin/layout/wrapper',$data, FALSE);
	}
	public function follow(){
		$id_pelanggan = $this->input->post('id_pelanggan');
		$id_marketing = $this->input->post('id_marketing');
		$status = $this->input->post('status');

		$data = array(	'id_pelanggan' => $id_pelanggan,
						'id_marketing' => $id_marketing,
						'status'		=> $status,
						'last_kontak'	=> date('Y-m-d h:i:s')
					);
		$this->pelanggan_model->insert_aktivitas($data);
		echo json_encode(array('statusCode' => 200 ));
	}
	// ============================= Marketing====================//
}