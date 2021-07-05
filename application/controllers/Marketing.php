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
		$this->load->model('wilayah_model');
		//load helper random string
		$this->load->helper('string');
		//proteksi halaman
		$this->simple_login->cek_login();
		$this->simple_login->marketing();
	}
	public function index(){
		$data = array(	'title'	=> 'Dashboad Mitra',
						'isi'	=> 'admin/marketing/dashboard'
						); 
		$this->load->view('admin/layout/wrapper',$data, FALSE);
	}
	public function order(){
		$data = array(	'title'	=> 'Order Marketing',
						'isi'	=> 'admin/marketing/tambah_order'
						);
		$this->load->view('admin/layout/wrapper',$data, FALSE);
	}
}