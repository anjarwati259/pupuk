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
	//page kontak
	public function login(){
		$this->load->view('login/login');
	}
}