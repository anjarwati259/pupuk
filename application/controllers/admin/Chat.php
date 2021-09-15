<?php 
/**
 *  
 */
class Chat extends CI_Controller
{
	function __construct()
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
		$this->load->model('chat_model');
		//load helper random string
		$this->load->helper('string');
		//proteksi halaman
		$this->simple_login->cek_login();
		//$this->simple_login->admin();
		//$this->simple_login->markering();
	}

	 
	//halaman data order terbaru atau yg belum bayar
	public function index()
	{ 
		$getmember = $this->dashboard_model->getmember();
		$data = array(	'title' => 'Chatting',
						'member' => $getmember,
						'isi'	 => 'admin/chat/chat'
						);
		$this->load->view('admin/chat/chat',$data,FALSE);
	}
	public function read_group(){
		$chat = $this->chat_model->chat_group();
		//$data['chat'] = $chat->chat;
		echo json_encode($chat);
	}
}