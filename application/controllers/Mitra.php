<?php 
/**
 * 
 */
class Mitra extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('home_model');
		$this->load->model('pelanggan_model');
		$this->load->model('order_model');
		$this->load->model('produk_model');
		$this->load->model('wilayah_model');
		//load helper random string
		$this->load->helper('string');
		//proteksi halaman
		$this->simple_login->cek_login();
		$this->simple_login->mitra();
	}
	
	public function index()
	{
		$data = array(	'title'	=> 'PT AGI - Website Order Produk Kilat',
						'isi'	=> 'mitra/dashboard'
						); 
		$this->load->view('mitra/layout/wrapper',$data, FALSE);
	}
	public function belanja()
	{
		$data = array(	'title'	=> 'PT AGI - Website Order Produk Kilat',
						'isi'	=> 'mitra/belanja'
						);
		$this->load->view('mitra/layout/wrapper',$data, FALSE);
	}
	//tambahkan ke keranjang belanja
	public function add()
	{
		//ambil data dari form
		$id 			= $this->input->post('id');
		$qty 			= $this->input->post('qty');
		$price 			= $this->input->post('price');
		$name 			= $this->input->post('name');
		$nama 			= $this->input->post('nama');
		$id_promo 		= $this->input->post('id_promo');
		$id_produk		= $this->input->post('id_produk');
		$option 		= $this->input->post('option');//1 promo, 2 non promo
		$jumlah 		= $this->input->post('jumlah');
		$bonus 			= $this->input->post('bonus');
		$gambar 		= $this->input->post('gambar');
		$redirect_page 	= $this->input->post('redirect_page');
		//proses memasukkan ke keranjang belanja
			$data = array(
						array(
						'id'	=> $id,
						'qty'	=> $qty,
						'price'	=> $price,
						'name'	=> $name,
						'nama'	=> $nama,
						'id_promo' => $id_promo,
						'id_produk' => $id_produk,
						'jumlah'	=> $jumlah,
						'bonus'		=> $bonus,
						'gambar'=> $gambar,
						'option' => $option
					),
				);
		$this->cart->insert($data);
		//print_r($data);
		//redirect page
		redirect($redirect_page,'refresh');
	}

	//view cart
	public function view_cart()
	{
		if($this->session->userdata('username')){
			$id_user	= $this->session->userdata('id_user');
			$nama_user 	= $this->session->userdata('nama_user');
			$pelanggan 	= $this->pelanggan_model->sudah_login($id_user, $nama_user);
			$provinsi = $this->wilayah_model->listing();

			$keranjang = $this->cart->contents();
			$valid = $this-> form_validation;
 
		$valid->set_rules('nama_pelanggan', 'Nama Lengkap','required',
				array(	'required' 		=> '%s harus diisi'));

		$valid->set_rules('no_telp', 'Nomor Telephon','required',
				array(	'required' 		=> '%s harus diisi'));

		$valid->set_rules('alamat', 'Alamat','required',
				array(	'required' 		=> '%s harus diisi'));
		$valid->set_rules('provinsi', 'Provinsi','required',
				array(	'required' 		=> '%s harus diisi'));
		$valid->set_rules('kabupaten', 'Kabupaten','required',
				array(	'required' 		=> '%s harus diisi'));
		$valid->set_rules('kecamatan', 'Kecamatan','required',
				array(	'required' 		=> '%s harus diisi'));
		$valid->set_rules('payment', 'Metode Pembayaran','required',
				array(	'required' 		=> '%s harus diisi'));

		if($valid->run()===FALSE){
			//membuat kode transaksi
			$id = $this->order_model->get_last_id();
				if($id){
					$id = $id[0]->kode_transaksi;
					$kode_transaksi = generate_code('INV0',$id);
				}else{
					$kode_transaksi = 'INV0001';
				}

			$data = array(	'title'	=> 'PT AGI - Website Order Produk Kilat',
							'keranjang' => $keranjang,
							'pelanggan' => $pelanggan,
							'kode_transaksi' => $kode_transaksi,
							'provinsi'	=> $provinsi,
							'isi'	=> 'mitra/keranjang'
							);
			$this->load->view('mitra/layout/wrapper',$data, FALSE);
		}
			
		}
	}
	//update cart
	public function update_cart()
	{	
		$i = 1;
		foreach ($this->cart->contents() as $items) {
			$data = array(	'rowid' => $items['rowid'],
							'qty'	=> $this->input->post($i . '[qty]')
			 );
			$this->cart->update($data);
			$i++;
		}
		redirect(base_url('mitra/view_cart'), 'refresh');
	}
	//update cart
	public function checkout(){
		print_r("sukses");
	}
}