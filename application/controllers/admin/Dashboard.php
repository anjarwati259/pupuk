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
		$this->simple_login->cek_login();
		$this->simple_login->admin();
		$this->load->model('wilayah_model');
		$this->load->model('dashboard_model');
		$this->load->model('pelanggan_model');
		$this->load->model('order_model');
	}
	public function index(){
		$tanggal = date('Y-m-d');
	    $order = $this->dashboard_model->order_admin();
	    $mitra = $this->dashboard_model->pelanggan('Mitra');
	    $dist = $this->dashboard_model->pelanggan('Distributor');
	    $customer = $this->dashboard_model->pelanggan('Customer');
	    $stok = $this->dashboard_model->stok();
	    $harian = $this->dashboard_model->harian();
	    $mingguan = $this->dashboard_model->mingguan();
	    $bulanan = $this->dashboard_model->bulanan();
	    $order_baru = $this->dashboard_model->order_baru();
	    $data = $this->dashboard_model->hari();
	    $POC1 = $this->dashboard_model->chart('PK001');
	    $POC500 = $this->dashboard_model->chart('PK002');
	    $ikan = $this->dashboard_model->chart('PK004');
	    $ternak = $this->dashboard_model->chart('PK003');

		$data = array('title' => 'Admin',
                        'order' => $order,
                        'mitra' => $mitra,
                        'dist' => $dist,
                        'customer' => $customer,
                        'stok'    => $stok,
                        'harian'    => $harian,
                        'mingguan'    => $mingguan,
                        'bulanan' => $bulanan,
                        'order_baru' => $order_baru,
                        'hari'  => json_encode($data),
                        'POC' => $POC1,
                        'POC500' => $POC500,
                        'ikan' => $ikan,
                        'ternak' => $ternak,
                        'isi' => 'admin/dashboard/list' );
        $this->load->view('admin/layout/wrapper',$data, FALSE);
	}
	//reward
	public function reward(){
		$reward = $this->order_model->reward();
		//print_r($reward);
		$data = array('title' => 'Data Reward',
						'reward' => $reward,
                        'isi' => 'admin/dashboard/reward' );
        $this->load->view('admin/layout/wrapper',$data, FALSE);
	}
	public function detail_reward($id_pelanggan){
		 $point = $this->order_model->detailreward($id_pelanggan);
		 $pelanggan = $this->pelanggan_model->get_pelanggan($id_pelanggan);
		 $getpoint = $this->order_model->last_point($id_pelanggan);
		 //get last
		 $reward = $this->dashboard_model->reward();
		 $total = $this->dashboard_model->get_total($id_pelanggan);
		 //print_r($reward);
		 $data = array(	'title' => 'Data Reward',
		 				'pelanggan' => $pelanggan,
		 				'point' => $point,
		 				'reward'=> $reward,
		 				'get_point' => $getpoint,
		 				'total'	=> $total,
                       	'isi' => 'admin/dashboard/detail_reward' );
         $this->load->view('admin/layout/wrapper',$data, FALSE);
	}
	public function pencairan_reward(){
		//data pencairan reward
		$data_pencairan = $this->dashboard_model->list_pencairan_reward();
		$data = array(	'title' => 'Data Pencairan Reward',
		 				'pencairan_reward' => $data_pencairan,
                       	'isi' => 'admin/dashboard/pencairan_reward');
         $this->load->view('admin/layout/wrapper',$data, FALSE);
	}
	public function konfir_reward($id_pencairan_reward){
		$data = array(	'id_pencairan_reward'	=> $id_pencairan_reward,
						'status'				=> 1
						);

		$this->dashboard_model->status_reward($data);
        $this->session->set_flashdata('sukses','Status Telah Diubah');
		redirect(base_url('admin/dashboard/pencairan_reward'), 'refresh');
	}
	public function get_notif(){
		$tot = $this->dashboard_model->total_order();
		//$order = $this->dashboard_model->data_notif();
		$result['total'] = $tot->total;
		//$result['data'] = $order;
		echo json_encode($result);
	}
	public function data_notif(){
		$order = $this->dashboard_model->data_notif();
		$result['data_notif'] = $order;
		echo json_encode($result);
	}
	public function status_baca($kode_transaksi){
		$data = array(	'kode_transaksi' => $kode_transaksi,
						'status_baca'	 => 1
						);
		$this->order_model->status_baca($data);
		redirect(base_url('admin/order'), 'refresh');
	}
	public function profil(){
		$id_user = $this->session->userdata('id_user');
		$marketing = $this->dashboard_model->user_market($id_user);
		$user = $this->user_model->user('id_user');
		$data = array(	'title' => 'Profil',
						'user'	=> $user,
						'marketing' => $marketing,
						'isi'	 => 'admin/dashboard/profil'
						);
		$this->load->view('admin/layout/wrapper',$data, FALSE);
	}
	public function change_password(){
		$valid = $this-> form_validation;
		$this->form_validation->set_rules('pass_lama', "Password Lama", 'required|trim');
		$this->form_validation->set_rules('pass_baru', "Password Baru", 'required|trim|min_length[3]|matches[rep_pass]');
		$this->form_validation->set_rules('rep_pass', "Password Lama", 'required|trim|min_length[3]|matches[pass_baru]');
		if($this->form_validation->run() == false){
			$this->session->set_flashdata('error','data Kosong');
			redirect(base_url('admin/dashbord/profil'), 'refresh');
		} else{
		}
		
	}
}