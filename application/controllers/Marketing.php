<?php 
/**
 * 
 */
class Marketing extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('home_model');
		$this->load->model('pelanggan_model');
		$this->load->model('dashboard_model');
		$this->load->model('order_model');
		$this->load->model('produk_model');
		$this->load->model('pembayaran_model');
		$this->load->model('marketing_model');
		$this->load->model('wilayah_model');
		//load helper random string
		$this->load->helper('string');
		//proteksi halaman
		$this->simple_login->cek_login();
		$this->simple_login->marketing();
	}
	public function index(){
		$id_user = $this->session->userdata('id_user');
		$marketing =  $this->marketing_model->get_marketing($id_user);
		$id_marketing = $marketing->id_marketing;

		$tanggal = date('Y-m-d');
	    $order = $this->dashboard_model->order_market($id_marketing);
	    $mitra = $this->dashboard_model->pelanggan_market('Mitra',$id_marketing);
	    $dist = $this->dashboard_model->pelanggan('Distributor',$id_marketing);
	    $customer = $this->dashboard_model->pelanggan('Customer',$id_marketing);
	    $harian = $this->dashboard_model->harian_market($id_marketing);
	    $mingguan = $this->dashboard_model->mingguan_market($id_marketing);
	    $bulanan = $this->dashboard_model->bulanan_market($id_marketing);
	    $order_baru = $this->dashboard_model->order_baru();
	    $data1 = $this->dashboard_model->hari_market($id_marketing);
	    $POC1 = $this->dashboard_model->chart_market('PK001',$id_marketing);
	    $POC500 = $this->dashboard_model->chart_market('PK002',$id_marketing);
	    $ikan = $this->dashboard_model->chart_market('PK004',$id_marketing);
	    $ternak = $this->dashboard_model->chart_market('PK003',$id_marketing);
		$data = array('title' => 'Admin',
                        'order' => $order,
                        'mitra' => $mitra,
                        'dist' => $dist,
                        'customer' => $customer,
                        'harian'    => $harian,
                        'mingguan'    => $mingguan,
                        'bulanan' => $bulanan,
                        'order_baru' => $order_baru,
                        'hari'  => json_encode($data1),
                        'POC' => $POC1,
                        'POC500' => $POC500,
                        'ikan' => $ikan,
                        'ternak' => $ternak,
                        'isi' => 'admin/marketing/dashboard' );
        $this->load->view('admin/layout/wrapper',$data, FALSE);
	}
	public function order(){
		//last id pelanggan
		$id_SO = $this->order_model->get_last_id();
		if($id_SO){
			$id = substr($id_SO[0]->kode_transaksi, 19);
			$kode_transaksi = generate_SO($id);
		}else{
			$kode_transaksi = generate_else();
		}

		//last id pelanggan
		$pelanggan_id = $this->pelanggan_model->get_last_id();
		if($pelanggan_id){
			$id = substr($pelanggan_id[0]->id_pelanggan, 1);
			$id_pelanggan = generate_code('C', $id);
		}else{
			$id_pelanggan = 'C001';
		}
		// destry cart
		$this->cart->destroy();

		$id_user 	= $this->session->userdata('id_user');
		$marketing 	=  $this->marketing_model->get_marketing($id_user);
		$produk 	= $this->home_model->produk();
		$promo 		= $this->home_model->promo();
		$expedisi 	=  $this->order_model->expedisi();
		//get provinsi
		$provinsi = $this->wilayah_model->listing();

		$data = array(	'title'	=> 'Order Marketing',
						'kode_transaksi' => $kode_transaksi,
						'marketing'		=> $marketing,
						'produk'		=> $produk,
						'expedisi'		=> $expedisi,
						'promo'			=> $promo,
						'provinsi'		=> $provinsi,
						'id_pelanggan'	=> $id_pelanggan,
						'isi'	=> 'admin/marketing/tambah_order'
						);
		$this->load->view('admin/layout/wrapper',$data, FALSE);
	}
	//tambah data pelanggan
	public function add_pelanggan()
	{
		//get provinsi
		$provinsi = $this->wilayah_model->listing();
		//validation
		$valid = $this-> form_validation;

		$valid->set_rules('namapelanggan', 'Nama Pelanggan','required',
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
				$id_pelanggan = generate_code('ID20220',$id);
			}else{
				$id_pelanggan = 'ID202201';
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
							'nama_pelanggan'	=> $i->post('namapelanggan'),
							'alamat'			=> $i->post('alamat'),
							'id_marketing'			=> $i->post('id_marketing'),
							'no_hp'				=> $i->post('no_hp'),
							'komoditi'			=> $i->post('komoditi'),
							'tanggal_daftar'	=> date('Y-m-d'),
							'provinsi'			=> $i->post('prov'),
							'kabupaten'			=> $i->post('kab'),
							'kecamatan'			=> $i->post('kec'),
							'jenis_pelanggan'	=> $i->post('jenis_pelanggan')
						);
			$this->pelanggan_model->tambah($data);
			$this->session->set_flashdata('sukses','Data telah ditambah');
			redirect(base_url('marketing/order'), 'refresh');
		}
	}
	public function belum_bayar(){
		$id_user = $this->session->userdata('id_user');
		$marketing =  $this->marketing_model->get_marketing($id_user);
		$id_marketing = $marketing->id_marketing;
		$order 	= $this->order_model->list_belum($id_marketing,0);
		$data = array(	'title'	=> 'Data Order',
						'order'	=> $order,
						'isi'	=> 'admin/marketing/belum_bayar'
						);
		$this->load->view('admin/layout/wrapper',$data, FALSE);
	}
	//konfirmasi pesanan jika sudah bayar
	public function konfirmasi($kode_transaksi){
		//mengambil jenis pelanggan
		$pelanggan = $this->order_model->jenis_pelanggan($kode_transaksi);
		$stok = $this->order_model->get_stok($kode_transaksi);
		//konfirmasi status bayar
		$data = array(	'kode_transaksi'	=> $kode_transaksi,
						'id_rekening'		=> $this->input->post('id_rekening'),
						'ongkir'			=> $this->input->post('ongkir'),
						'total_bayar'		=> $this->input->post('total_bayar'),
						'no_resi'		=> $this->input->post('no_resi'),
						'expedisi'		=> $this->input->post('expedisi'),
						'status_bayar'		=> 1
						);
		$this->order_model->update_status($data);
		//insert pembayaran
		$data = array(	'kode_transaksi'	=> $kode_transaksi,
						'nama_bank'			=> $this->input->post('nama_bank'),
						'id_rekening'		=> $this->input->post('id_rekening'),
						'tanggal_bayar'		=> $this->input->post('tanggal_bayar'),
						'jumlah_bayar'		=> $this->input->post('total_bayar')
						);
		$this->order_model->bayar($data);
		
		//insert point
		if($pelanggan->jenis_pelanggan=='Mitra'){
			$this->point($kode_transaksi);
		}
		//konfirmasi stok
		foreach ($stok as $value) {
			$data = array(	'kode_transaksi' => $value->kode_transaksi,
							'status'		 => 'out'
						);
			$this->produk_model->update($data);
		}
		$this->session->set_flashdata('sukses','Status Telah Diubah');
		redirect(base_url('marketing/sudah_bayar'), 'refresh');
	}
	public function sudah_bayar(){
		$id_user = $this->session->userdata('id_user');
		$marketing =  $this->marketing_model->get_marketing($id_user);
		$id_marketing = $marketing->id_marketing;
		$order 	= $this->order_model->list_belum($id_marketing,1);
		$data = array(	'title'	=> 'Data Order',
						'sudah_bayar'	=> $order,
						'isi'	=> 'admin/marketing/sudah_bayar'
						);
		$this->load->view('admin/layout/wrapper',$data, FALSE);
	}
	public function semua_order(){
		$id_user = $this->session->userdata('id_user');
		$marketing =  $this->marketing_model->get_marketing($id_user);
		$id_marketing = $marketing->id_marketing;
		$order 	= $this->order_model->all_list($id_marketing);
		$data = array(	'title'	=> 'Data Order',
						'sudah_bayar'	=> $order,
						'isi'	=> 'admin/marketing/semua_order'
						);
		$this->load->view('admin/layout/wrapper',$data, FALSE);
	}
}