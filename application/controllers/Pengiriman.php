<?php 
/**
 * 
 */
class Pengiriman extends CI_Controller
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
		$this->load->model('marketing_model');
		$this->load->model('wilayah_model');
		//load helper random string
		$this->load->helper('string');
		//proteksi halaman
		$this->simple_login->cek_login();
		$this->simple_login->pengiriman();
	}
	public function index(){
		$id_user = $this->session->userdata('id_user');
		$marketing =  $this->marketing_model->get_marketing($id_user);
		$id_marketing = $marketing->id_marketing;

		$tanggal = date('Y-m-d');
	    $order = $this->dashboard_model->order_market($id_marketing);
	    $mitra = $this->dashboard_model->pelanggan_market('Mitra',$id_marketing);
	    $dist = $this->dashboard_model->pelanggan_market('Distributor',$id_marketing);
	    $customer = $this->dashboard_model->pelanggan_market('Customer',$id_marketing);
	    $harian = $this->dashboard_model->harian_market($id_marketing);
	    $mingguan = $this->dashboard_model->mingguan_market($id_marketing);
	    $bulanan = $this->dashboard_model->bulanan_market($id_marketing);
	    $order_baru = $this->dashboard_model->order_baru();
	    $data1 = $this->dashboard_model->hari_market($id_marketing);
	    $POC1 = $this->dashboard_model->chart_market('PK001',$id_marketing);
	    $POC500 = $this->dashboard_model->chart_market('PK002',$id_marketing);
	    $ikan = $this->dashboard_model->chart_market('PK004',$id_marketing);
	    $ternak = $this->dashboard_model->chart_market('PK003',$id_marketing);
		$data = array('title' => 'Pengiriman',
                        'order' => $order,
                        'mitra' => $mitra,
                        'dist' => $dist,
                        'customer' => $customer,
                        'harian'    => $harian,
                        'mingguan'    => $mingguan,
                        'bulanan' => $bulanan,
                        'order_baru' => $order_baru,
                        'hari'  => json_encode($data1),
                        'POC' => $POC1,
                        'POC500' => $POC500,
                        'ikan' => $ikan,
                        'ternak' => $ternak,
                        'isi' => 'admin/marketing/dashboard' );
        $this->load->view('admin/layout/wrapper',$data, FALSE);
	}

	public function data_kirim(){
		$belum_kirim = $this->order_model->data_kirim('');
		$data = array('title' => 'Data Pengiriman',
					  'belum_kirim' => $belum_kirim,
                      'isi' => 'admin/pengiriman/belum_kirim' );
		$this->load->view('admin/layout/wrapper',$data, FALSE);
	}
	public function sudah_dikirim(){
		$sudah_kirim = $this->order_model->sudah_kirim();
		$data = array('title' => 'Data Pengiriman',
					  'sudah_kirim' => $sudah_kirim,
                      'isi' => 'admin/pengiriman/sudah_kirim' );
		$this->load->view('admin/layout/wrapper',$data, FALSE);
	}
}