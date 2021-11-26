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
		}else if($hak_akses==5 || $hak_akses==6 || $hak_akses==7){
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
		}else if($hak_akses==5 || $hak_akses==6 || $hak_akses==7){
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
		$follow = $this->pelanggan_model->follow($id_pelanggan);
		$total = $this->pelanggan_model->total_follow($id_pelanggan);
		$last_contact = $this->pelanggan_model->last_contact($id_pelanggan);
		$data = array(	'title' => 'Detail Pelanggan',
						'pelanggan' => $pelanggan,
						'follow'	=> $follow, 
						'total'		=> $total,
						'last_contact' => $last_contact,
						'isi' => 'admin/customer/detail' );
		//print_r($pelanggan);
		$this->load->view('admin/layout/wrapper',$data, FALSE);
	}
	public function follow(){
		$id_pelanggan = $this->input->post('id_pelanggan');
		$id_marketing = $this->input->post('id_marketing');
		$text = $this->input->post('text_follow');
		$status = $this->input->post('status');

		$data = array(	'id_pelanggan' => $id_pelanggan,
						'id_marketing' => $id_marketing,
						'status'		=> $status,
						'text'			=> $text,
						'last_kontak'	=> date('Y-m-d h:i:s')
					);
		$this->pelanggan_model->insert_aktivitas($data);
		if($text != null){
			echo json_encode(array('statusCode' => 200 ));
		}else{
			echo json_encode(array('statusCode' => 210 ));
		}
	}
	public function follow_calon(){
		$id_calon = $this->input->post('id_calon');
		$id_marketing = $this->input->post('id_marketing');
		$text = $this->input->post('text_follow');
		$status = $this->input->post('status');

		$data = array(	'id_pelanggan' => $id_calon,
						'id_marketing' => $id_marketing,
						'status'		=> $status,
						'text'			=> $text,
						'last_kontak'	=> date('Y-m-d h:i:s')
					);
		$this->pelanggan_model->insert_aktivitas($data);
		if($text != null){
			echo json_encode(array('statusCode' => 200 ));
		}else{
			echo json_encode(array('statusCode' => 210 ));
		}
	}
	public function detail_follow(){
		$id = $this->input->post('id');
		$follow = $this->pelanggan_model->follow($id);
		echo json_encode($follow);
	}
	public function count_follow(){
		$id_pelanggan = $this->input->post('id');
		$total = $this->pelanggan_model->total_follow($id_pelanggan);
		echo json_encode($total);

	}
	// public function calon_detail_follow(){
	// 	$id = $this->input->post('id');
	// 	$follow = $this->pelanggan_model->follow_calon($id);
	// 	echo json_encode($follow);
	// }
	// ============================= Colon customer ====================//
	public function calon_customer(){ 
		$id_user = $this->session->userdata('id_user');
		$marketing =  $this->marketing_model->get_marketing($id_user);
		$id_marketing = $marketing->id_marketing;
		$status = $marketing->status;
		$marketing = $this->pelanggan_model->marketing();
		if($this->session->userdata('hak_akses')=='1'){
			$calon = $this->pelanggan_model->list_calon();
		}else{
			$calon = $this->pelanggan_model->listcalon($id_marketing);
		}
		

		$data = array(	'title' => 'Data Calon Customer',
						'calon'	=> $calon,
						'reminder' => $calon,
						'marketing' => $marketing,
						'status'	=> $status,
						'isi' => 'admin/calon/list' );
		//print_r($calon);
		$this->load->view('admin/layout/wrapper',$data, FALSE);
	}
	public function add_calon(){
		//get provinsi
		$marketing = $this->pelanggan_model->marketing();
		$provinsi = $this->wilayah_model->listing();
		$id_user 	= $this->session->userdata('id_user');
		$market 	=  $this->marketing_model->get_marketing($id_user);
		$calon = $this->pelanggan_model->listcalon($market->id_marketing);

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

		$valid->set_rules('status', 'Sumber','required',
				array(	'required' 		=> '%s harus diisi',
						));
		$calon_id = $this->pelanggan_model->get_last_calon();
		//last id pelanggan
		if($calon_id){
			$id = substr($calon_id[0]->id_calon, 1);
			$id_calon = generate_code('P', $id);
		}else{
			$id_calon = 'P001';
		}

		if($valid->run()===FALSE){
			$data = array(	'title' => 'Data Calon Customer',
							'calon'	=> $calon,
							'marketing' => $marketing,
							'provinsi' => $provinsi,
							'id'	=> $id_calon,
							'market' =>$market,
							'isi' => 'admin/calon/tambah' );
			//print_r($pelanggan);
			$this->load->view('admin/layout/wrapper',$data, FALSE);
		}else{
			$i 	= $this->input;
			$data = array(	'id_calon'		=> $id_calon,
							'nama_calon'	=> $i->post('nama_pelanggan'),
							'alamat'			=> $i->post('alamat'),
							'no_hp'				=> $i->post('no_hp'),
							'tanggal'			=> $i->post('tanggal_daftar'),
							'id_marketing'		=> $i->post('id_marketing'),
							'provinsi'			=> $i->post('prov'),
							'kabupaten'			=> $i->post('kab'),
							'kecamatan'			=> $i->post('kec'),
							'komoditi'			=> $i->post('komoditi'),
							'keterangan'		=> $i->post('keterangan'),
							'status'			=> $i->post('status'),
						);
			//print_r($data);
			$this->pelanggan_model->tambah_calon($data);
			$this->session->set_flashdata('sukses','Data telah ditambah');
			redirect(base_url('admin/pelanggan/calon_customer'), 'refresh');
		}
	}
	public function reminder($id_pelanggan){
		$data = array(	'id_pelanggan'	=> $id_pelanggan,
						'judul'		=> $this->input->post('judul'),
						'tanggal'	=> $this->input->post('tanggal'),
						'deskripsi'	=> $this->input->post('deskripsi'),
						);
		print_r($data);
	}
	public function ubah($id_calon){
		$pelanggan_id = $this->pelanggan_model->get_last_id();
		//last id pelanggan
		if($pelanggan_id){
			$id = substr($pelanggan_id[0]->id_pelanggan, 1);
			$id_pelanggan = generate_code('C', $id);
		}else{
			$id_pelanggan = 'C001';
		}

		$data = array(	'id_pelanggan'	  => $id_pelanggan,
						'id_marketing'	  => $this->input->post('id_marketing'),
						'nama_pelanggan'=> $this->input->post('nama_pelanggan'),
						'no_hp'	  => $this->input->post('no_hp'),
						'alamat'	  => $this->input->post('alamat'),
						'kecamatan'	  => $this->input->post('kecamatan'),
						'kabupaten'	  => $this->input->post('kabupaten'),
						'provinsi'	  => $this->input->post('provinsi'),
						'komoditi'	  => $this->input->post('komoditi'),
						'tanggal_daftar'=> $this->input->post('tanggal_daftar'),
						'jenis_pelanggan' => $this->input->post('jenis_pelanggan'),
						);
		$data_2 = array('id_calon'	  => $id_calon,
						'keterangan'	=> 'Sudah Menjadi Pelanggan',
						'status'	=> 2,

		);
		//print_r($data);
		$this->pelanggan_model->tambah($data);
		$this->pelanggan_model->edit_calon($data_2);
		$this->session->set_flashdata('sukses','Data telah ditambah');
		redirect(base_url('admin/pelanggan/calon_customer'), 'refresh');
	}
	public function edit_calon($id_calon){
		$marketing = $this->pelanggan_model->marketing();
		$provinsi = $this->wilayah_model->listing();
		$id_user 	= $this->session->userdata('id_user');
		$market 	=  $this->marketing_model->get_marketing($id_user);
		$calon = $this->pelanggan_model->calon($id_calon);

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
		$valid->set_rules('status', 'Sumber','required',
				array(	'required' 		=> '%s harus diisi',
						));


		if($valid->run()===FALSE){
			$data = array(	'title' => 'Data Calon Customer',
							'calon'	=> $calon,
							'marketing' => $marketing,
							'provinsi' => $provinsi,
							'market' =>$market,
							'isi' => 'admin/calon/edit' );
			//print_r($pelanggan);
			$this->load->view('admin/layout/wrapper',$data, FALSE);
		}else{
			$i = $this->input;
			$prov = $i->post('prov');
			$kab = $i->post('kab');
			$kec = $i->post('kec');
			if((!empty($prov)) and (!empty($kab)) and (!empty($kec))){
				$data = array(	'id_calon'		=> $id_calon,
								'nama_calon'	=> $i->post('nama_pelanggan'),
								'alamat'			=> $i->post('alamat'),
								'no_hp'				=> $i->post('no_hp'),
								'id_marketing'		=> $i->post('id_marketing'),
								'provinsi'			=> $i->post('prov'),
								'kabupaten'			=> $i->post('kab'),
								'kecamatan'			=> $i->post('kec'),
								'komoditi'			=> $i->post('komoditi'),
								'tanggal_daftar'	=> $this->input->post('tanggal'),
								'keterangan'		=> $i->post('keterangan'),
								'status'			=> $i->post('status')
							);
			}else if(!empty($prov)){
				$data = array(	'id_calon'		=> $id_calon,
								'nama_calon'	=> $i->post('nama_pelanggan'),
								'alamat'			=> $i->post('alamat'),
								'no_hp'				=> $i->post('no_hp'),
								'id_marketing'		=> $i->post('id_marketing'),
								'provinsi'			=> $i->post('prov'),
								'komoditi'			=> $i->post('komoditi'),
								'keterangan'		=> $i->post('keterangan'),
								'tanggal'=> $this->input->post('tanggal_daftar'),
								'status'			=> $i->post('status')
							);
			}else if(!empty($kab)){
				$data = array(	'id_calon'		=> $id_calon,
								'nama_calon'	=> $i->post('nama_pelanggan'),
								'alamat'			=> $i->post('alamat'),
								'no_hp'				=> $i->post('no_hp'),
								'id_marketing'		=> $i->post('id_marketing'),
								'kabupaten'			=> $i->post('kab'),
								'komoditi'			=> $i->post('komoditi'),
								'keterangan'		=> $i->post('keterangan'),
								'tanggal'=> $this->input->post('tanggal_daftar'),
								'status'			=> $i->post('status')
							);
			}else if(!empty($kec)){
				$data = array(	'id_calon'		=> $id_calon,
								'nama_calon'	=> $i->post('nama_pelanggan'),
								'alamat'			=> $i->post('alamat'),
								'no_hp'				=> $i->post('no_hp'),
								'id_marketing'		=> $i->post('id_marketing'),
								'kecamatan'			=> $i->post('kec'),
								'komoditi'			=> $i->post('komoditi'),
								'tanggal'=> $this->input->post('tanggal_daftar'),
								'keterangan'		=> $i->post('keterangan'),
								'status'			=> $i->post('status')
							);
			}else{
				$data = array(	'id_calon'		=> $id_calon,
								'nama_calon'	=> $i->post('nama_pelanggan'),
								'alamat'			=> $i->post('alamat'),
								'no_hp'				=> $i->post('no_hp'),
								'id_marketing'		=> $i->post('id_marketing'),
								'komoditi'			=> $i->post('komoditi'),
								'tanggal'=> $this->input->post('tanggal_daftar'),
								'keterangan'		=> $i->post('keterangan'),
								'status'			=> $i->post('status')
							);
			}
			//print_r($data);
			$this->pelanggan_model->edit_calon($data);
			$this->session->set_flashdata('sukses','Data telah diedit');
			redirect(base_url('admin/pelanggan/calon_customer'), 'refresh');
		}
	}
	public function detail_calon($id_calon){
		$calon = $this->pelanggan_model->calon($id_calon);
		$follow = $this->pelanggan_model->follow_calon($id_calon);
		$total = $this->pelanggan_model->total_follow($id_calon);
		$last_contact = $this->pelanggan_model->last_contact($id_calon);
		$data = array(	'title' => 'Data Calon Customer',
						'calon'	=> $calon,
						'total'	=> $total,
						'follow' => $follow,
						'last_contact' => $last_contact,
						'isi' => 'admin/calon/detail' );
			//print_r($pelanggan);
			$this->load->view('admin/layout/wrapper',$data, FALSE);
	}
	// laporan pelanggan
	public function lap_customer(){
		$id_user = $this->session->userdata('id_user');
		$marketing =  $this->marketing_model->get_marketing($id_user);
		$id_marketing = $marketing->id_marketing;

		$pelanggan =  $this->pelanggan_model->get_allmarketing($id_marketing);
		$calon =  $this->pelanggan_model->listcalon($id_marketing);
		$customer = $this->pelanggan_model->tot_customer($id_marketing);
		$calon_cus = $this->pelanggan_model->calon_cus($id_marketing);

		$data = array(	'title'		=> 'Laporan Data Pelanggan',
						'pelanggan' => $pelanggan,
						'calon'		=> $calon,
						'customer'	=> $customer,
						'calon_cus'	=> $calon_cus,
						'isi'		=> 'admin/customer/lap_customer'
						);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}
	public function report(){
		$id_user = $this->session->userdata('id_user');
		$marketing =  $this->marketing_model->get_marketing($id_user);
		$id_marketing = $marketing->id_marketing;

		$status1 = $this->input->post('status');

		if($status1 == 'Organik'){
			$status = 0;
		}else{
			$status = 1;
		}

		$customer =  $this->pelanggan_model->lap_cus($id_marketing, $status);
		$calon =  $this->pelanggan_model->lap_calon($id_marketing, $status);
		$data = array(	'customer' => $customer->total,
						'calon'		=> $calon->total,
					 );
		echo json_encode($data);
	}
	public function report_tanggal(){
		$awal = $this->input->post('awal');
		$akhir = $this->input->post('akhir');

		$id_user = $this->session->userdata('id_user');
		$marketing =  $this->marketing_model->get_marketing($id_user);
		$id_marketing = $marketing->id_marketing;

		$status1 = $this->input->post('status');

		if($status1 == 'Organik'){
			$status = 0;
		}else{
			$status = 1;
		}
		$data1 = array('status' => $status,
						'awal' => $awal,
						'akhir' => $akhir);

		$customer =  $this->pelanggan_model->tgl_cus($id_marketing, $data1);
		$calon =  $this->pelanggan_model->tgl_calon($id_marketing, $data1);
		$data = array(	'customer' => $customer->total,
						'calon'		=> $calon->total,
					 );
		echo json_encode($data);
	}
	public function report_bulan(){
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');

		$id_user = $this->session->userdata('id_user');
		$marketing =  $this->marketing_model->get_marketing($id_user);
		$id_marketing = $marketing->id_marketing;

		$status1 = $this->input->post('status');

		if($status1 == 'Organik'){
			$status = 0;
		}else{
			$status = 1;
		}
		$data1 = array('status' => $status,
						'bulan' => $bulan,
						'tahun' => $tahun);

		$customer =  $this->pelanggan_model->bln_cus($id_marketing, $data1);
		$calon =  $this->pelanggan_model->bln_calon($id_marketing, $data1);
		$data = array(	'customer' => $customer->total,
						'calon'		=> $calon->total,
					 );
		echo json_encode($data);
	}
	public function report_tahun(){
		$tahun = $this->input->post('tahun');

		$id_user = $this->session->userdata('id_user');
		$marketing =  $this->marketing_model->get_marketing($id_user);
		$id_marketing = $marketing->id_marketing;

		$status1 = $this->input->post('status');

		if($status1 == 'Organik'){
			$status = 0;
		}else{
			$status = 1;
		}
		$data1 = array('status' => $status,
						'tahun' => $tahun);

		$customer =  $this->pelanggan_model->thn_cus($id_marketing, $data1);
		$calon =  $this->pelanggan_model->thn_calon($id_marketing, $data1);
		$data = array(	'customer' => $customer->total,
						'calon'		=> $calon->total,
					 );
		echo json_encode($data);
	}
	public function lap_tanggal(){
		$awal = $this->input->post('tgl_awal');
		$akhir = $this->input->post('tgl_akhir');

		$id_user = $this->session->userdata('id_user');
		$marketing =  $this->marketing_model->get_marketing($id_user);
		$id_marketing = $marketing->id_marketing;

		$pelanggan =  $this->pelanggan_model->get_tanggal($id_marketing,$awal,$akhir);
		$calon =  $this->pelanggan_model->list_tanggal($id_marketing,$awal,$akhir);
		$customer = $this->pelanggan_model->tot_tanggal($id_marketing,$awal,$akhir);
		$calon_cus = $this->pelanggan_model->calon_tanggal($id_marketing,$awal,$akhir);

		$data = array(	'title'		=> 'Laporan Data Pelanggan',
						'pelanggan' => $pelanggan,
						'calon'		=> $calon,
						'customer'	=> $customer,
						'calon_cus'	=> $calon_cus,
						'awal'		=> $awal,
						'akhir'		=> $akhir,
						'isi'		=> 'admin/customer/lap_tanggal'
						);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}
	public function lap_bulan(){
		$tahun = $this->input->post('tahun');
		$bulan = $this->input->post('bulan');

		$id_user = $this->session->userdata('id_user');
		$marketing =  $this->marketing_model->get_marketing($id_user);
		$id_marketing = $marketing->id_marketing;

		$pelanggan =  $this->pelanggan_model->get_bulan($id_marketing,$bulan,$tahun);
		$calon =  $this->pelanggan_model->list_bulan($id_marketing,$bulan,$tahun);
		$customer = $this->pelanggan_model->tot_bulan($id_marketing,$bulan,$tahun);
		$calon_cus = $this->pelanggan_model->calon_bulan($id_marketing,$bulan,$tahun);

		$data = array(	'title'		=> 'Laporan Data Pelanggan',
						'pelanggan' => $pelanggan,
						'calon'		=> $calon,
						'customer'	=> $customer,
						'calon_cus'	=> $calon_cus,
						'bln'		=> $bulan,
						'thn'		=> $tahun,
						'isi'		=> 'admin/customer/lap_bulan'
						);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}
	public function lap_tahun(){
		$tahun = $this->input->post('tahun2');

		$id_user = $this->session->userdata('id_user');
		$marketing =  $this->marketing_model->get_marketing($id_user);
		$id_marketing = $marketing->id_marketing;

		$pelanggan =  $this->pelanggan_model->get_tahun($id_marketing,$tahun);
		$calon =  $this->pelanggan_model->list_tahun($id_marketing,$tahun);
		$customer = $this->pelanggan_model->tot_tahun($id_marketing,$tahun);
		$calon_cus = $this->pelanggan_model->calon_tahun($id_marketing,$tahun);

		$data = array(	'title'		=> 'Laporan Data Pelanggan',
						'pelanggan' => $pelanggan,
						'calon'		=> $calon,
						'customer'	=> $customer,
						'calon_cus'	=> $calon_cus,
						'thn'		=> $tahun,
						'isi'		=> 'admin/customer/lap_tahun'
						);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}
	public function lap_tgl_calon(){
		$awal = $this->input->post('tgl_awal');
		$akhir = $this->input->post('tgl_akhir');

		$id_user = $this->session->userdata('id_user');
		$marketing =  $this->marketing_model->get_marketing($id_user);
		$id_marketing = $marketing->id_marketing;
		$market = $this->pelanggan_model->marketing();

		$calon =  $this->pelanggan_model->calon_tgl($id_marketing,$awal,$akhir);

		$data = array(	'title'		=> 'Laporan Data Pelanggan',
						'calon'		=> $calon,
						'awal'		=> $awal,
						'marketing' => $market,
						'akhir'		=> $akhir,
						'isi'		=> 'admin/calon/list'
						);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}
	public function lap_bln_calon(){
		$tahun = $this->input->post('tahun');
		$bulan = $this->input->post('bulan');

		$id_user = $this->session->userdata('id_user');
		$marketing =  $this->marketing_model->get_marketing($id_user);
		$id_marketing = $marketing->id_marketing;
		$market = $this->pelanggan_model->marketing();

		$calon =  $this->pelanggan_model->calon_bln($id_marketing,$bulan,$tahun);

		$data = array(	'title'		=> 'Laporan Data Pelanggan',
						'calon'		=> $calon,
						'bulan'		=> $bulan,
						'marketing' => $market,
						'tahun'		=> $tahun,
						'isi'		=> 'admin/calon/list'
						);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}
	public function lap_thn_calon(){
		$tahun = $this->input->post('tahun2');

		$id_user = $this->session->userdata('id_user');
		$marketing =  $this->marketing_model->get_marketing($id_user);
		$id_marketing = $marketing->id_marketing;
		$market = $this->pelanggan_model->marketing();
		$calon =  $this->pelanggan_model->calon_thn($id_marketing,$tahun);

		$data = array(	'title'		=> 'Laporan Data Pelanggan',
						'calon'		=> $calon,
						'marketing' => $market,
						'tahun'		=> $tahun,
						'isi'		=> 'admin/calon/list'
						);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}
}