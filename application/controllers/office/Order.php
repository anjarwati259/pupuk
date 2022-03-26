<?php 
/**
 * 
 */
//load model
class Order extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		//proteksi halaman
		$this->simple_login->cek_login();
		//$this->simple_login->admin();
		$this->load->model('wilayah_model');
		// $this->load->model('dashboard_model');
		$this->load->model('admin_model');
		// $this->load->model('order_model');
		$this->load->model('datatable_model');
		$this->load->model('marketing_model');
		$this->load->model('user_model');
	}
	public function index(){
		$data = array('title' => 'Data Order',
                        'isi' => 'office/admin/data_order' );
        $this->load->view('office/layout/wrapper',$data, FALSE);
	}
}