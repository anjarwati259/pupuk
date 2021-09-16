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
		$data = array(	'title' => 'Chatting',
						'chat' => 	$chat,
						'isi'	 => 'admin/chat/chat'
						);
		$this->up_chat();
		$this->load->view('admin/chat/tampil_group',$data,FALSE);
	}
	public function tampil_lawan(){
		//$chat = $this->chat_model->chat_group();
		$id = $this->input->post('id');
		$data = array(	'title' => 'Chatting',
						//'chat' => 	$chat,
						'id'	=>$id,
						'isi'	 => 'admin/chat/tampil_lawan'
						);
		$this->load->view('admin/chat/tampil_lawan',$data,FALSE);
	}
	public function add_group(){
		$id_user = $this->session->userdata('id_user');
		$chat = $this->input->post('ketik');
		$data1 = array(
						'chat'			=> $chat,
						'id_user'		=> $id_user,
						);
		$this->chat_model->add_group($data1);
		$this->chat_model->update_chat();
		$this->up_chat();
		require_once(APPPATH.'views/vendor/autoload.php');

		  $options = array(
		    'cluster' => 'ap1',
		    'useTLS' => true
		  );
		  $pusher = new Pusher\Pusher(
		    '195f2f8525152075f786',
		    'd1b3e40e8ec462d83c86',
		    '1263280',
		    $options
		  );

		  $data['message'] = 'chat group';
		  $pusher->trigger('my-channel', 'my-event', $data);
	}
	private function up_chat(){
		$id_user = $this->session->userdata('id_user');
		$chat = $this->chat_model->get_chat($id_user);
		$total = ($chat->total_chat) - ($chat->read_chat);
		$read_chat = ($chat->read_chat)+$total;
		//print($read_chat);
		$data = array(	'id_user' => $id_user,
						'read_chat' => $read_chat);
		$this->chat_model->up_chat($data);
	}
	public function count_group(){
		$id_user = $this->session->userdata('id_user');
		$chat = $this->chat_model->get_chat($id_user);
		echo json_encode($chat);
	}
}