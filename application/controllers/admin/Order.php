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
		$this->load->model('marketing_model');
		$this->load->model('pembayaran_model');
		$this->load->model('wilayah_model');
		$this->load->model('dashboard_model');
		//load helper random string
		$this->load->helper('string');
		//proteksi halaman
		$this->simple_login->cek_login();
		//$this->simple_login->admin();
		//$this->simple_login->markering();
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
	public function cash($kode_transaksi){
		$data = array(	'kode_transaksi'	=> $kode_transaksi,
						'status_bayar'		=> 1,
						'status_baca'		=> 1
						);
			$this->order_model->update_status($data);
			$this->session->set_flashdata('sukses','Status Telah Diubah');
			if($this->session->userdata('hak_akses')=='1'){
		redirect(base_url('admin/order/sudah_bayar'), 'refresh');
		}else{
			redirect(base_url('marketing/sudah_bayar'), 'refresh');
		}
	}
	//konfirmasi COD
	public function cod($kode_transaksi)
	{
		$pelanggan = $this->order_model->jenis_pelanggan($kode_transaksi);
		$stok = $this->order_model->get_stok($kode_transaksi);
			$data = array(	'kode_transaksi'	=> $kode_transaksi,
							'no_resi'			=> $this->input->post('no_resi'),
							'status_bayar'		=> 1,
							'status_baca'		=> 1
						);
			$this->order_model->update_status($data);
			$this->session->set_flashdata('sukses','Status Telah Diubah');
			//redirect(base_url('admin/order/sudah_bayar'), 'refresh');
			$bayar = (int)str_replace('.', '', $this->input->post('total_bayar'));
			//insert pembayaran
		$data = array(	'kode_transaksi'	=> $kode_transaksi,
						'nama_bank'			=> '-',
						'id_rekening'		=> 0,
						'tanggal_bayar'		=> $this->input->post('tanggal_bayar'),
						'jumlah_bayar'		=> $bayar
						);
		$this->pembayaran_model->bayar($data);
		//insert point
		if($pelanggan->jenis_pelanggan=='Mitra'){
			$this->point($kode_transaksi);
		}
		
		//konfirmasi stok
		foreach ($stok as $value) {
			$data = array(	'kode_transaksi' => $value->kode_transaksi,
							'status'		 => 'out'
						);
			$this->produk_model->update($data);
		}

		$this->session->set_flashdata('sukses','Status Telah Diubah');
		if($this->session->userdata('hak_akses')=='1'){
		redirect(base_url('admin/order/sudah_bayar'), 'refresh');
		}else{
			redirect(base_url('marketing/sudah_bayar'), 'refresh');
		}
	}
	//konfirmasi pesanan jika sudah bayar
	public function konfirmasi($kode_transaksi){
		//mengambil jenis pelanggan
		$pelanggan = $this->order_model->jenis_pelanggan($kode_transaksi);
		$stok = $this->order_model->get_stok($kode_transaksi);
		$bayar = (int)str_replace('.', '', $this->input->post('total_bayar'));
		//konfirmasi status bayar
		$data = array(	'kode_transaksi'	=> $kode_transaksi,
						'id_rekening'		=> $this->input->post('id_rekening'),
						'ongkir'			=> $this->input->post('ongkir'),
						'total_bayar'		=> $bayar,
						'no_resi'		=> $this->input->post('no_resi'),
						'expedisi'		=> $this->input->post('expedisi'),
						'no_resi'		=> $this->input->post('no_resi'),
						'status_bayar'		=> 1,
						'status_baca'		=> 1
						);
		$this->order_model->update_status($data);
		//insert pembayaran
		$data = array(	'kode_transaksi'	=> $kode_transaksi,
						'nama_bank'			=> $this->input->post('nama_bank'),
						'id_rekening'		=> $this->input->post('id_rekening'),
						'tanggal_bayar'		=> $this->input->post('tanggal_bayar'),
						'jumlah_bayar'		=> $bayar
						);
		$this->order_model->bayar($data);
		
		//insert point
		if($pelanggan->jenis_pelanggan=='Mitra'){
			$this->point($kode_transaksi);
		}

		//konfirmasi stok
		foreach ($stok as $value) {
			$data = array(	'kode_transaksi' => $value->kode_transaksi,
							'status'		 => 'out'
						);
			$this->produk_model->update($data);
		}
		$this->session->set_flashdata('sukses','Status Telah Diubah');
		if($this->session->userdata('hak_akses')=='1'){
		redirect(base_url('admin/order/sudah_bayar'), 'refresh');
		}else{
			redirect(base_url('marketing/sudah_bayar'), 'refresh');
		}
	}
	//penghitungan point
	private function point($kode_transaksi){
		$order 	= $this->order_model->point_list($kode_transaksi);
		$POC = 0;
		$nonPOC = 0;
		$pointtotal =0;
		foreach ($order as $value) {
			//get total point
			$last_point = $this->order_model->last_point($value->id_pelanggan);
			if(isset($last_point)){
				$total_point = $last_point->total_point;
			}else{
				$total_point = 0;
			}
			if($value->jenis_pelanggan == 'Mitra' && $value->id_produk!='PK001'){
				$point = (($value->jml_beli/2) * 1);
				$nonPOC = $nonPOC + $point;
				$pointtotal = $nonPOC + $total_point;
			}else if($value->jenis_pelanggan == 'Mitra' && $value->id_produk=='PK001'){
				$point = ($value->jml_beli * 1);
				$POC = $POC + $point;
				$pointtotal = $POC + $total_point;
			}
		}
		//cek total point berdasarkan kode mitra
		$total = $nonPOC + $POC;

			$data = array('kode_transaksi'	=> $kode_transaksi,
							'id_pelanggan'	=> $value->id_pelanggan,
							'point'			=> $total,
							'status'		=> 'in',
							'total_point'	=> $pointtotal,
							'tanggal'		=> date('Y-m-d')		
			);
		$this->order_model->tambah_point($data);
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
	//data order customer
	public function customer(){
		$order 	= $this->order_model->allorder('Customer');
		$data = array(	'title'		=> 'Data Pesanan',
						'order'		=> $order,
						'isi'		=> 'admin/order/order_customer'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}
	//data order Mitra
	public function mitra(){
		$order 	= $this->order_model->allorder('Mitra');
		$data = array(	'title'		=> 'Data Pesanan',
						'order'		=> $order,
						'isi'		=> 'admin/order/order_mitra'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}
	//menampilkan form tambah order
	public function tambah_order()
	{ 
		//last id pelanggan
		$id_SO = $this->order_model->get_last_id();
		if($id_SO){
			$id = substr($id_SO[0]->kode_transaksi, 20);
			$kode_transaksi = generate_SO($id);
		}else{
			$kode_transaksi = generate_else();
		}
		//print_r($id_SO);
		//last id pelanggan
		$pelanggan_id = $this->pelanggan_model->get_last_id();
		if($pelanggan_id){
			$id = substr($pelanggan_id[0]->id_pelanggan, 1);
			$id_pelanggan = generate_code('C', $id);
		}else{
			$id_pelanggan = 'C001';
		}
		// destry cart
		$this->cart->destroy();
		$id_user = $this->session->userdata('id_user');
		$marketing =  $this->pelanggan_model->marketing();
		$expedisi =  $this->order_model->expedisi();
		//get provinsi
		$provinsi = $this->wilayah_model->listing();

		$pelanggan 	= $this->pelanggan_model->alllisting();
		$produk 	= $this->home_model->produk();
		$promo 		= $this->home_model->promo();
		$mitra 		= $this->home_model->mitra();
		$data = array(	'title'				=> 'Tambah Order',
						'kode_transaksi'	=> $kode_transaksi,
						'pelanggan'			=> $pelanggan,
						'marketing'			=> $marketing,
						'produk'			=> $produk,
						'expedisi'			=> $expedisi,
						'provinsi'			=> $provinsi,
						'promo'				=> $promo,
						'mitra'				=> $mitra,
						'id_pelanggan'		=> $id_pelanggan,
						'isi'				=> 'admin/order/tambah_order'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}
	//edit order
	public function edit($kode_transaksi){
		$detail_order =  $this->order_model->kode_transaksi($kode_transaksi);
		$order =  $this->order_model->kode_order($kode_transaksi);
		$marketing =  $this->pelanggan_model->marketing();
		$expedisi =  $this->order_model->expedisi();
		$produk =  $this->produk_model->produk();
		$provinsi = $this->wilayah_model->listing();
		

		$data = array(	'title'				=> 'Order #' . $kode_transaksi,
						'marketing'			=> $marketing,
						'detail'			=> $detail_order,
						'expedisi'			=> $expedisi,
						'order'				=> $order,
						'produk'			=> $produk,
						'provinsi'			=> $provinsi,
						'kode_transaksi' 	=> $kode_transaksi,
						'isi'				=> 'admin/order/edit_order'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	public function edit2($kode_transaksi){
		$i = $this->input;

		$data = array( 'kode_transaksi' => $kode_transaksi,
						'id_marketing' => $i->post('id_marketing'),
						'jenis_order' => $i->post('jenis_order'),
						'expedisi' => $i->post('ekspedisi'),
						'ongkir' => $i->post('ongkir'),
						'total_bayar' => $i->post('total_bayar'),
						'total_transaksi' => $i->post('subtotal'),
						'total_item' => $i->post('total_item'),
						'metode_pembayaran' => $i->post('metode_pembayaran')
		);
		$this->order_model->edit_detail($data);

		$kode_produk = $i->post('kode_produk');
		$jml_beli = $i->post('jumlah');
		$harga = $i->post('harga');
		$potongan = $i->post('potongan');
		$total = $i->post('total');
		$id_order = $i->post('id_order');
		$index = 0;
		$data2 = array();
		//$data = array
		foreach ($kode_produk as $key) {
			$data2[] = array( 'id_order' => $id_order[$index],
							'id_produk' => $key,
							'id_marketing' => $i->post('id_marketing'),
							'kode_transaksi' => $kode_transaksi,
							'jml_beli' => $jml_beli[$index],
							'potongan' => $potongan[$index],
							'total_transaksi' => $total[$index]
			 );
			$index++;
			
		}
		//print_r($data2);
		$this->order_model->edit_order($data2);
		redirect(base_url('admin/order/detail/'.$kode_transaksi), 'refresh');
	}

	public function edit_penerima($kode_transaksi){
		$i = $this->input;
		$prov = $i->post('prov');
		$kab = $i->post('kab');
		$kec = $i->post('kec');
		if((!empty($prov)) and (!empty($kab)) and (!empty($kec))){
		$data = array( 'kode_transaksi' => $kode_transaksi,
						'nama_pelanggan' => $i->post('nama_pelanggan'),
						'no_hp' => $i->post('no_hp'),
						'alamat' => $i->post('alamat'),
						'kecamatan' => $i->post('kec'),
						'provinsi' => $i->post('prov'),
						'kabupaten' => $i->post('kab')
		);
	}else if(!empty($prov)){
		$data = array( 'kode_transaksi' => $kode_transaksi,
						'nama_pelanggan' => $i->post('nama_pelanggan'),
						'no_hp' => $i->post('no_hp'),
						'alamat' => $i->post('alamat'),
						'provinsi' => $i->post('prov')
		);
	}else if(!empty($kab)){
		$data = array( 'kode_transaksi' => $kode_transaksi,
						'nama_pelanggan' => $i->post('nama_pelanggan'),
						'no_hp' => $i->post('no_hp'),
						'alamat' => $i->post('alamat'),
						'kabupaten' => $i->post('kab')
		);
	}else if(!empty($kec)){
		$data = array( 'kode_transaksi' => $kode_transaksi,
						'nama_pelanggan' => $i->post('nama_pelanggan'),
						'no_hp' => $i->post('no_hp'),
						'alamat' => $i->post('alamat'),
						'kecamatan' => $i->post('kec')
		);
	}else{
		$data = array( 'kode_transaksi' => $kode_transaksi,
						'nama_pelanggan' => $i->post('nama_pelanggan'),
						'no_hp' => $i->post('no_hp'),
						'alamat' => $i->post('alamat')
		);
	}
		print_r($data);
		$this->order_model->edit_detail($data);
		redirect(base_url('admin/order/detail/'.$kode_transaksi), 'refresh');
	}

	public function hapus($kode_transaksi){
		//1. stok
		$this->order_model->delete_stok($kode_transaksi);
		//2. order
		$this->order_model->delete_order($kode_transaksi);
		//3. detail order
		$this->order_model->delete_detail($kode_transaksi);
		redirect(base_url('admin/order'), 'refresh');
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
	//untuk mengambil data promo mitra
	public function get_mitra(){
		$id = $this->input->post('id');

		$promo = $this->produk_model->get_mitra($id);
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
		$potongan = $this->input->post('potongan');

		$get_product_detail =  $this->produk_model->detail_by_id($id_produk);
		$get_bonus_detail =  $this->produk_model->detail_by_id($id_bonus);
		if($id_produk=='PK001'){
			if($get_product_detail){
				$data = array(
					array(
					'id'      => $id_produk,
					'id_promo' => $id_promo,
					'qty'     => $quantity,
					'price'   => $sale_price,
					'potongan' => $potongan,
					'status'  => $status,
					'name'    => $get_product_detail[0]['nama_produk'],
					'options'  => array('id'=>'PK001', 'qty' => $bonus)
				),
					array(
					'id'      => 'PK002',
					'id_promo' => $id_promo,
					'status' => $status,
					'qty'     => $bonus,
					'price'   => 0,
					'potongan' => 0,
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
					'potongan' => $potongan,
					'status' => $status,
					'name'    => $get_product_detail[0]['nama_produk'],
					'options'  => array('id'=>'PK001', 'qty' => $bonus)
				),
					array(
					'id'      => $id_produk,
					'id_promo' => $id_promo,
					'status' => $status,
					'potongan' => 0,
					'qty'     => $bonus,
					'price'   => 0,
					'name'    => $get_product_detail[0]['nama_produk']
				)
				);
				$this->cart->insert($data);
				$data_cart = $this->cart->contents();
				$tot_pot = 0;
				foreach ($data_cart as $data_cart) {
					$tot_pot += $data_cart['potongan'];
				}
				echo json_encode(array('status' => 'ok',
								'data' => $this->cart->contents(),
								'total_item' => $this->cart->total_items(),
								'total_potongan' => $tot_pot,
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
		// $this->form_validation->set_rules('kode_transaksi', 'kode_transaksi', 'required');
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

		//SO
		$id_SO = $this->order_model->get_last_id();
		if($id_SO){
			$id = substr($id_SO[0]->kode_transaksi, 20);
			$kode_transaksi = generate_SO($id);
		}else{
			$kode_transaksi = generate_else();
		}

		//last id pelanggan
		$pelanggan_id = $this->pelanggan_model->get_last_id();
		if($pelanggan_id){
			$id = substr($pelanggan_id[0]->id_pelanggan, 1);
			$id_pelanggan = generate_code('C', $id);
		}else{
			$id_pelanggan = 'C001';
		}

		$user = $this->session->userdata('id_user');
		//grand total
		$subtotal = $this->cart->total();
		$ongkir = $this->input->post('ongkir');
		$potongan = $this->input->post('sub_potongan');
		//get total item
		$total = 0;
		$total_item = 0;
		foreach ($carts as $value) {
			if($value['price']!=0){
				$total = $total + (int)$value['qty'];
				$total_item += (int)$value['qty'];
			}
		}

		//cek id pelanggan
		if(!empty($carts) && is_array($carts) && $ongkir != null){

			$total = (int)$subtotal - (int)$potongan;
			$total_bayar = (int)$total + (int)$ongkir;
			$id_pelanggan = $this->input->post('id_pelanggan');
			$komoditi = $this->input->post('komoditi');
			$no_hp = $this->input->post('no_hp');
			$data['kode_transaksi'] =  $kode_transaksi;
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
			$data['total_transaksi'] = $total;
			$data['status_bayar'] = '0';
			$data['tanggal_transaksi'] = $this->input->post('tanggal_transaksi');
			$data['id_marketing'] = $this->input->post('id_marketing');
			$data['jenis_order'] = $this->input->post('jenis_order');
			$data['total_item'] = $total_item;
			$data['potongan'] = $potongan;
			$data['metode_pembayaran'] = $this->input->post('metode_pembayaran');
			$data['status_baca'] = $this->input->post('status_baca');

			//$code = $this->input->post('code');
			 if($id_pelanggan==null){
			 	$id_pelanggan = $this->_insert_pelanggan($data['nama_pelanggan'],$data['alamat'],$data['kecamatan'],$data['kabupaten'], $data['provinsi'], $data['tanggal_transaksi'],$data['total_item'],$komoditi,$no_hp);
			 	$data['id_pelanggan'] = $id_pelanggan;

			 	$this->order_model->tambah($data);
			 }else{
			 	$data['id_pelanggan'] = $id_pelanggan;
			 	$this->order_model->tambah($data);
			 }
			 
			if($data['kode_transaksi']){
				$this->_insert_purchase_data($data['kode_transaksi'],$carts,$id_pelanggan,$data['tanggal_transaksi'],$data['id_marketing']);
				$this->_insert_stok_data($data['kode_transaksi'],$carts,$id_pelanggan);
			}
			//disini
			echo json_encode(array('status' => 'ok', ));
		}else{
			echo json_encode(array('status' => 'error'));
		}
	}
	//untuk menyimpan data belanja ke database
	private function _insert_purchase_data($kode_transaksi,$carts,$id_pelanggan, $tanggal_transaksi,$id_marketing){
		foreach($carts as $key => $cart){
			$total_transaksi = ($cart['subtotal']) - ($cart['potongan']);
			$purchase_data = array(
				'kode_transaksi' => $kode_transaksi,
				'id_produk' => $cart['id'],
				'id_pelanggan' => $id_pelanggan,
				'id_marketing' => $id_marketing,
				'id_promo'	=> $cart['id_promo'],
				'status'	=> $cart['status'],
				'jml_beli' => $cart['qty'],
				'harga' => $cart['price'],
				'total_harga' => $cart['subtotal'],
				'potongan'	=> $cart['potongan'],
				'total_transaksi' => $total_transaksi,
				'tanggal_transaksi' => $tanggal_transaksi
			);
			$this->order_model->tambah_order($purchase_data);
			
			//$this->produk_model->update_qty_min($cart['id'],array('stok' => $cart['qty']));
		}
		$this->cart->destroy();
	}
	//untuk menyimpan data stok ke database
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
				'status' => 'proses'
			);
			$this->produk_model->update_qty_min($cart['id'],array('stok' => $cart['qty']));
			$this->order_model->tambah_stok($stok);
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
                	'no_hp'	=> $row->no_hp,
                	'id_marketing'	=> $row->id_marketing,
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
	
	//mendapatkan data produk
	public function get_produk(){
		$id=$this->input->post('id');
  		$data=$this->produk_model->getby_produk($id);
  		if (count($data) > 0) {
            foreach ($data as $row)
                $arr_result[] = array(
                	'nama_produk' => $row->nama_produk,
                	'stok' => $row->stok,
                );
                echo json_encode($arr_result);
            }
	}
	public function add_pelanggan()
	{
		// print_r($no_hp);
		//get provinsi
		$provinsi = $this->wilayah_model->listing();
		//last id pelanggan
		$pelanggan_id = $this->pelanggan_model->get_last_id();
		if($pelanggan_id){
			$id = substr($pelanggan_id[0]->id_pelanggan, 1);
			$id_pelanggan = generate_code('C', $id);
		}else{
			$id_pelanggan = 'C001';
		}
		//validation
		$valid = $this-> form_validation;

		$valid->set_rules('namapelanggan', 'Nama Pelanggan','required',
				array(	'required' 		=> '%s harus diisi'
						));
		$valid->set_rules('alamat', 'Alamat','required',
				array(	'required' 		=> '%s harus diisi'
						));
		$valid->set_rules('no_hp', 'No. Telp','required',
				array(	'required' 		=> '%s harus diisi',
						));
		$valid->set_rules('provinsi', 'provinsi','required',
				array(	'required' 		=> '%s harus diisi'
						));
		$valid->set_rules('kabupaten', 'kabupaten','required',
				array(	'required' 		=> '%s harus diisi'
						));
		$valid->set_rules('kecamatan', 'kecamatan','required',
				array(	'required' 		=> '%s harus diisi',
						));

		if($valid->run()===FALSE){
			//end validation
			$customer = $this->pelanggan_model->customer();
			$id = $this->pelanggan_model->get_last_id();
			
			$data = array(	'title'		=> 'Tambah Data Pelanggan',
							'customer'	=> $customer,
							'provinsi'	=> $provinsi,
							'isi'		=> 'admin/customer/list'
						);
			$this->load->view('admin/layout/wrapper', $data, FALSE);
		}else{
			$i 	= $this->input;
			//konfigurasi no hp
			$nohp = $i->post('no_hp');
			$hp = preg_replace("/[^0-9]/", "", $nohp);
			$no = substr($hp,0,1);
			$a = substr($hp,1);
			
			if($no == '0'){
				$no_hp = '62'.$a;
			}else{
				$no_hp = $hp;
			}

			$data = array(	'id_pelanggan'		=> $id_pelanggan,
							'nama_pelanggan'	=> $i->post('namapelanggan'),
							'alamat'			=> $i->post('alamat'),
							'id_marketing'			=> $i->post('id_marketing'),
							'no_hp'				=> $no_hp,
							'tanggal_daftar'	=> date('Y-m-d'),
							'provinsi'			=> $i->post('prov'),
							'kabupaten'			=> $i->post('kab'),
							'kecamatan'			=> $i->post('kec'),
							'jenis_pelanggan'	=> $i->post('jenis_pelanggan')
						);
			$id_customer = $this->pelanggan_model->tambah($data);
			$this->session->set_flashdata('sukses','Data telah ditambah');
			redirect(base_url('admin/order/tambah_order'), 'refresh');
		}
	}
	public function notifikasi(){
		$this->load->view('admin/order/notifikasi');
	}
	public function laporan(){
		$laporan = $this->order_model->laporan();
		$produk = $this->produk_model->produk();
		$report = $this->order_model->report2();
		$ads = $this->order_model->jenis_order('Semua Produk','','1');
		$organik = $this->order_model->jenis_order('Semua Produk','','2');
		$ongkir = $this->order_model->total_ongkir();
		$total_harga = $this->order_model->total_harga();
		$data = array(	'title'		=> 'Laporan Penjualan',
						'laporan'	=> $laporan,
						'produk'	=> $produk,
						'report'	=> $report,
						'ongkir'	=> $ongkir,
						'total_harga' => $total_harga,
						'ads'		=> $ads,
						'organik'	=> $organik,
						'isi'		=> 'admin/order/laporan'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}
	public function report(){
		 $kode = $this->input->post('kode');
		 $jenis = $this->input->post('jenis');

		 $ads = $this->order_model->jenis_order($kode,$jenis,'1');
		 $organik = $this->order_model->jenis_order($kode,$jenis,'2');
		 $total = $this->order_model->report($kode,$jenis);
		 $ongkir = $this->order_model->report_ongkir($kode,$jenis);
		 $total_harga = $this->order_model->report_harga($kode,$jenis);

		 if($total->total==''){
		 	$tot = 0;
		 }else{
		 	$tot = $total->total;
		 }

		 if($ads->total==''){
		 	$adsense = 0;
		 }else{
		 	$adsense = $ads->total;
		 }

		 if($organik->total==''){
		 	$org = 0;
		 }else{
		 	$org = $organik->total;
		 }

		 $total_report['total'] = $tot;
		 $total_report['ads'] = $adsense;
		 $total_report['organik'] = $org;
		 $total_report['total_harga'] = $total_harga->total;
		 $total_report['ongkir'] = $ongkir->total;
		echo json_encode($total_report);
	}
	public function report_hari(){
		 $awal = $this->input->post('awal');
		 $akhir = $this->input->post('akhir');
		 $kode = $this->input->post('kode');
		 $jenis = $this->input->post('jenis');

		 $ads = $this->order_model->jenisorder_hari($kode,$jenis,'1', $awal, $akhir);
		 $organik = $this->order_model->jenisorder_hari($kode,$jenis,'2', $awal, $akhir);
		 $total = $this->order_model->report_hari($kode,$jenis, $awal, $akhir);
		 $total_harga = $this->order_model->report_harga1($kode,$jenis, $awal, $akhir);
		 $ongkir = $this->order_model->report_ongkir1($kode,$jenis, $awal,$akhir);

		 if($total->total==''){
		 	$tot = 0;
		 }else{
		 	$tot = $total->total;
		 }

		 if($ads->total==''){
		 	$adsense = 0;
		 }else{
		 	$adsense = $ads->total;
		 }

		 if($organik->total==''){
		 	$org = 0;
		 }else{
		 	$org = $organik->total;
		 }
		 if($ongkir->total==''){
		 	$ong = 0;
		 }else{
		 	$ong = $ongkir->total;
		 }

		 $total_report['total'] = $tot;
		 $total_report['total_harga'] = $total_harga->total;
		 $total_report['ads'] = $adsense;
		 $total_report['organik'] = $org;
		 $total_report['ongkir'] = $ong;
		echo json_encode($total_report);
	}
	public function report_bulan(){
		 $bulan = $this->input->post('bulan');
		 $tahun = $this->input->post('tahun');
		 $kode = $this->input->post('kode');
		 $jenis = $this->input->post('jenis');

		 $ads = $this->order_model->jenisorder_bulan($kode,$jenis,'1', $bulan, $tahun);
		 $organik = $this->order_model->jenisorder_bulan($kode,$jenis,'2', $bulan, $tahun);
		 $total = $this->order_model->report_bulan($kode,$jenis, $bulan, $tahun);
		 $ongkir = $this->order_model->report_ongkir2($kode,$jenis, $bulan, $tahun);
		 $total_harga = $this->order_model->report_harga2($kode,$jenis, $bulan, $tahun);

		 if($total->total==''){
		 	$tot = 0;
		 }else{
		 	$tot = $total->total;
		 }

		 if($ads->total==''){
		 	$adsense = 0;
		 }else{
		 	$adsense = $ads->total;
		 }

		 if($organik->total==''){
		 	$org = 0;
		 }else{
		 	$org = $organik->total;
		 }

		 if($ongkir->total==''){
		 	$ong = 0;
		 }else{
		 	$ong = $ongkir->total;
		 }

		 $total_report['ongkir'] = $ong;
		 $total_report['total_harga'] = $total_harga->total;
		 $total_report['total'] = $tot;
		 $total_report['ads'] = $adsense;
		 $total_report['organik'] = $org;
		echo json_encode($total_report);
	}
	public function report_tahun(){
		 $tahun = $this->input->post('tahun');
		 $kode = $this->input->post('kode');
		 $jenis = $this->input->post('jenis');

		 $ads = $this->order_model->jenisorder_tahun($kode,$jenis,'1', $tahun);
		 $organik = $this->order_model->jenisorder_tahun($kode,$jenis,'2', $tahun);
		 $total = $this->order_model->report_tahun($kode,$jenis, $tahun);
		 $ongkir = $this->order_model->report_ongkir3($kode,$jenis,$tahun);
		 $total_harga = $this->order_model->report_harga3($kode,$jenis,$tahun);

		 if($total->total==''){
		 	$tot = 0;
		 }else{
		 	$tot = $total->total;
		 }

		 if($ads->total==''){
		 	$adsense = 0;
		 }else{
		 	$adsense = $ads->total;
		 }

		 if($organik->total==''){
		 	$org = 0;
		 }else{
		 	$org = $organik->total;
		 }
		 if($ongkir->total==''){
		 	$ong = 0;
		 }else{
		 	$ong = $ongkir->total;
		 }

		 $total_report['total'] = $tot;
		 $total_report['ongkir'] = $ong;
		 $total_report['total_harga'] = $total_harga->total;
		 $total_report['ads'] = $adsense;
		 $total_report['organik'] = $org;
		echo json_encode($total_report);
	}
	public function laporan1(){

		$data = array(	'title'		=> 'Laporan Penjualan',
						'isi'		=> 'admin/order/laporan'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}
	public function lap_tanggal(){
		$awal = $this->input->post('tgl_awal');
		$akhir = $this->input->post('tgl_akhir');

		$produk = $this->produk_model->produk();
		$laporan = $this->order_model->lap_harian($awal,$akhir);
		$lap_hari = $this->order_model->report_harian($awal,$akhir);
		$ongkir = $this->order_model->ongkir_hari($awal, $akhir);
		//$total_harga = $this->order_model->harga_bulanan($awal,$akhir);
		$ads = $this->order_model->jenis_hari('1',$awal, $akhir);
		$organik = $this->order_model->jenis_hari('2',$awal, $akhir);
		$total_harga = $this->order_model->harga_harian($awal,$akhir);

		$data = array(	'title'		=> 'Laporan Penjualan',
						'laporan'	=> $laporan,
						'report'	=> $lap_hari,
						'ongkir'	=> $ongkir,
						'ads'		=> $ads,
						'awal'		=> $awal,
						'total_harga' => $total_harga,
						'akhir'		=> $akhir,
						'produk'	=> $produk,
						'organik'	=> $organik,
						'isi'		=> 'admin/order/lap_tanggal'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
		 //print_r($laporan);
	}
	public function lap_bulan(){
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');

		$produk = $this->produk_model->produk();
		$lap_bulan = $this->order_model->report_bulanan($bulan,$tahun);
		$ongkir = $this->order_model->ongkir_bulan($bulan, $tahun);
		$laporan = $this->order_model->lap_bulan($bulan, $tahun);
		$ads = $this->order_model->jenis_bulan('1',$bulan, $tahun);
		$organik = $this->order_model->jenis_bulan('2',$bulan, $tahun);
		$total_harga = $this->order_model->harga_bulanan($bulan,$tahun);

		$data = array(	'title'		=> 'Laporan Penjualan',
						'laporan'	=> $laporan,
						'produk'	=> $produk,
						'bulan'		=> $bulan,
						'tahun'		=> $tahun,
						'ongkir'	=> $ongkir,
						'total_harga' => $total_harga,
						'ads'		=> $ads,
						'organik'	=> $organik,
						'report'	=> $lap_bulan,
						'isi'		=> 'admin/order/lap_bulan'
					);
		//print_r($ads);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}
	public function lap_tahun(){
		$tahun = $this->input->post('tahun2');

		$produk = $this->produk_model->produk();
		$lap_tahun = $this->order_model->report_tahunan($tahun);
		$laporan = $this->order_model->lap_tahun($tahun);
		$ongkir = $this->order_model->ongkir_tahun( $tahun);
		$total = $this->order_model->total_tahun($tahun);
		$ads = $this->order_model->jenis_tahun('1', $tahun);
		$organik = $this->order_model->jenis_tahun('2', $tahun);
		$total_harga = $this->order_model->harga_tahunan($tahun);

		$data = array(	'title'		=> 'Laporan Penjualan',
						'laporan'	=> $laporan,
						'total'		=> $total,
						'tahun'		=> $tahun,
						'report'	=> $lap_tahun,
						'ongkir'	=> $ongkir,
						'ads'		=> $ads,
						'organik'	=> $organik,
						'total_harga' => $total_harga,
						'produk'	=> $produk,
						'isi'		=> 'admin/order/lap_tahun'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}
	public function excel(){
		$tahun = $this->input->post('year');
		$data = $this->order_model->lap_tahun($tahun);
		//print_r($tahun);

		require(APPPATH. 'PHPExcel-1.8/Classes/PHPExcel.php');
		require(APPPATH. 'PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

		$object = new PHPExcel();

		$object->getProperties()->setCreator("PT AGI");
		$object->getProperties()->setLastModifiedBy("PT AGI");
		$object->getProperties()->setTitle("Laporan Penjualan");

		$object->setActiveSheetIndex(0);

		$object->getActiveSheet()->setCellValue('E5','No');
		$object->getActiveSheet()->setCellValue('F5','Kode Invoice');
		$object->getActiveSheet()->setCellValue('G5','Tanggal Transaksi');
		$object->getActiveSheet()->setCellValue('H5','Marketing');
		$object->getActiveSheet()->setCellValue('I5','Jenis Order');
		$object->getActiveSheet()->setCellValue('J5','Nama Pelanggan');
		$object->getActiveSheet()->setCellValue('K5','Produk');
		$object->getActiveSheet()->setCellValue('L5','Jumlah');
		$object->getActiveSheet()->setCellValue('M5','Harga');
		$object->getActiveSheet()->setCellValue('N5','Potongan');
		$object->getActiveSheet()->setCellValue('O5','Total');
		$object->getActiveSheet()->setCellValue('P5','Metode Bayar');
		$object->getActiveSheet()->setCellValue('Q5','Status Bayar');

		$baris = 6;
		$no = 1;

		foreach ($$data['lap_tahun'] as $value) {
			$object->getActiveSheet()->setCellValue('E'.$baris, $no++);
			$object->getActiveSheet()->setCellValue('F'.$baris, $value->kode_transaksi);
			$object->getActiveSheet()->setCellValue('G'.$baris, $value->tanggal_transaksi);
			$object->getActiveSheet()->setCellValue('H'.$baris, $value->nama_marketing);
			$object->getActiveSheet()->setCellValue('I'.$baris, $value->jenis_order);
			$object->getActiveSheet()->setCellValue('J'.$baris, $value->nama_pelanggan);
			$object->getActiveSheet()->setCellValue('K'.$baris, $value->nama_produk);
			$object->getActiveSheet()->setCellValue('L'.$baris, $value->jml_beli);
			$object->getActiveSheet()->setCellValue('M'.$baris, $value->harga);
			$object->getActiveSheet()->setCellValue('N'.$baris, $value->potongan);
			$object->getActiveSheet()->setCellValue('O'.$baris, $value->total_transaksi);
			$object->getActiveSheet()->setCellValue('P'.$baris, $value->metode_pembayaran);
			$object->getActiveSheet()->setCellValue('Q'.$baris, $value->status_bayar);

			$baris++;
		}

		$filename = "Laporan Penjualan".'.xlsx';

		$object->getActiveSheet()->setTitle("Laporan Penjualan");

		//header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$filename. '"');
		header('Cache-Control: max-age=0');

		$Writer = PHPEcel_IOFactory::createwriter($object, 'Excel2007');
		$Writer->save('php://output');

		exit;
	}
	public function print($kode_transaksi){
		$order = $this->order_model->kode_order($kode_transaksi);
		$detail = $this->order_model->kode_transaksi($kode_transaksi);
		$data = array(	'title'		=> 'Laporan Penjualan',
						'kode_transaksi' => $kode_transaksi,
						'order'		=> $order,
						'detail'	=> $detail,
					);
		$this->load->view('admin/order/print_invoice', $data, FALSE);
	}
}