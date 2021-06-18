<?php 
/**
 * 
 */
//load model
class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		//proteksi halaman
		//$this->simple_login->cek_login();
		$this->load->model('wilayah_model');
	}
	public function index(){
		$data = array('title' => 'Admin',
						//'harian' => $harian,
						'isi' => 'admin/dashboard/list' );
		$this->load->view('admin/layout/wrapper',$data, FALSE);
	}
}