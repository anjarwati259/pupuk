<?php 
/**
 * 
 */
//load model
class Produk extends CI_Controller
{
	public function __construct()
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
	public function index(){

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
			redirect(base_url('admin/produk/stok_awal'), 'refresh');
		}
	}
	//stok keluar
	public function stok_keluar(){
		$produk = $this->produk_model->produk();
		//validation
		$valid = $this-> form_validation;

		$valid->set_rules('kode_produk', 'Kode Product','required',
				array(	'required' 		=> '%s harus diisi'
						));
		$valid->set_rules('stok', 'Stok Product','required',
				array(	'required' 		=> '%s harus diisi'));
		$valid->set_rules('status', 'Status Product','required',
				array(	'required' 		=> '%s harus diisi'));

		if($valid->run()===FALSE){
			//end validation
			$data = array(	'title'		=> 'Tambah Data Stok',
							'produk'	=> $produk,
							'isi'		=> 'admin/stok/stok_keluar'
						);
			$this->load->view('admin/layout/wrapper', $data, FALSE);
		}else{
			$i 	= $this->input;
			$kode_produk = $i->post('kode_produk');
			$stok = $i->post('stok');
			$sisa =  $this->produk_model->get_stok_id($kode_produk)->stok;
			$sisa_stok = $sisa - $stok;
			$data = array(	'kode_produk'	=> $kode_produk,
							'qty'	=> $i->post('stok'),
							'sisa' => $sisa_stok,
							'tanggal' => $i->post('tanggal'),
							'status' => $i->post('status')
						);
			//print_r($data);
			$this->produk_model->tambah_stok($data);

			$this->produk_model->stok_min($kode_produk,array('stok' => $stok));
			$this->session->set_flashdata('sukses','Data telah ditambah');
			redirect(base_url('admin/produk/stok_awal'), 'refresh');
		}
	}

	public function detail_order(){
		$id = $this->input->post('id');
		$get_order= $this->produk_model->get_order($id);
		echo json_encode($get_order);
	}

	//tampil riwayat stok
	public function stok()
	{ 
		$produk = $this->produk_model->produk();
		$stok 	= $this->produk_model->get_stok();
		$total = $this->produk_model->allstok();
		$bonus = $this->produk_model->allbonus();
		$sample	= $this->produk_model->allsampel();
		$sisa = $this->produk_model->allsisa();
		$data = array(	'title'			=> 'Data Stok',
						'stok'			=> $stok,
						'total'			=> $total,
						'produk'		=> $produk,
						'bonus'			=> $bonus,
						'sampel'		=> $sample,
						'sisa'			=> $sisa,
						'isi'			=> 'admin/stok/stok'
						);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}
	//retur barang
	public function retur_barang()
	{ 
		$order = $this->order_model->Alllisting();
		$data = array(	'title'		=> 'Retur Barang',
						'order'		=> $order,
						'isi'		=> 'admin/stok/retur_barang'
						);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}
	public function add_retur(){
		$kode_transaksi = $this->input->post('id');
		$tgl_trans = $this->input->post('tgl_trans');
		$tgl_retur = $this->input->post('tgl_retur');
		$keterangan = $this->input->post('ket');
		$retur = array(	'kode_transaksi'	=> $kode_transaksi,
						'tgl_transaksi'		=> $tgl_trans,
						'tgl_retur'		=> $tgl_retur,
						'keterangan'		=> $keterangan
					);
		$this->_insert_stok_data($kode_transaksi,$tgl_retur);
		$this->produk_model->retur($retur);
		
	}

	private function _insert_stok_data($kode_transaksi,$tgl_retur){
		$order = $this->produk_model->get_order($kode_transaksi);
		foreach($order as $order){
			$sisa =  $this->produk_model->get_stok_id($order->id_produk);
			$stok = array(
				'kode_transaksi' => $kode_transaksi,
				'kode_produk' => $order->id_produk,
				'id_pelanggan' => $order->id_pelanggan,
				'qty' => $order->jml_beli,
				'tanggal' => $tgl_retur,
				'sisa'	=> $sisa->stok,
				'status' => 'return'
			);
			$this->produk_model->update_stok($order->id_produk,array('stok' => $order->jml_beli));
			$this->order_model->tambah_stok($stok);
		}
	}

	public function stok_tanggal(){
		$awal = $this->input->post('tgl_awal');
		$akhir = $this->input->post('tgl_akhir');
		$status = $this->input->post('status');
 
		$produk = $this->produk_model->produk();
		$stok = $this->produk_model->stok_harian($awal,$akhir,$status,'sampel');
		$total = $this->produk_model->stok_hari($awal,$akhir);
		$bonus = $this->produk_model->bonus_hari($awal,$akhir);
		$sample	= $this->produk_model->sampel_hari($awal, $akhir);
		$sisa = $this->produk_model->allsisa();

		$data = array(	'title'		=> 'Laporan Penjualan',
						'stok'		=> $stok,
						'total'		=> $total,
						'bonus'		=> $bonus,
						'sampel'	=> $sample,
						'awal'		=> $awal,
						'akhir'		=> $akhir,
						'produk'	=> $produk,
						'sisa'		=> $sisa,
						'isi'		=> 'admin/stok/stok_tanggal'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
		 //print_r($laporan);
	}

	public function report_tgl(){
		 $kode = $this->input->post('kode');
		 $jenis = $this->input->post('jenis');
		 $awal = $this->input->post('awal');
		 $akhir = $this->input->post('akhir');

		 if($jenis=='Masuk'){
		 	$jen = 'in';
		 }else if($jenis=='Keluar'){
		 	$jen = 'out';
		 }else{
		 	$jen = $jenis;
		 }

		 $sample = $this->produk_model->sample_harian($kode,$awal,$akhir);
		 $bonus = $this->produk_model->bonus_harian($kode,$jen,$awal, $akhir);
		 $total = $this->produk_model->report_hari($kode,$jen, $awal, $akhir);
		 $sisa_stok = $this->produk_model->sisa_stok($kode);

		 if($total->total==''){
		 	$tot = 0;
		 }else{
		 	$tot = $total->total;
		 }

		 if($bonus->total==''){
		 	$bon = 0;
		 }else{
		 	$bon = $bonus->total;
		 }

		 if($sample->total==''){
		 	$samp = 0;
		 }else{
		 	$samp = $sample->total;
		 }

		 if($sisa_stok->stok==''){
		 	$sisa = 0;
		 }else{
		 	$sisa = $sisa_stok->stok;
		 }

		 $total_report['total'] = $tot;
		 $total_report['bonus'] = $bon;
		 $total_report['sample'] = $samp;
		 $total_report['sisa'] = $sisa;

		echo json_encode($total_report);
	}

	public function stok_bulan(){
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');

		$produk = $this->produk_model->produk();
		$stok = $this->produk_model->stok_bulanan($bulan,$tahun);
		$total = $this->produk_model->stok_bulan($bulan,$tahun);
		$bonus = $this->produk_model->bonus_bulan($bulan,$tahun);
		$sample	= $this->produk_model->sampel_bulan($bulan, $tahun);
		$sisa = $this->produk_model->allsisa();

		$data = array(	'title'		=> 'Laporan Penjualan',
						'stok'		=> $stok,
						'total'		=> $total,
						'bonus'		=> $bonus,
						'sampel'	=> $sample,
						'bulan'		=> $bulan,
						'tahun'		=> $tahun,
						'produk'	=> $produk,
						'sisa'		=> $sisa,
						'isi'		=> 'admin/stok/stok_bulan'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
		 //print_r($laporan);
	}

	public function report_bln(){
		 $kode = $this->input->post('kode');
		 $jenis = $this->input->post('jenis');
		 $bulan = $this->input->post('bulan');
		 $tahun = $this->input->post('tahun');

		 if($jenis=='Masuk'){
		 	$jen = 'in';
		 }else if($jenis=='Keluar'){
		 	$jen = 'out';
		 }else{
		 	$jen = $jenis;
		 }

		 $sample = $this->produk_model->sample_bulanan($kode,$bulan,$tahun);
		 $bonus = $this->produk_model->bonus_bulanan($kode,$jen,$bulan,$tahun);
		 $total = $this->produk_model->report_bulan($kode,$jen, $bulan,$tahun);
		 $sisa_stok = $this->produk_model->sisa_stok($kode);

		 if($total->total==''){
		 	$tot = 0;
		 }else{
		 	$tot = $total->total;
		 }

		 if($bonus->total==''){
		 	$bon = 0;
		 }else{
		 	$bon = $bonus->total;
		 }

		 if($sample->total==''){
		 	$samp = 0;
		 }else{
		 	$samp = $sample->total;
		 }

		 if($sisa_stok->stok==''){
		 	$sisa = 0;
		 }else{
		 	$sisa = $sisa_stok->stok;
		 }

		 $total_report['total'] = $tot;
		 $total_report['bonus'] = $bon;
		 $total_report['sample'] = $samp;
		 $total_report['sisa'] = $sisa;

		echo json_encode($total_report);
	}
	public function stok_tahun(){
		$tahun = $this->input->post('tahun');

		$produk = $this->produk_model->produk();
		$stok = $this->produk_model->stok_tahunan($tahun);
		$total = $this->produk_model->stok_tahun($tahun);
		$bonus = $this->produk_model->bonus_tahun($tahun);
		$sample	= $this->produk_model->sampel_tahun($tahun);
		$sisa = $this->produk_model->allsisa();

		$data = array(	'title'		=> 'Laporan Penjualan',
						'stok'		=> $stok,
						'total'		=> $total,
						'bonus'		=> $bonus,
						'sampel'	=> $sample,
						'tahun'		=> $tahun,
						'produk'	=> $produk,
						'sisa'		=> $sisa,
						'isi'		=> 'admin/stok/stok_tahun'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
		 //print_r($laporan);
	}

	public function report_thn(){
		 $kode = $this->input->post('kode');
		 $jenis = $this->input->post('jenis');
		 $tahun = $this->input->post('tahun');

		 if($jenis=='Masuk'){
		 	$jen = 'in';
		 }else if($jenis=='Keluar'){
		 	$jen = 'out';
		 }else{
		 	$jen = $jenis;
		 }

		 $sample = $this->produk_model->sample_tahunan($kode,$tahun);
		 $bonus = $this->produk_model->bonus_tahunan($kode,$jen,$tahun);
		 $total = $this->produk_model->report_tahun($kode,$jen,$tahun);
		 $sisa_stok = $this->produk_model->sisa_stok($kode);

		 if($total->total==''){
		 	$tot = 0;
		 }else{
		 	$tot = $total->total;
		 }

		 if($bonus->total==''){
		 	$bon = 0;
		 }else{
		 	$bon = $bonus->total;
		 }

		 if($sample->total==''){
		 	$samp = 0;
		 }else{
		 	$samp = $sample->total;
		 }

		 if($sisa_stok->stok==''){
		 	$sisa = 0;
		 }else{
		 	$sisa = $sisa_stok->stok;
		 }

		 $total_report['total'] = $tot;
		 $total_report['bonus'] = $bon;
		 $total_report['sample'] = $samp;
		 $total_report['sisa'] = $sisa;

		echo json_encode($total_report);
	}
}