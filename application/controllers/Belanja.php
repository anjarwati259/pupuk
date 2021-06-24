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
		$this->load->model('wilayah_model');
		//load helper random string
		$this->load->helper('string');
		//proteksi halaman
		//$this->simple_login->cek_login();
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
						'gambar'=> $gambar,
						'option' => $option,
						'options'  => array('ket'=>'promo')
					),
						array(
						'id'      => $id_produk,
						'id_produk' => $id_produk,
						'id_promo' => $id_promo,
						'jumlah'	=> $qty,
						'option' => $option,
						'qty'     => $bonus,
						'price'   => 0,
						'name'    => $name,
						'gambar'=> $gambar,
					)
				);
		$this->cart->insert($data);
		//print_r($data);
		//redirect page
		redirect($redirect_page,'refresh');
	}
	//hapus isi keranjang belanja
	public function hapus($rowid='')
	{
		
		if($rowid){
			//hapus per item
			$this->cart->remove($rowid);
			$this->session->set_flashdata('sukses','Data keranjang belanja telah dihapus');
			redirect(base_url('belanja'), 'refresh');
		}else{
			//hapus all
			$this->cart->destroy();
			$this->session->set_flashdata('sukses','Data keranjang belanja telah dihapus');
			redirect(base_url('belanja'), 'refresh');
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
		redirect(base_url('belanja'), 'refresh');
	}
	//checkout
	public function checkout()
	{
		//cek sudah loggin atau belum, jika belum restrasi sekaligus login
		//kondisi sudah login
		$provinsi = $this->wilayah_model->listing();
		if($this->session->userdata('username')){
			$id_user				= $this->session->userdata('id_user');
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
						'isi'		=> 'belanja/checkout'
						);
			$this->load->view('layout/wrapper', $data, FALSE);
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
				if($keranjang['option']==1){
				$qty = $keranjang['jumlah'] * $keranjang['qty'];
					$data = array(	
						'id_pelanggan'	=> $pelanggan->id_pelanggan,
						'kode_transaksi'	=> $i->post('kode_transaksi'),
						'id_produk'			=> $keranjang['id_produk'],
						'id_promo'			=> $keranjang['id_promo'],
						'harga'				=> $keranjang['price'],
						'jml_beli'			=> $qty,
						'total_harga'		=> $sub_total,
						'status'			=> $keranjang['option'],
						'tanggal_transaksi'	=> $i->post('tanggal_transaksi')
						);
				}else{
					$data = array(	
						'id_pelanggan'	=> $pelanggan->id_pelanggan,
						'kode_transaksi'	=> $i->post('kode_transaksi'),
						'id_produk'			=> $keranjang['id_produk'],
						'id_promo'			=> $keranjang['id_promo'],
						'harga'				=> $keranjang['price'],
						'jml_beli'			=> $keranjang['qty'],
						'total_harga'		=> $sub_total,
						'status'			=> $keranjang['option'],
						'tanggal_transaksi'	=> $i->post('tanggal_transaksi')
						);
				}
				
				$this->order_model->tambah_order($data);
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