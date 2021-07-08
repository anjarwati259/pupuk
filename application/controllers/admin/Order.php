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
		// $kode_customer = 'C001';
		// $SO = generate_SO();
		// $kode_transaksi = $SO . '/' . $kode_customer;
		// print_r($kode_transaksi);
	}
	//konfirmasi pesanan jika sudah bayar
	public function konfirmasi($kode_transaksi){
		//mengambil jenis pelanggan
		$pelanggan = $this->order_model->jenis_pelanggan($kode_transaksi);
		$stok = $this->order_model->get_stok($kode_transaksi);
		//konfirmasi status bayar
		$data = array(	'kode_transaksi'	=> $kode_transaksi,
						'id_rekening'		=> $this->input->post('id_rekening'),
						'ongkir'			=> $this->input->post('ongkir'),
						'total_bayar'		=> $this->input->post('total_bayar'),
						'no_resi'		=> $this->input->post('no_resi'),
						'expedisi'		=> $this->input->post('expedisi'),
						'no_resi'		=> $this->input->post('no_resi'),
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
		redirect(base_url('admin/order/sudah_bayar'), 'refresh');
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
	//menampilkan form tambah order
	public function tambah_order()
	{ 
		//last id kode transaksi
		$id = $this->order_model->get_last_id();
		if($id){
			$id = $id[0]->kode_transaksi;
			$kode_transaksi = generate_invoice('INV0',$id);
		}else{
			$kode_transaksi = 'INV0001';
		} 

		//last id pelanggan
		$pelanggan_id = $this->pelanggan_model->get_last_id();
		if($pelanggan_id){
			$pelanggan_id = $pelanggan_id[0]->id_pelanggan;
			$id_pelanggan = generate_code('ID',$pelanggan_id);
		}else{
			$id_pelanggan = 'ID202201';
		}
		// destry cart
		$this->cart->destroy();
		$id_user = $this->session->userdata('id_user');
		$marketing =  $this->marketing_model->get_marketing($id_user);
		//get provinsi
		$provinsi = $this->wilayah_model->listing();

		$pelanggan 	= $this->pelanggan_model->alllisting();
		$produk 	= $this->home_model->produk();
		$promo 		= $this->home_model->promo();
		
		$data = array(	'title'				=> 'Tambah Order',
						'kode_transaksi'	=> $kode_transaksi,
						'pelanggan'			=> $pelanggan,
						'marketing'			=> $marketing,
						'produk'			=> $produk,
						'provinsi'			=> $provinsi,
						'promo'				=> $promo,
						'id_pelanggan'		=> $id_pelanggan,
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
					'options'  => array('id'=>'PK001', 'qty' => $bonus)
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

		//get total item
		$total = 0;
		foreach ($carts as $value) {
			if($value['price']!=0){
				$total = $total + $value['qty'];
			}
		}
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
			$data['id_marketing'] = $this->input->post('id_marketing');
			$data['jenis_order'] = $this->input->post('jenis_order');
			$data['total_item'] = $total;
			$data['metode_pembayaran'] = $this->input->post('metode_pembayaran');
			$data['status_baca'] = $this->input->post('status_baca');

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
			$bayar = (int)str_replace('.', '', $this->input->post('total_bayar'));
			//insert pembayaran
		$data = array(	'kode_transaksi'	=> $kode_transaksi,
						'nama_bank'			=> '-',
						'id_rekening'		=> 0,
						'tanggal_bayar'		=> $this->input->post('tanggal_bayar'),
						'jumlah_bayar'		=> $bayar
						);
		$this->pembayaran_model->bayar($data);
		$this->session->set_flashdata('sukses','Status Telah Diubah');
		redirect(base_url('admin/order/sudah_bayar'), 'refresh');
	}
	//tampilkan data stok awal dari masing masing produk
	public function stok_awal(){
		$produk = $this->produk_model->produk();
		$data = array(	'title' => 'Data Stok Awal',
						'produk' => $produk,
						'isi' => 'admin/stok/stok_awal' );
		$this->load->view('admin/layout/wrapper',$data, FALSE);
	}
	//tambah stok
	public function tambah_stok()
	{
		$produk = $this->produk_model->produk();
		//validation
		$valid = $this-> form_validation;

		$valid->set_rules('kode_produk', 'Kode Product','required',
				array(	'required' 		=> '%s harus diisi'
						));
		$valid->set_rules('stok', 'Stok Product','required',
				array(	'required' 		=> '%s harus diisi'));

		if($valid->run()===FALSE){
			//end validation
			$data = array(	'title'		=> 'Tambah Data Stok',
							'produk'	=> $produk,
							'isi'		=> 'admin/stok/tambah_stok'
						);
			$this->load->view('admin/layout/wrapper', $data, FALSE);
		}else{
			$i 	= $this->input;
			$kode_produk = $i->post('kode_produk');
			$stok = $i->post('stok');
			$sisa =  $this->produk_model->get_stok_id($kode_produk)->stok;
			$sisa_stok = $sisa + $stok;
			$data = array(	'kode_produk'	=> $kode_produk,
							'qty'	=> $i->post('stok'),
							'sisa' => $sisa_stok,
							'tanggal' => date('Y-m-d'),
							'status' => 'in'
						);
			$this->produk_model->tambah_stok($data);

			$this->produk_model->update_stok($kode_produk,array('stok' => $stok));
			$this->session->set_flashdata('sukses','Data telah ditambah');
			redirect(base_url('admin/order/stok_awal'), 'refresh');
		}
	}
	//tapilkan riwayat stok
	public function stok()
	{ 

		$stok 	= $this->produk_model->getstok();
		$data = array(	'title'			=> 'Data Stok',
						'stok'			=> $stok,
						'isi'			=> 'admin/stok/stok'
						);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
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
		//get provinsi
		$provinsi = $this->wilayah_model->listing();
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
		$valid->set_rules('komoditi', 'komoditi','required',
				array(	'required' 		=> '%s harus diisi',
						));

		if($valid->run()===FALSE){
			//end validation
			$customer = $this->pelanggan_model->customer();
			$id = $this->pelanggan_model->get_last_id();

			if($id){
				$id = $id[0]->id_pelanggan;
				$id_pelanggan = generate_code('ID20220',$id);
			}else{
				$id_pelanggan = 'ID202201';
			}
			
			$data = array(	'title'		=> 'Tambah Data Pelanggan',
							'customer'	=> $customer,
							'id'		=> $id,
							'provinsi'	=> $provinsi,
							'isi'		=> 'admin/customer/list'
						);
			$this->load->view('admin/layout/wrapper', $data, FALSE);
		}else{
			$i 	= $this->input;
			$data = array(	'id_pelanggan'		=> $i->post('id_pelanggan'),
							'nama_pelanggan'	=> $i->post('namapelanggan'),
							'alamat'			=> $i->post('alamat'),
							'id_marketing'			=> $i->post('id_marketing'),
							'no_hp'				=> $i->post('no_hp'),
							'komoditi'			=> $i->post('komoditi'),
							'tanggal_daftar'	=> date('Y-m-d'),
							'provinsi'			=> $i->post('prov'),
							'kabupaten'			=> $i->post('kab'),
							'kecamatan'			=> $i->post('kec'),
							'jenis_pelanggan'	=> $i->post('jenis_pelanggan')
						);
			$this->pelanggan_model->tambah($data);
			$this->session->set_flashdata('sukses','Data telah ditambah');
			redirect(base_url('admin/order/tambah_order'), 'refresh');
		}
	}
	public function notifikasi(){
		$this->load->view('admin/order/notifikasi');
	}
}