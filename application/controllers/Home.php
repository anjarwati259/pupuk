<?php 
/**
 * 
 */
class Home extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('home_model');
		$this->load->model('wilayah_model');
		$this->load->model('order_model');
		$this->load->model('pelanggan_model');
	}
	
	public function index()
	{
		$promo 	= $this->home_model->promo();
		$produk 	= $this->home_model->produk();
		$data = array(	'title'	=> 'PT AGI - Website Order Produk Kilat',
						'promo'	=> $promo,
						'produk'	=> $produk,
						'isi'	=> 'home/list'
						); 
	}
	public function home()
	{
		$promo 	= $this->home_model->promo();
		$produk 	= $this->home_model->produk();
		$data = array(	'title'	=> 'PT AGI - Website Order Produk Kilat',
						'promo'	=> $promo,
						'produk'	=> $produk,
						'isi'	=> 'home/list'
						); 
		$this->load->view('layout/wrapper', $data, FALSE);
	}
	//detail produk
	public function detail($kode_produk){
		$produk 	= $this->home_model->detail_produk($kode_produk);
		$gambar 	= $this->home_model->gambar($kode_produk);  
		$data = array(	'title'	=> 'PT AGI - Website Order Produk Kilat',
						'gambar' => $gambar,
						'produk' => $produk,
						'isi'	=> 'home/detail_produk'
						);
		$this->load->view('layout/wrapper', $data, FALSE);
	}
	//detail promo
	public function detail_promo($id_promo){
		$promo 	= $this->home_model->detail_promo($id_promo);
		$gambar = $this->home_model->gambar_promo($id_promo);  
		$data = array(	'title'	=> 'PT AGI - Website Order Produk Kilat',
						'gambar' => $gambar,
						'promo' => $promo,
						'isi'	=> 'home/detail_promo'
						);
		$this->load->view('layout/wrapper', $data, FALSE);
	}
	//page order
	public function page_order(){
		$data = array(	'title'	=> 'PT AGI - Website Order Produk Kilat',
						'isi'	=> 'home/order'
						);
		$this->load->view('layout/wrapper', $data, FALSE);
	}
	//page kontak
	public function kontak(){
		$data = array(	'title'	=> 'PT AGI - Website Order Produk Kilat',
						'isi'	=> 'home/kontak'
						);
		$this->load->view('layout/wrapper', $data, FALSE);
	}
	//page produk
	public function produk(){
		$promo 	= $this->home_model->promo();
		$produk 	= $this->home_model->produk();
		$data = array(	'title'	=> 'PT AGI - Website Order Produk Kilat',
						'produk' => $produk,
						'promo'	=> $promo,
						'isi'	=> 'home/produk'
						);
		$this->load->view('layout/wrapper', $data, FALSE);
	}
	//page kontak
	public function login(){
		$this->load->view('login/login');
	}
	public function order(){
		$produk 	= $this->home_model->produk();
		$provinsi = $this->wilayah_model->listing();
		$data = array(	'title'	=> 'PT AGI - Website Order Produk Kilat',
						'produk' => $produk,
						'provinsi' => $provinsi,
						);
		$this->load->view('form_order',$data,FALSE);
	}

	public function get_produk(){
		$kode_produk = $this->input->post('id');
		$get_produk  = $this->home_model->get_produk($kode_produk);
		echo json_encode($get_produk);
	}
	public function add_order(){
		$this->form_validation->set_rules('nama', 'nama', 'required');
		$this->form_validation->set_rules('no_hp', 'no_hp', 'required');
		$this->form_validation->set_rules('alamat', 'alamat', 'required');
		$this->form_validation->set_rules('jml', 'jml', 'required');
		$this->form_validation->set_rules('harga', 'harga', 'required');
		$this->form_validation->set_rules('total', 'total', 'required');
		$this->form_validation->set_rules('prov', 'prov', 'required');
		$this->form_validation->set_rules('kab', 'kab', 'required');
		$this->form_validation->set_rules('kec', 'kec', 'required');
		$this->form_validation->set_rules('produk', 'produk', 'required');
		// $this->form_validation->set_rules('metode_bayar', 'metode_bayar', 'required');

		$nama = $this->input->post('nama');
		$no_hp = $this->input->post('no_hp');
		$alamat = $this->input->post('alamat');
		$jml = $this->input->post('jml');
		$harga = $this->input->post('harga');
		$total = $this->input->post('total');
		$prov = $this->input->post('prov');
		$kab = $this->input->post('kab');
		$kec = $this->input->post('kec');
		$produk = $this->input->post('produk');
		$metode_bayar = $this->input->post('metode_bayar');

		//SO
		$id_SO = $this->order_model->get_last_id();
		if($id_SO){
			$id = substr($id_SO[0]->kode_transaksi, 17);
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

		if ($this->form_validation->run() == FALSE) {
			echo json_encode('error');
		}else{
			$cus = array('nama_pelanggan' => $nama,
							'id_pelanggan' => $id_pelanggan,
							'no_hp' => $no_hp,
							'alamat' => $alamat,
							'provinsi' => $prov,
							'kabupaten' => $kab,
							'kecamatan' => $kec,
							'id_marketing' => 'M015',
							'jenis_pelanggan' => 'Customer',
							'tanggal_daftar' => date('Y-m-d H:i:s'),
							'status'	=> 0,
			 );
			$pelanggan = $this->pelanggan_model->tambah($cus);

			$order = array('nama_pelanggan' => $nama,
							'kode_transaksi' => $kode_transaksi,
							'id_pelanggan' 	=> $id_pelanggan,
							'id_user' => '18',
							'no_hp' => $no_hp,
							'alamat' => $alamat,
							'provinsi' => $prov,
							'kabupaten' => $kab,
							'kecamatan' => $kec,
							'id_marketing' => 'M015',
							'total_item' => $jml,
							'total_bayar' =>$total,
							'ongkir'	=>0,
							'metode_pembayaran' => $metode_bayar,
							'tanggal_transaksi' => date('Y-m-d H:i:s'),
							'jenis_order' => '2'
			 );
			$this->order_model->tambah($order);

			$order2 = array('kode_transaksi' => $kode_transaksi,
							'id_pelanggan' 	=> $id_pelanggan,
							'id_produk' => $produk,
							'id_promo' => 0,
							'id_marketing' => 'M015',
							'jml_beli' => $jml,
							'harga' => $harga,
							'total_harga' => $total,
							'potongan'	=>0,
							'total_harga' => $total,
							'tanggal_transaksi' => date('Y-m-d'),
							'status' =>1
			 );
			$this->order_model->tambah_order($order2);
			echo json_encode('sukses');
		}
	}
}