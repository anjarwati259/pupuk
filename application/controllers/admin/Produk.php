<?php 
/**
 * 
 */
//load model
class Produk extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('order_model');
		$this->load->model('pelanggan_model');
		$this->load->model('home_model');
		$this->load->model('produk_model');
		$this->load->model('marketing_model');
		$this->load->model('pembayaran_model');
		$this->load->model('wilayah_model');
		$this->load->model('dashboard_model');
		//load helper random string
		$this->load->helper('string');
		//proteksi halaman
		$this->simple_login->cek_login();
		//$this->simple_login->admin();
		//$this->simple_login->markering();
	}
	public function index(){

	}
	//tampilkan data stok awal dari masing masing produk
	public function stok_awal(){
		$produk = $this->produk_model->produk();
		$data = array(	'title' => 'Data Stok Awal',
						'produk' => $produk,
						'isi' => 'admin/stok/stok_awal' );
		$this->load->view('admin/layout/wrapper',$data, FALSE);
	}
	//tambah stok
	public function tambah_stok()
	{
		$produk = $this->produk_model->produk();
		//validation
		$valid = $this-> form_validation;

		$valid->set_rules('kode_produk', 'Kode Product','required',
				array(	'required' 		=> '%s harus diisi'
						));
		$valid->set_rules('stok', 'Stok Product','required',
				array(	'required' 		=> '%s harus diisi'));

		if($valid->run()===FALSE){
			//end validation
			$data = array(	'title'		=> 'Tambah Data Stok',
							'produk'	=> $produk,
							'isi'		=> 'admin/stok/tambah_stok'
						);
			$this->load->view('admin/layout/wrapper', $data, FALSE);
		}else{
			$i 	= $this->input;
			$kode_produk = $i->post('kode_produk');
			$stok = $i->post('stok');
			$sisa =  $this->produk_model->get_stok_id($kode_produk)->stok;
			$sisa_stok = $sisa + $stok;
			$data = array(	'kode_produk'	=> $kode_produk,
							'qty'	=> $i->post('stok'),
							'sisa' => $sisa_stok,
							'tanggal' => date('Y-m-d'),
							'status' => 'in'
						);
			$this->produk_model->tambah_stok($data);

			$this->produk_model->update_stok($kode_produk,array('stok' => $stok));
			$this->session->set_flashdata('sukses','Data telah ditambah');
			redirect(base_url('admin/order/stok_awal'), 'refresh');
		}
	}
	//tapilkan riwayat stok
	public function stok()
	{ 
		$produk = $this->produk_model->produk();
		$stok 	= $this->produk_model->getstok();
		$data = array(	'title'			=> 'Data Stok',
						'stok'			=> $stok,
						'produk'		=>$produk,
						'isi'			=> 'admin/stok/stok'
						);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}
	public function stok_keluar(){
		$produk = $this->produk_model->produk();
		//validation
		$valid = $this-> form_validation;

		$valid->set_rules('kode_produk', 'Kode Product','required',
				array(	'required' 		=> '%s harus diisi'
						));
		$valid->set_rules('stok', 'Stok Product','required',
				array(	'required' 		=> '%s harus diisi'));
		$valid->set_rules('status', 'Status Product','required',
				array(	'required' 		=> '%s harus diisi'));

		if($valid->run()===FALSE){
			//end validation
			$data = array(	'title'		=> 'Tambah Data Stok',
							'produk'	=> $produk,
							'isi'		=> 'admin/stok/stok_keluar'
						);
			$this->load->view('admin/layout/wrapper', $data, FALSE);
		}else{
			$i 	= $this->input;
			$kode_produk = $i->post('kode_produk');
			$stok = $i->post('stok');
			$sisa =  $this->produk_model->get_stok_id($kode_produk)->stok;
			$sisa_stok = $sisa - $stok;
			$data = array(	'kode_produk'	=> $kode_produk,
							'qty'	=> $i->post('stok'),
							'sisa' => $sisa_stok,
							'tanggal' => date('Y-m-d'),
							'status' => $i->post('status')
						);
			$this->produk_model->tambah_stok($data);

			$this->produk_model->stok_min($kode_produk,array('stok' => $stok));
			$this->session->set_flashdata('sukses','Data telah ditambah');
			redirect(base_url('admin/order/stok_awal'), 'refresh');
		}
	}
}