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
		$this->load->model('datatable_model');
		$this->load->model('marketing_model');
		$this->load->model('user_model');
	}
	public function index(){
		$data = array('title' => 'Dashboard Admin',
                        'isi' => 'office/dashboard/admin' );
        $this->load->view('office/layout/wrapper',$data, FALSE);
        //$this->load->view('office/dashboard/admin');
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
		$data = array(	'title' => 'Data Customer',
						'jenis' =>$jenis,
						'pelanggan' => $pelanggan,
						'jenis' => $jenis,
						'id_pelanggan' => $id_pelanggan,
						'marketing' => $marketing,
						'prov' => $provinsi,
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
			//echo json_encode($data);
			$this->admin_model->tambah($data);
			echo json_encode('sukses');
		}
	}
	// menampilkan detail pelanggan saat edit
	public function detail_pelanggan(){
		$id_pelanggan 	= $this->input->post('id_pelanggan');
		$pelanggan = $this->admin_model->get_pelanggan($id_pelanggan);
		$prov = $this->wilayah_model->getprov($pelanggan->provinsi);
		$kab = $this->wilayah_model->getkab($pelanggan->kabupaten);
		$kec = $this->wilayah_model->getkec($pelanggan->kecamatan);

		$data['pelanggan'] = $pelanggan;
		$data['prov'] = $prov;
		$data['kab'] = $kab;
		$data['kec'] = $kec;

		echo json_encode($data);
	}
	public function edit_pelanggan(){
		$this->form_validation->set_rules('nama_pelanggan', 'nama_pelanggan', 'required');
		$this->form_validation->set_rules('no_hp', 'no_hp', 'required');
		$this->form_validation->set_rules('alamat', 'alamat', 'required');
		$this->form_validation->set_rules('id_marketing', 'id_marketing', 'required');
		$this->form_validation->set_rules('jenis_pelanggan', 'jenis_pelanggan', 'required');
		$this->form_validation->set_rules('status', 'status', 'required');
		$this->form_validation->set_rules('provinsi', 'provinsi', 'required');
		$this->form_validation->set_rules('kabupaten', 'kabupaten', 'required');
		$this->form_validation->set_rules('kecamatan', 'kecamatan', 'required');

		if ($this->form_validation->run() == FALSE) {
			echo json_encode('error');
		}else{
			$i 	= $this->input;
			$data = array(	'id_pelanggan'		=> $i->post('id'),
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
			// echo json_encode($data);
			$this->admin_model->edit($data);
			echo json_encode('sukses');
		}
	}
	// ========================== calon pelanggan ================================
	public function calon(){
		$provinsi = $this->wilayah_model->listing();
		$marketing = $this->marketing_model->marketing();

		$pelanggan_id = $this->admin_model->get_last_id();
		if($pelanggan_id){
			$id = substr($pelanggan_id[0]->id_pelanggan, 1);
			$id_pelanggan = generate_code('P', $id);
		}else{
			$id_pelanggan = 'P001';
		}

		$data = array('title' => 'Calon Customer',
						'id_calon' => $id_pelanggan,
						'prov' => $provinsi,
						'marketing' => $marketing,
						'jenis' =>'',
                        'isi' => 'office/admin/calon_pelanggan' );
        $this->load->view('office/layout/wrapper',$data, FALSE);
	}
	public function add_calon(){
		$this->form_validation->set_rules('nama_calon', 'nama_calon', 'required');
		$this->form_validation->set_rules('no_hp', 'no_hp', 'required');
		$this->form_validation->set_rules('alamat', 'alamat', 'required');
		$this->form_validation->set_rules('id_marketing', 'id_marketing', 'required');
		$this->form_validation->set_rules('komoditi', 'komoditi', 'required');
		$this->form_validation->set_rules('keterangan', 'keterangan', 'required');
		$this->form_validation->set_rules('status', 'status', 'required');
		$this->form_validation->set_rules('provinsi', 'provinsi', 'required');
		$this->form_validation->set_rules('kabupaten', 'kabupaten', 'required');
		$this->form_validation->set_rules('kecamatan', 'kecamatan', 'required');

		$pelanggan_id = $this->admin_model->get_last_id();

		//last id pelanggan
		if($pelanggan_id){
			$id = substr($pelanggan_id[0]->id_pelanggan, 1);
			$id_pelanggan = generate_code('P', $id);
		}else{
			$id_pelanggan = 'P001';
		}

		if ($this->form_validation->run() == FALSE) {
			echo json_encode('error');
		}else{
			$i 	= $this->input;
			$data = array(	'id_calon'		=> $id_pelanggan,
							'nama_calon'	=> $i->post('nama_calon'),
							'id_marketing'		=> $i->post('id_marketing'),
							'alamat'			=> $i->post('alamat'),
							'no_hp'				=> $i->post('no_hp'),
							'status'			=> $i->post('status'),
							'tanggal'			=> $i->post('tanggal'),
							'komoditi'			=> $i->post('komoditi'),
							'keterangan'		=> $i->post('keterangan'),
							'provinsi'			=> $i->post('provinsi'),
							'kabupaten'			=> $i->post('kabupaten'),
							'kecamatan'			=> $i->post('kecamatan')
						);
			// echo json_encode($data);
			$this->admin_model->tambah_calon($data);
			echo json_encode('sukses');
		}
	}
	public function detail_calon(){
		$id_calon 	= $this->input->post('id_calon');
		$pelanggan = $this->admin_model->get_calon($id_calon);
		$prov = $this->wilayah_model->getprov($pelanggan->provinsi);
		$kab = $this->wilayah_model->getkab($pelanggan->kabupaten);
		$kec = $this->wilayah_model->getkec($pelanggan->kecamatan);

		$data['pelanggan'] = $pelanggan;
		$data['prov'] = $prov;
		$data['kab'] = $kab;
		$data['kec'] = $kec;

		echo json_encode($data);
	}
	public function edit_calon(){
		$this->form_validation->set_rules('nama_calon', 'nama_calon', 'required');
		$this->form_validation->set_rules('no_hp', 'no_hp', 'required');
		$this->form_validation->set_rules('alamat', 'alamat', 'required');
		$this->form_validation->set_rules('id_marketing', 'id_marketing', 'required');
		$this->form_validation->set_rules('komoditi', 'komoditi', 'required');
		$this->form_validation->set_rules('keterangan', 'keterangan', 'required');
		$this->form_validation->set_rules('status', 'status', 'required');
		$this->form_validation->set_rules('provinsi', 'provinsi', 'required');
		$this->form_validation->set_rules('kabupaten', 'kabupaten', 'required');
		$this->form_validation->set_rules('kecamatan', 'kecamatan', 'required');

		if ($this->form_validation->run() == FALSE) {
			echo json_encode('error');
		}else{
			$i 	= $this->input;
			$data = array(	'id_calon'		=> $i->post('id_calon'),
							'nama_calon'	=> $i->post('nama_calon'),
							'id_marketing'		=> $i->post('id_marketing'),
							'alamat'			=> $i->post('alamat'),
							'no_hp'				=> $i->post('no_hp'),
							'status'			=> $i->post('status'),
							'tanggal'			=> $i->post('tanggal'),
							'komoditi'			=> $i->post('komoditi'),
							'keterangan'		=> $i->post('keterangan'),
							'provinsi'			=> $i->post('provinsi'),
							'kabupaten'			=> $i->post('kabupaten'),
							'kecamatan'			=> $i->post('kecamatan')
						);
			// echo json_encode($data);
			$this->admin_model->edit_calon($data);
			echo json_encode('sukses');
		}
	}
	public function del_calon($id){
		$this->admin_model->del_calon($id);
		$this->session->set_flashdata('sukses', 'Data telah dihapus');
		redirect(base_url('office/admin/calon'), 'refresh');
	}

	// ==================================== ekspedisi =======================
	public function ekspedisi(){
		$ekspedisi = $this->admin_model->ekspedisi();
		$data = array('title' => 'Ekspedisi',
						'jenis' =>'',
						'ekspedisi' =>$ekspedisi, 
                        'isi' => 'office/admin/data_ekspedisi' );
        $this->load->view('office/layout/wrapper',$data, FALSE);
	}

}