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
		$this->load->model('wilayah_model');
		// $this->load->model('dashboard_model');
		$this->load->model('admin_model');
		// $this->load->model('order_model');
		// $this->load->model('produk_model');
		$this->load->model('marketing_model');
		$this->load->model('user_model');
	}
	public function index(){
		$data = array('title' => 'Dashboard Admin',
                        'isi' => 'office/dashboard/admin' );
        $this->load->view('office/layout/wrapper',$data, FALSE);
	}
	public function pelanggan($jenis_pelanggan){
		$jenis = $jenis_pelanggan;
		$pelanggan = $this->admin_model->pelanggan($jenis);
		$marketing = $this->marketing_model->marketing();
		$pelanggan_id = $this->admin_model->get_last_id();
		$provinsi = $this->wilayah_model->listing();

		//last id pelanggan
		if($pelanggan_id){
			$id = substr($pelanggan_id[0]->id_pelanggan, 1);
			$id_pelanggan = generate_code('C', $id);
		}else{
			$id_pelanggan = 'C001';
		}
		$data = array(	'title' => 'Dashboard Admin',
						'pelanggan' => $pelanggan,
						'jenis' => $jenis,
						'id_pelanggan' => $id_pelanggan,
						'marketing' => $marketing,
						'provinsi' => $provinsi,
                        'isi' => 'office/admin/data_pelanggan' );
        $this->load->view('office/layout/wrapper',$data, FALSE);
	}
	public function add_pelanggan(){
		$this->form_validation->set_rules('nama_pelanggan', 'nama_pelanggan', 'required');
		$this->form_validation->set_rules('no_hp', 'no_hp', 'required');
		$this->form_validation->set_rules('alamat', 'alamat', 'required');
		$this->form_validation->set_rules('id_marketing', 'id_marketing', 'required');
		$this->form_validation->set_rules('jenis_pelanggan', 'jenis_pelanggan', 'required');
		$this->form_validation->set_rules('status', 'status', 'required');
		$this->form_validation->set_rules('provinsi', 'provinsi', 'required');
		$this->form_validation->set_rules('kabupaten', 'kabupaten', 'required');
		$this->form_validation->set_rules('kecamatan', 'kecamatan', 'required');

		$pelanggan_id = $this->admin_model->get_last_id();

		//last id pelanggan
		if($pelanggan_id){
			$id = substr($pelanggan_id[0]->id_pelanggan, 1);
			$id_pelanggan = generate_code('C', $id);
		}else{
			$id_pelanggan = 'C001';
		}

		if ($this->form_validation->run() == FALSE) {
			echo json_encode('error');
		}else{
			$i 	= $this->input;
			$data = array(	'id_pelanggan'		=> $id_pelanggan,
							'nama_pelanggan'	=> $i->post('nama_pelanggan'),
							'id_marketing'		=> $i->post('id_marketing'),
							'alamat'			=> $i->post('alamat'),
							'no_hp'				=> $i->post('no_hp'),
							'status'			=> $i->post('status'),
							'tanggal_daftar'	=> date("Y-m-d"),
							'provinsi'			=> $i->post('provinsi'),
							'kabupaten'			=> $i->post('kabupaten'),
							'kecamatan'			=> $i->post('kecamatan'),
							'jenis_pelanggan'	=> $i->post('jenis_pelanggan')
						);
			$this->admin_model->tambah($data);
			echo json_encode('sukses');
		}
	}
}