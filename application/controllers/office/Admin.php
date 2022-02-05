<?php 
/**
 * 
 */
//load model
class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		//proteksi halaman
		$this->simple_login->cek_login();
		//$this->simple_login->admin();
		// $this->load->model('wilayah_model');
		// $this->load->model('dashboard_model');
		// $this->load->model('pelanggan_model');
		// $this->load->model('order_model');
		// $this->load->model('produk_model');
		// $this->load->model('marketing_model');
		$this->load->model('user_model');
	}
	public function index(){
		$this->load->view('office/dashboard/admin');
	}
}