<?php 
/**
 *  
 */
class Order extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('order_model');
		$this->load->model('pelanggan_model');
		$this->load->model('home_model');
		$this->load->model('produk_model');
		//load helper random string
		$this->load->helper('string');
		//proteksi halaman
		//$this->simple_login->cek_login();
	}
	//halaman data order terbaru atau yg belum bayar
	public function index()
	{ 
		$order 	= $this->order_model->listing_admin(0);
		$data = array(	'title'			=> 'Data Pesanan',
						'order'			=> $order,
						'konfirmasi'	=> $order,
						'isi'			=> 'admin/order/list'
						);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}
	//konfirmasi pesanan jika sudah bayar
	public function konfirmasi($kode_transaksi){

		$data = array(	'kode_transaksi'	=> $kode_transaksi,
						'id_rekening'		=> $this->input->post('id_rekening'),
						'ongkir'		=> $this->input->post('ongkir'),
						'total_bayar'		=> $this->input->post('total_bayar'),
						'status_bayar'		=> 1
						);
		$this->order_model->update_status($data);

		//insert pembayaran
		$data = array(	'kode_transaksi'	=> $kode_transaksi,
						'nama_bank'			=> $this->input->post('nama_bank'),
						'id_rekening'		=> $this->input->post('id_rekening'),
						'tanggal_bayar'		=> $this->input->post('tanggal_bayar'),
						'jumlah_bayar'		=> $this->input->post('total_bayar')
						);
		$this->order_model->bayar($data);
		$this->session->set_flashdata('sukses','Status Telah Diubah');
		redirect(base_url('admin/order/sudah_bayar'), 'refresh');
	}
	//menampilkan data order yang sudah dikonfirmasi/sudah bayar
	public function sudah_bayar()
	{ 
		$order 	= $this->order_model->Alllisting();
		$sudah_bayar 	= $this->order_model->listing_admin(1);
		$data = array(	'title'			=> 'Data Pesanan',
						'sudah_bayar'	=> $sudah_bayar,
						'order'			=> $order,
						'isi'			=> 'admin/order/sudah_bayar'
						);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}
	//menampilkan form tambah order
	public function tambah_order()
	{
		//kode invoice 

		$id = $this->order_model->get_last_id();
		if($id){
			$id = $id[0]->kode_transaksi;
			$kode_transaksi = generate_code('INV0',$id);
		}else{
			$kode_transaksi = 'INV0001';
		}
		// destry cart
		$this->cart->destroy();

		$pelanggan 	= $this->pelanggan_model->alllisting();
		$produk 	= $this->home_model->produk();
		$promo 		= $this->home_model->promo();
		
		$data = array(	'title'				=> 'Tambah Order',
						'kode_transaksi'	=> $kode_transaksi,
						'pelanggan'			=> $pelanggan,
						'produk'			=> $produk,
						'promo'				=> $promo,
						'isi'				=> 'admin/order/tambah_order'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}
	//untuk check produk berdasarkan kode produk
	public function check_product($kode_produk){
		$produk = $this->produk_model->get_by_produk($kode_produk);
		echo json_encode($produk); 
	}
	//untuk check produk berdasarkan kode promo
	public function get_promo(){
		$id = $this->input->post('id');

		$promo = $this->produk_model->get_promo($id);
		echo json_encode($promo);
		
	}
	//untuk tambah produk belanja di cart
	public function add_item(){
		$id_produk = $this->input->post('id_produk');
		$quantity = $this->input->post('quantity');
		$sale_price = $this->input->post('sale_price');
		$id_bonus= $this->input->post('id_bonus');
		$bonus = $this->input->post('bonus');

		$get_product_detail =  $this->produk_model->detail_by_id($id_produk);
		$get_bonus_detail =  $this->produk_model->detail_by_id($id_bonus);
		if($get_product_detail){
			$data = array(
				array(
				'id'      => $id_produk,
				'qty'     => $quantity,
				'price'   => $sale_price,
				'name'    => $get_product_detail[0]['nama_produk'],
				'options'  => array('id'=>'POC500', 'qty' => $bonus)
			),
			// array(
			// 	'id'      => 'POC500',
			// 	'qty'     => $bonus,
			// 	'price'   => 0,
			// 	'name'    => 'Bonus Pupuk Kilat 500ml'
			// )
			);
			$this->cart->insert($data);
			echo json_encode(array('status' => 'ok',
							'data' => $this->cart->contents() ,
							'total_item' => $this->cart->total_items(),
							'total_price' => $this->cart->total()
						)
				);
		}else{
			echo json_encode(array('status' => 'error'));
		}

	}
}