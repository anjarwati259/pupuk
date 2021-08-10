<?php 
/**
 * 
 */
class Belanja extends CI_Controller
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
		//$this->simple_login->customer();
	}
	//halaman belanja
	public function index()
	{ 
		$keranjang = $this->cart->contents();
		$data = array(	'title'	=> 'PT AGI - Website Order Produk Kilat',
						'keranjang' => $keranjang,
						'isi'	=> 'belanja/detail_belanja'
						); 
		$this->load->view('layout/wrapper', $data, FALSE);
	}
	//tambahkan ke keranjang belanja
	public function add()
	{
		//ambil data dari form
		$id 			= $this->input->post('id');
		$qty 			= $this->input->post('qty');
		$price 			= $this->input->post('price');
		$name 			= $this->input->post('name');
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
	//hapus isi keranjang belanja
	public function hapus($rowid)
	{
		//hapus per item
		$this->cart->remove($rowid);
		$this->session->set_flashdata('sukses','Data keranjang belanja telah dihapus');
		redirect(base_url('belanja'), 'refresh');
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
		redirect(base_url('belanja'), 'refresh');
	}
	//checkout
	public function checkout()
	{
		//cek sudah loggin atau belum, jika belum restrasi sekaligus login
		//membuat kode transaksi
			$id_SO = $this->order_model->get_last_id();
				if($id_SO){
					$id = substr($id_SO[0]->kode_transaksi, 19);
					$kode_transaksi = generate_SO($id);
				}else{
					$kode_transaksi = generate_else();
				}
			//end validation
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
			

			$data = array(	'title'	=> 'PT AGI - Website Order Produk Kilat',
						'keranjang' => $keranjang,
						'pelanggan' => $pelanggan,
						'kode_transaksi' => $kode_transaksi,
						'provinsi'	=> $provinsi,
						'isi'		=> 'belanja/checkout'
						);
			$this->load->view('layout/wrapper', $data, FALSE);

			//masuk database
			}else{
			$i = $this->input;
			$data = array(	'id_pelanggan'		=> $pelanggan->id_pelanggan,
							'id_user'			=> $id_user,
							'nama_pelanggan'	=> $i->post('nama_pelanggan'),
							'no_hp'				=> $i->post('no_telp'),
							'alamat'			=> $i->post('alamat'),
							'kode_transaksi'	=> $kode_transaksi, 
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
				if($keranjang['option']==1){//jika promo
				$qty = $keranjang['jumlah'] * $keranjang['qty'];
				$bonus = $keranjang['bonus'] * $keranjang['qty'];
				//insert data cart
				$data = array();
				if($keranjang['id_produk'] != 'PK001'){//jika bukan POC 1 liter
					array_push($data,
					array('id_pelanggan'	=> $pelanggan->id_pelanggan,//cart resmi
						'kode_transaksi'	=> $kode_transaksi,
						'id_produk'			=> $keranjang['id_produk'],
						'id_promo'			=> $keranjang['id_promo'],
						'harga'				=> $keranjang['price'],
						'jml_beli'			=> $qty,
						'total_harga'		=> $sub_total,
						'status'			=> $keranjang['option'],
						'tanggal_transaksi'	=> $i->post('tanggal_transaksi')), 
					array('id_pelanggan'	=> $pelanggan->id_pelanggan,//bonus
						'kode_transaksi'	=> $kode_transaksi,
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
						'kode_transaksi'	=> $kode_transaksi,
						'id_produk'			=> $keranjang['id_produk'],
						'id_promo'			=> $keranjang['id_promo'],
						'harga'				=> $keranjang['price'],
						'jml_beli'			=> $qty,
						'total_harga'		=> $sub_total,
						'status'			=> $keranjang['option'],
						'tanggal_transaksi'	=> $i->post('tanggal_transaksi')), 
					array('id_pelanggan'	=> $pelanggan->id_pelanggan,//bonus
						'kode_transaksi'	=> $kode_transaksi,
						'id_produk'			=> 'PK002',
						'id_promo'			=> $keranjang['id_promo'],
						'harga'				=> 0,
						'jml_beli'			=> $bonus,
						'total_harga'		=> 0,
						'status'			=> $keranjang['option'],
						'tanggal_transaksi'	=> $i->post('tanggal_transaksi'))
				);
				}
				}else{
					$data = array();
					array_push($data,
						array(	
						'id_pelanggan'	=> $pelanggan->id_pelanggan,
						'kode_transaksi'	=> $kode_transaksi,
						'id_produk'			=> $keranjang['id_produk'],
						'id_promo'			=> $keranjang['id_promo'],
						'harga'				=> $keranjang['price'],
						'jml_beli'			=> $keranjang['qty'],
						'total_harga'		=> $sub_total,
						'status'			=> $keranjang['option'],
						'tanggal_transaksi'	=> $i->post('tanggal_transaksi')
							)
						);
				}
				
				$this->order_model->tambahorder($data);
				//update stok
				if($kode_transaksi){
					$this->_insert_stok_data($kode_transaksi,$data,$pelanggan->id_pelanggan);
				}
			}
			//end proses masuk ke tabel transaksi
			//hapus keranjang
			$this->cart->destroy();
			$this->session->set_flashdata('sukses','Checkout berhasil');
			redirect(base_url('belanja/sukses/'.$kode_transaksi), 'refresh');
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
			}
			$this->order_model->tambah_stok($data);
			//kurangi stok
			$this->produk_model->update_qty_min($cart['id_produk'],array('stok' => $cart['jml_beli']));
	}
	//sukses checkout
	public function sukses($kode_transaksi)
	{
		$transaksi 	= $this->order_model->kode_order($kode_transaksi);
		$detail 	= $this->order_model->kode_transaksi($kode_transaksi);
		$data = array(	'title'		=> 'Belanja Berhasil',
						'transaksi' => $transaksi,
						'detail'	=> $detail,
						'isi'		=> 'belanja/sukses'
						);
		$this->load->view('layout/wrapper', $data, FALSE);
	}
}