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
		$id = $this->input->post('id');
		$marketing = $this->chat_model->get_marketing($id);
		$data = array(	'title' => 'Chatting',
						'id'	=>$id,
						'marketing' => $marketing,
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
	public function read_chat(){
		$lawan = $this->input->post('id');
		$id_user = $this->session->userdata('id_user');
		$chat = $this->chat_model->chat_user($lawan,$id_user);
		$data = array(	'title' => 'Chatting',
						'chat' => 	$chat,
						'isi'	 => 'admin/chat/chat'
						);
		$this->up_userchat($lawan,$id_user);
		$this->load->view('admin/chat/tampil_user',$data,FALSE);
	}

	private function up_userchat($lawan,$id_user){
		$chat = $this->chat_model->get_chatuser($lawan,$id_user);
		$total = ($chat->total) - ($chat->read);
		$read_chat = ($chat->read)+$total;
		$data = array(	'user1' => $id_user,
						'user2' => $lawan,
						'read' => $read_chat);
		$this->chat_model->up_userchat($data);
	}
	public function add_chat(){
		$id_user = $this->session->userdata('id_user');
		$chat = $this->input->post('ketik');
		$lawan = $this->input->post('lawan');
		$data1 = array(
						'chat'			=> $chat,
						'dari'			=> $id_user,
						'ke'			=> $lawan,
						);
		$this->chat_model->add_chat($data1);
		$this->chat_model->update_chatuser($lawan,$id_user);
		$this->up_userchat($lawan,$id_user);
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
	public function count_user(){
		$id_user = $this->session->userdata('id_user');
		$chat = $this->chat_model->count_user($id_user);
		echo json_encode($chat);
	}
}