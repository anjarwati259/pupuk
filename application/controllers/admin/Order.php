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
		$this->load->model('pembayaran_model');
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
		$id_promo = $this->input->post('id_promo');
		$quantity = $this->input->post('quantity');
		$sale_price = $this->input->post('sale_price');
		$id_bonus= $this->input->post('id_bonus');
		$bonus = $this->input->post('bonus');
		$status = $this->input->post('status');

		$get_product_detail =  $this->produk_model->detail_by_id($id_produk);
		$get_bonus_detail =  $this->produk_model->detail_by_id($id_bonus);
		if($id_produk=='POC'){
			if($get_product_detail){
				$data = array(
					array(
					'id'      => $id_produk,
					'id_promo' => $id_promo,
					'qty'     => $quantity,
					'price'   => $sale_price,
					'status' => $status,
					'name'    => $get_product_detail[0]['nama_produk'],
					'options'  => array('id'=>'POC500', 'qty' => $bonus)
				),
					array(
					'id'      => 'POC500',
					'id_promo' => $id_promo,
					'status' => $status,
					'qty'     => $bonus,
					'price'   => 0,
					'name'    => 'Pupuk Kilat 500ml'
				)
				); 
				$this->cart->insert($data);
				echo json_encode(array('status' => 'ok',
								'data' => $this->cart->contents() ,
								'total_item' => $this->cart->total_items(),
								'total_price' => $this->cart->total(),
							)
					);
			}else{
				echo json_encode(array('status' => 'error'));
			}
		}else{
			if($get_product_detail){
				$data = array(
					array(
					'id'      => $id_produk,
					'id_promo' => $id_promo,
					'qty'     => $quantity,
					'price'   => $sale_price,
					'status' => $status,
					'name'    => $get_product_detail[0]['nama_produk'],
					'options'  => array('id'=>'POC500', 'qty' => $bonus)
				),
					array(
					'id'      => $id_produk,
					'id_promo' => $id_promo,
					'status' => $status,
					'qty'     => $bonus,
					'price'   => 0,
					'name'    => $get_product_detail[0]['nama_produk']
				)
				); 
				$this->cart->insert($data);
				echo json_encode(array('status' => 'ok',
								'data' => $this->cart->contents() ,
								'total_item' => $this->cart->total_items(),
								'total_price' => $this->cart->total(),
							)
					);
			}else{
				echo json_encode(array('status' => 'error'));
			}
		}

	}
	//untuk delete shopping cart admin
	public function delete_item($rowid){
		if($this->cart->remove($rowid)) {
			echo number_format($this->cart->total());
		}else{
			echo "false";
		}
	}
	//untuk menyimpan data checkout
	public function add_process(){
		$this->form_validation->set_rules('kode_transaksi', 'kode_transaksi', 'required');
		$this->form_validation->set_rules('nama_pelanggan', 'nama_pelanggan', 'required');
		$this->form_validation->set_rules('alamat', 'alamat', 'required');
		$this->form_validation->set_rules('provinsi', 'provinsi', 'required');
		$this->form_validation->set_rules('kabupaten', 'kabupaten', 'required');
		$this->form_validation->set_rules('kecamatan', 'kecamatan', 'required');
		$this->form_validation->set_rules('no_hp', 'no_hp', 'required');
		$this->form_validation->set_rules('ekspedisi', 'ekspedisi', 'required');
		$this->form_validation->set_rules('ongkir', 'ongkir', 'required');

		$carts =  $this->cart->contents();
		if($this->_check_qty($carts)){
			echo json_encode(array('status' => 'limit'));
			exit;
		}

		$user = $this->session->userdata('id_user');
		//grand total
		$subtotal = $this->cart->total();
		$ongkir = $this->input->post('ongkir');

		//cek id pelanggan


		if(!empty($carts) && is_array($carts) && $ongkir != null){
			$total_bayar = $subtotal + $ongkir;
			$id_pelanggan = $this->input->post('id_pelanggan');
			$komoditi = $this->input->post('komoditi');
			$no_hp = $this->input->post('no_hp');

			$data['kode_transaksi'] = $this->input->post('kode_transaksi');
			//$data['id_pelanggan'] = $id_pelanggan;
			$data['id_user'] = $user;
			$data['nama_pelanggan'] = $this->input->post('nama_pelanggan');
			$data['alamat'] = $this->input->post('alamat');
			$data['provinsi'] = $this->input->post('provinsi');
			$data['kabupaten'] = $this->input->post('kabupaten');
			$data['kecamatan'] = $this->input->post('kecamatan');
			$data['expedisi'] = $this->input->post('ekspedisi');
			$data['ongkir'] = $ongkir;
			$data['no_hp'] = $this->input->post('no_hp');
			$data['total_bayar'] = $total_bayar;
			$data['total_transaksi'] = $this->cart->total();
			$data['status_bayar'] = '0';
			$data['tanggal_transaksi'] = $this->input->post('tanggal_transaksi');
			$data['total_item'] = $this->cart->total_items();
			$data['metode_pembayaran'] = $this->input->post('metode_pembayaran');

			$code = $this->input->post('code');
			 if($code==1 || $id_pelanggan==null){
			 	$id_pelanggan = $this->_insert_pelanggan($data['nama_pelanggan'],$data['alamat'],$data['kecamatan'],$data['kabupaten'], $data['provinsi'], $data['tanggal_transaksi'],$data['total_item'],$komoditi,$no_hp);

			 	$data['id_pelanggan'] = $id_pelanggan;

			 	$this->order_model->tambah($data);
			 }else{
			 	$data['id_pelanggan'] = $this->input->post('id_pelanggan');
			 	$this->order_model->tambah($data);
			 }
			 
			if($data['kode_transaksi']){
				$this->_insert_purchase_data($data['kode_transaksi'],$carts,$id_pelanggan,$data['tanggal_transaksi']);
				$this->_insert_stok_data($data['kode_transaksi'],$carts,$id_pelanggan);
			}
			//disini

			echo json_encode(array('status' => 'ok'));
		}else{
			echo json_encode(array('status' => 'error'));
		}
	}
	//untuk menyimpan data belanja ke database
	private function _insert_purchase_data($kode_transaksi,$carts,$id_pelanggan, $tanggal_transaksi){
		foreach($carts as $key => $cart){
			$purchase_data = array(
				'kode_transaksi' => $kode_transaksi,
				'id_produk' => $cart['id'],
				'id_pelanggan' => $id_pelanggan,
				'id_promo'	=> $cart['id_promo'],
				'status'	=> $cart['status'],
				'jml_beli' => $cart['qty'],
				'harga' => $cart['price'],
				'total_harga' => $cart['subtotal'],
				'tanggal_transaksi' => $tanggal_transaksi
			);
			$this->order_model->tambah_order($purchase_data);
			
			//$this->produk_model->update_qty_min($cart['id'],array('stok' => $cart['qty']));
		}
		$this->cart->destroy();
	}
	private function _insert_stok_data($kode_transaksi,$carts,$id_pelanggan){
		
		foreach($carts as $key => $cart){
			$id = array($cart['id']);
			$sisa =  $this->produk_model->get_stok_id($id);
			$stok = array(
				'kode_transaksi' => $kode_transaksi,
				'kode_produk' => $cart['id'],
				'id_pelanggan' => $id_pelanggan,
				'qty' => $cart['qty'],
				'tanggal' => date('Y-m-d'),
				'sisa'	=> $sisa->stok,
				'status' => 'out'
			);
			$this->order_model->tambah_stok($stok);
			
			$this->produk_model->update_qty_min($cart['id'],array('stok' => $cart['qty']));
		}
		$this->cart->destroy();
	}
	//cek stok masih ada atau sudah habis
	private function _check_qty($carts){
		$status = false;
		foreach($carts as $key => $cart){
			$product = $this->produk_model->get_by_id($cart['id']);
			if($cart['qty'] >= $product[0]['stok']){
				$status = true;
				break;
			}
		}
		return $status;
	}
	//untuk mengambil data pelanggan berdasarkan nama
	public function get_nama(){
		if (isset($_GET['term'])) {
            $result = $this->order_model->getnama($_GET['term']);
            if (count($result) > 0) {
            foreach ($result as $row)
                $arr_result[] = array(
                	'label' => $row->nama_pelanggan,
                	'id' => $row->id_pelanggan,
                	'alamat' => $row->alamat,
                	'kecamatan' => $row->kecamatan,
                	'kabupaten' => $row->kabupaten,
                	'provinsi'	=> $row->provinsi,
                	'komoditi' => $row->komoditi,
                	'no_hp'	=> $row->no_hp,
                );
                echo json_encode($arr_result);
            }
        }
	}

	//detail 
	public function detail($kode_transaksi)
	{
		//ambil data login id_distributor dari session
		$detail_order 	= $this->order_model->kode_transaksi($kode_transaksi);
		$transaksi 		= $this->order_model->kode_order($kode_transaksi);
		$bayar 			= $this->pembayaran_model->detail($kode_transaksi);

		$data = array(	'title'				=> 'Order #' . $kode_transaksi,
						'detail_order'		=> $detail_order,
						'bayar'				=> $bayar,
						'transaksi'			=> $transaksi,
						'isi'				=> 'admin/order/detail_order'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}
	//tambah no resi 
	public function resi($kode_transaksi)
	{
		$valid = $this-> form_validation;

		$valid->set_rules('no_resi', 'No Resi','required',
				array(	'required' 		=> '%s harus diisi'
						));
		if($valid->run()===FALSE){
			$this->session->set_flashdata('sukses','No resi belum diisi');
			redirect(base_url('admin/order/sudah_bayar'), 'refresh');
		}else{
			
			$data = array(	'kode_transaksi'	=> $kode_transaksi,
							'no_resi'			=> $this->input->post('no_resi'),
						);
			$this->order_model->update_status($data);
			$this->session->set_flashdata('sukses','Resi Telah ditambah');
			redirect(base_url('admin/order/detail/'.$kode_transaksi), 'refresh');
		}
	}
	public function cod($kode_transaksi)
	{
			$data = array(	'kode_transaksi'	=> $kode_transaksi,
							'no_resi'			=> $this->input->post('no_resi'),
							'status_bayar'		=> 1
						);
			$this->order_model->update_status($data);
			$this->session->set_flashdata('sukses','Status Telah Diubah');
			//redirect(base_url('admin/order/sudah_bayar'), 'refresh');

			//insert pembayaran
		$data = array(	'kode_transaksi'	=> $kode_transaksi,
						'nama_bank'			=> '-',
						'id_rekening'		=> 0,
						'tanggal_bayar'		=> $this->input->post('tanggal_bayar'),
						'jumlah_bayar'		=> $this->input->post('total_bayar')
						);
		$this->pembayaran_model->bayar($data);
		$this->session->set_flashdata('sukses','Status Telah Diubah');
		redirect(base_url('admin/order/sudah_bayar'), 'refresh');
	}
}