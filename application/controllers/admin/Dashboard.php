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
	    $POC1 = $this->dashboard_model->chart('POC');
	    $POC500 = $this->dashboard_model->chart('POC500');
	    $ikan = $this->dashboard_model->chart('NUTRISIIKAN');
	    $ternak = $this->dashboard_model->chart('NUTRISITERNAK');

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
}