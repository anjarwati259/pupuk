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
		$this->load->model('dashboard_model');
		$this->load->model('order_model');
		$this->load->model('produk_model');
		$this->load->model('pembayaran_model');
		$this->load->model('wilayah_model');
		//load helper random string
		$this->load->helper('string');
		//proteksi halaman
		$this->simple_login->cek_login();
		$this->simple_login->mitra();
	}
	
	public function index()
	{
		$order = $this->dashboard_model->order();
		$data = array(	'title'	=> 'PT AGI - Website Order Produk Kilat',
						'order' => $order,
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
		//cek sudah loggin atau belum, jika belum restrasi sekaligus login
		//kondisi sudah login
		$provinsi = $this->wilayah_model->listing();
		if($this->session->userdata('username')){
			$id_user	= $this->session->userdata('id_user');
			$nama_user 	= $this->session->userdata('nama_user');
			$pelanggan 	= $this->pelanggan_model->sudah_login($id_user, $nama_user);
			$keranjang 	= $this->cart->contents();
			//validation 
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
			//end validation

			$data = array(	'title'	=> 'PT AGI - Website Order Produk Kilat',
						'keranjang' => $keranjang,
						'pelanggan' => $pelanggan,
						'kode_transaksi' => $kode_transaksi,
						'provinsi'	=> $provinsi,
						'isi'		=> 'mitra/keranjang'
						);
			$this->load->view('mitra/layout/wrapper', $data, FALSE);

			//masuk database
			}else{
			$i = $this->input;
			$kode_transaksi = $i->post('kode_transaksi');
			$data = array(	'id_pelanggan'		=> $pelanggan->id_pelanggan,
							'id_user'			=> $id_user,
							'nama_pelanggan'	=> $i->post('nama_pelanggan'),
							'no_hp'				=> $i->post('no_telp'),
							'alamat'			=> $i->post('alamat'),
							'kode_transaksi'	=> $i->post('kode_transaksi'), 
							'tanggal_transaksi'	=> $i->post('tanggal_transaksi'),
							'total_transaksi'	=> $i->post('total_transaksi'),
							'total_item'		=> $i->post('total_item'),
							'provinsi'		=> $i->post('prov'),
							'kabupaten'		=> $i->post('kab'),
							'kecamatan'		=> $i->post('kec'),
							'ongkir'		=> 0,
							'total_bayar'	=> $i->post('total_transaksi'),
							'catatan'		=> $i->post('catatan'),
							'metode_pembayaran'	=> $i->post('payment'),
							'status_bayar'	=> 0,
						);
			$this->order_model->tambah($data);
			//proses masuk ke tabel transaksi
			foreach ($keranjang as $keranjang) {
				$sub_total	= $keranjang['price'] * $keranjang['qty'];
				$qty = $keranjang['jumlah'] * $keranjang['qty'];
				$bonus = $keranjang['bonus'] * $keranjang['qty'];
				//insert data cart
				$data = array();
				if($keranjang['id_produk'] != 'POC'){//jika bukan POC 1 liter
					array_push($data,
					array('id_pelanggan'	=> $pelanggan->id_pelanggan,//cart resmi
						'kode_transaksi'	=> $i->post('kode_transaksi'),
						'id_produk'			=> $keranjang['id_produk'],
						'id_promo'			=> $keranjang['id_promo'],
						'harga'				=> $keranjang['price'],
						'jml_beli'			=> $qty,
						'total_harga'		=> $sub_total,
						'status'			=> $keranjang['option'],
						'tanggal_transaksi'	=> $i->post('tanggal_transaksi')), 
					array('id_pelanggan'	=> $pelanggan->id_pelanggan,//bonus
						'kode_transaksi'	=> $i->post('kode_transaksi'),
						'id_produk'			=> $keranjang['id_produk'],
						'id_promo'			=> $keranjang['id_promo'],
						'harga'				=> 0,
						'jml_beli'			=> $bonus,
						'total_harga'		=> 0,
						'status'			=> $keranjang['option'],
						'tanggal_transaksi'	=> $i->post('tanggal_transaksi'))
				);
				}else{//jika POC 1 liter
					array_push($data,
					array('id_pelanggan'	=> $pelanggan->id_pelanggan,//cart resmi
						'kode_transaksi'	=> $i->post('kode_transaksi'),
						'id_produk'			=> $keranjang['id_produk'],
						'id_promo'			=> $keranjang['id_promo'],
						'harga'				=> $keranjang['price'],
						'jml_beli'			=> $qty,
						'total_harga'		=> $sub_total,
						'status'			=> $keranjang['option'],
						'tanggal_transaksi'	=> $i->post('tanggal_transaksi')), 
					array('id_pelanggan'	=> $pelanggan->id_pelanggan,//bonus
						'kode_transaksi'	=> $i->post('kode_transaksi'),
						'id_produk'			=> 'POC500',
						'id_promo'			=> $keranjang['id_promo'],
						'harga'				=> 0,
						'jml_beli'			=> $bonus,
						'total_harga'		=> 0,
						'status'			=> $keranjang['option'],
						'tanggal_transaksi'	=> $i->post('tanggal_transaksi'))
				);
				}
				
				$this->order_model->tambahorder($data);
				//update stok
				if($i->post('kode_transaksi')){
					$this->_insert_stok_data($i->post('kode_transaksi'),$data,$pelanggan->id_pelanggan);
				}
			}
			//end proses masuk ke tabel transaksi
			//hapus keranjang
			$this->cart->destroy();
			$this->session->set_flashdata('checkout','Checkout berhasil');
			redirect(base_url('mitra/view_cart'));
		}
		//end masuk database
		}else{
			//kalau belum, maka harus registrasi
			$this->session->set_flashdata('sukses','Silahkan Login atau Registrasi Terlebih Dahulu');
			redirect(base_url('registrasi'),'refresh');
		}
	}
	//untuk menyimpan data stok ke database
	private function _insert_stok_data($kode_transaksi,$carts,$id_pelanggan){
		foreach ($carts as $cart) {
			//kurangi stok
			$this->produk_model->update_qty_min($cart['id_produk'],array('stok' => $cart['jml_beli']));

			$id = array($cart['id_produk']);
		 	$sisa =  $this->produk_model->get_stok_id($id);
			//masukkan tabel stok
			$data = array(
				'kode_transaksi' => $kode_transaksi,
				'kode_produk' => $cart['id_produk'],
				'id_pelanggan' => $id_pelanggan,
				'qty' => $cart['jml_beli'],
				'tanggal' => date('Y-m-d'),
				'sisa'	=> $sisa->stok,
				'status' => 'out');
			//tambah stok
			$this->order_model->tambah_stok($data);
			}
	}
	public function sukses(){
		print_r("sukses");
	}
	public function order(){
		$id_user	= $this->session->userdata('id_user');
		$order 			= $this->order_model->listing($id_user);
		$data = array(	'title'	=> 'PT AGI - Website Order Produk Kilat',
						'order' => $order,
						'isi'	=> 'mitra/order'
						);
			$this->load->view('mitra/layout/wrapper', $data, FALSE);
	}
	public function batal($kode_transaksi){
		$get_stok 	= $this->order_model->get_stok($kode_transaksi);
		//update status detail order
		$update = array(
			'kode_transaksi' => $kode_transaksi,
			'status_bayar'	 => 2
		);
		$this->order_model->update_status($update);

		//hapus stok
		$this->order_model->batal($kode_transaksi);
		foreach ($get_stok as $value) {
		//update stok
		$this->produk_model->update_stok($value->id_produk,array('stok' => $value->jml_beli ));
		}
		
		//kalau belum, maka harus registrasi
		$this->session->set_flashdata('sukses','Silahkan Login atau Registrasi Terlebih Dahulu');
		redirect(base_url('mitra/order'),'refresh');
	}
	public function detail($kode_transaksi){
		$detail_order 	= $this->order_model->kode_transaksi($kode_transaksi);
		$transaksi 		= $this->order_model->kode_order($kode_transaksi);
		$bayar 			= $this->pembayaran_model->detail($kode_transaksi);
		$data = array(	'title'	=> 'PT AGI - Website Order Produk Kilat',
						'detail_order' => $detail_order,
						'transaksi'	=> $transaksi,
						'bayar'	=> $bayar,
						'isi'	=> 'mitra/detail'
						);
		$this->load->view('mitra/layout/wrapper', $data, FALSE);
	}
}