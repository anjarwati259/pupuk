<?php 

/**
 * 
 */
class Marketing_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function marketing(){
		$this->db->select('*');
		$this->db->from('tb_marketing');
		$this->db->where('nama_marketing!=','Retno');
		$query = $this->db->get();
		return $query->result(); 
	}
	public function get_marketing($id_user){
		$this->db->select('*');
		$this->db->from('tb_marketing');
		$this->db->where('id_user', $id_user);
		$query = $this->db->get();
		return $query->row(); 
	}
	//mendapatkan data transaksi berdasarkan kodenya
	public function produk($kode_produk){
		$this->db->select('*');
		$this->db->from('tb_produk');
		$this->db->where('kode_produk', $kode_produk);
		$this->db->order_by('kode_produk','asc');
		$query = $this->db->get();
		return $query->row();
	}
// ============================= Report ================================//
	public function laporan($id_marketing){
		$this->db->select('tb_order.*,
							tb_pelanggan.nama_pelanggan, 
							tb_pelanggan.jenis_pelanggan,
							tb_produk.nama_produk, 
							tb_marketing.nama_marketing,tb_detail_order.metode_pembayaran, tb_detail_order.jenis_order,tb_detail_order.status_bayar,tb_detail_order.ongkir');
		$this->db->from('tb_order');
		$this->db->where('tb_order.id_marketing', $id_marketing);
		$this->db->where('tb_order.harga !=',0);
		$this->db->join('tb_pelanggan','tb_pelanggan.id_pelanggan = tb_order.id_pelanggan', 'left');
		$this->db->join('tb_produk','tb_produk.kode_produk = tb_order.id_produk', 'left');
		$this->db->join('tb_marketing','tb_marketing.id_marketing = tb_order.id_marketing', 'left');
		$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
		$this->db->order_by('tb_order.kode_transaksi','asc');
		$query = $this->db->get();
		return $query->result();
	}
	public function report2($id_marketing){
		$this->db->select('sum(jml_beli) as total');
		$this->db->from('tb_order');
		$this->db->where('tb_order.id_marketing', $id_marketing);
		$this->db->where('tb_order.harga !=',0);
		$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
		$query = $this->db->get();
		return $query->row();
	}
	public function total_ongkir($id_marketing){
		$this->db->select('sum(tb_detail_order.ongkir) as ongkir');
		$this->db->from('tb_detail_order');
		$this->db->where('id_marketing', $id_marketing);
		$query = $this->db->get();
		return $query->row();
	}
	public function jenis_order($kode, $cus, $jenis, $id_marketing){
		if(($kode=='' and $cus=='Semua Pelanggan') or ($kode=='Semua Produk' and $cus=='')){
			$this->db->select('sum(jml_beli) as total');
			$this->db->from('tb_order');
			$this->db->where("tb_detail_order.jenis_order", $jenis);
			$this->db->where('tb_order.id_marketing', $id_marketing);
			$this->db->where('tb_order.harga !=',0);
			$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
		}else if(($kode!='' and $cus=='Semua Pelanggan')or ($kode!='Semua Produk' and $cus=='')){
			$this->db->select('sum(jml_beli) as total');
			$this->db->from('tb_order');
			$this->db->where("tb_detail_order.jenis_order", $jenis);
			$this->db->where("tb_order.id_produk", $kode);
			$this->db->where('tb_order.id_marketing', $id_marketing);
			$this->db->where('tb_order.harga !=',0);
			$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
		}else if(($kode=='' and $cus!='Semua Pelanggan') or ($kode=='Semua Produk' and $cus!='')){
			$this->db->select('sum(jml_beli) as total');
			$this->db->from('tb_order');
			$this->db->where("tb_detail_order.jenis_order", $jenis);
			$this->db->where("tb_pelanggan.jenis_pelanggan", $cus);
			$this->db->where('tb_order.id_marketing', $id_marketing);
			$this->db->where('tb_order.harga !=',0);
			$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
			$this->db->join('tb_pelanggan','tb_pelanggan.id_pelanggan = tb_order.id_pelanggan', 'left');
		}else{
			$this->db->select('sum(jml_beli) as total');
			$this->db->from('tb_order');
			$this->db->where("tb_detail_order.jenis_order", $jenis);
			$this->db->where("tb_order.id_produk", $kode);
			$this->db->where("tb_pelanggan.jenis_pelanggan", $cus);
			$this->db->where('tb_order.id_marketing', $id_marketing);
			$this->db->where('tb_order.harga !=',0);
			$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
			$this->db->join('tb_pelanggan','tb_pelanggan.id_pelanggan = tb_order.id_pelanggan', 'left');
		}
		$query = $this->db->get();
		return $query->row();
	}

	public function report($kode, $jenis, $id_marketing){
		if(($kode=='' and $jenis=='Semua Pelanggan') or ($kode=='' and $jenis=='')){
			$this->db->select('sum(jml_beli) as total');
			$this->db->from('tb_order');
			$this->db->where('tb_order.id_marketing', $id_marketing);
			$this->db->where('tb_order.harga !=',0);
			$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
		}else if(($kode!='' and $jenis=='Semua Pelanggan') or ($kode!='' and $jenis=='')){
			$this->db->select('sum(jml_beli) as total');
			$this->db->from('tb_order');
			$this->db->where("id_produk", $kode);
			$this->db->where('id_marketing', $id_marketing);
			$this->db->where('harga !=',0);
		}else if(($kode=='' and $jenis!='Semua Pelanggan') or ($kode=='' and $jenis!='')){
			$this->db->select('sum(jml_beli) as total');
			$this->db->from('tb_order');
			$this->db->where("tb_pelanggan.jenis_pelanggan", $jenis);
			$this->db->where('tb_order.id_marketing', $id_marketing);
			$this->db->where('tb_order.harga !=',0);
			$this->db->join('tb_pelanggan','tb_pelanggan.id_pelanggan = tb_order.id_pelanggan', 'left');
		}else{
			$this->db->select('sum(jml_beli) as total, sum(tb_detail_order.ongkir) as ongkir, tb_pelanggan.jenis_pelanggan');
			$this->db->from('tb_order');
			$this->db->join('tb_pelanggan','tb_pelanggan.id_pelanggan = tb_order.id_pelanggan', 'left');
			$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
			$this->db->where("id_produk", $kode);
			$this->db->where("tb_pelanggan.jenis_pelanggan", $jenis);
			$this->db->where('tb_order.id_marketing', $id_marketing);
			$this->db->where('tb_order.harga !=',0);
		}
		$query = $this->db->get();
		return $query->row();
	}
	public function lap_harian($awal, $akhir, $id_marketing){
		$this->db->select('tb_order.*,
							tb_pelanggan.nama_pelanggan, 
							tb_pelanggan.jenis_pelanggan,
							tb_produk.nama_produk, 
							tb_marketing.nama_marketing,tb_detail_order.metode_pembayaran, tb_detail_order.jenis_order,tb_detail_order.status_bayar,tb_detail_order.ongkir');
		$this->db->from('tb_order');
		$this->db->where('tb_order.tanggal_transaksi >=', $awal);
		$this->db->where('tb_order.tanggal_transaksi <=', $akhir);
		$this->db->where('tb_order.id_marketing', $id_marketing);
		$this->db->where('tb_order.harga !=',0);
		$this->db->join('tb_pelanggan','tb_pelanggan.id_pelanggan = tb_order.id_pelanggan', 'left');
		$this->db->join('tb_produk','tb_produk.kode_produk = tb_order.id_produk', 'left');
		$this->db->join('tb_marketing','tb_marketing.id_marketing = tb_order.id_marketing', 'left');
		$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
		$this->db->group_by('tb_order.kode_transaksi');
		$this->db->order_by('tb_order.kode_transaksi','asc');
		$query = $this->db->get();
		return $query->result();
	}
	public function report_harian($awal,$akhir, $id_marketing){
		$this->db->select('sum(jml_beli) as total');
		$this->db->from('tb_order');
		$this->db->where('tb_order.tanggal_transaksi >=', $awal);
		$this->db->where('tb_order.tanggal_transaksi <=', $akhir);
		$this->db->where('tb_order.id_marketing', $id_marketing);
		$this->db->where('tb_order.harga !=',0);
		$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
		$query = $this->db->get();
		return $query->row();
	}
	public function ongkir_hari($awal, $akhir, $id_marketing){
		$this->db->select('sum(tb_detail_order.ongkir) as ongkir');
		$this->db->from('tb_detail_order');
		$this->db->where('tanggal_transaksi >=', $awal);
		$this->db->where('tanggal_transaksi <=', $akhir);
		$this->db->where('id_marketing', $id_marketing);
		$query = $this->db->get();
		return $query->row();
	}
	public function jenis_hari($jenis, $awal, $akhir, $id_marketing){
		$this->db->select('sum(jml_beli) as total');
		$this->db->from('tb_order');
		$this->db->where("tb_detail_order.jenis_order", $jenis);
		$this->db->where('tb_order.tanggal_transaksi >=', $awal);
		$this->db->where('tb_order.tanggal_transaksi <=', $akhir);
		$this->db->where('tb_order.id_marketing', $id_marketing);
		$this->db->where('tb_order.harga !=',0);
		$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
		$query = $this->db->get();
		return $query->row();
	}
	public function jenisorder_hari($kode, $cus, $jenis, $awal, $akhir, $id_marketing){
		if(($kode=='' and $cus=='Semua Pelanggan') or ($kode=='Semua Produk' and $cus=='')){
			$this->db->select('sum(jml_beli) as total');
			$this->db->from('tb_order');
			$this->db->where("tb_detail_order.jenis_order", $jenis);
			$this->db->where('tb_order.tanggal_transaksi >=', $awal);
			$this->db->where('tb_order.tanggal_transaksi <=', $akhir);
			$this->db->where('tb_order.id_marketing', $id_marketing);
			$this->db->where('tb_order.harga !=',0);
			$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
		}else if(($kode!='' and $cus=='Semua Pelanggan')or ($kode!='Semua Produk' and $cus=='')){
			$this->db->select('sum(jml_beli) as total');
			$this->db->from('tb_order');
			$this->db->where("tb_detail_order.jenis_order", $jenis);
			$this->db->where("tb_order.id_produk", $kode);
			$this->db->where('tb_order.tanggal_transaksi >=', $awal);
			$this->db->where('tb_order.tanggal_transaksi <=', $akhir);
			$this->db->where('tb_order.id_marketing', $id_marketing);
			$this->db->where('tb_order.harga !=',0);
			$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
		}else if(($kode=='' and $cus!='Semua Pelanggan') or ($kode=='Semua Produk' and $cus!='')){
			$this->db->select('sum(jml_beli) as total');
			$this->db->from('tb_order');
			$this->db->where("tb_detail_order.jenis_order", $jenis);
			$this->db->where("tb_pelanggan.jenis_pelanggan", $cus);
			$this->db->where('tb_order.tanggal_transaksi >=', $awal);
			$this->db->where('tb_order.tanggal_transaksi <=', $akhir);
			$this->db->where('tb_order.id_marketing', $id_marketing);
			$this->db->where('tb_order.harga !=',0);
			$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
			$this->db->join('tb_pelanggan','tb_pelanggan.id_pelanggan = tb_order.id_pelanggan', 'left');
		}else{
			$this->db->select('sum(jml_beli) as total');
			$this->db->from('tb_order');
			$this->db->where("tb_detail_order.jenis_order", $jenis);
			$this->db->where("tb_order.id_produk", $kode);
			$this->db->where("tb_pelanggan.jenis_pelanggan", $cus);
			$this->db->where('tb_order.tanggal_transaksi >=', $awal);
			$this->db->where('tb_order.tanggal_transaksi <=', $akhir);
			$this->db->where('tb_order.id_marketing', $id_marketing);
			$this->db->where('tb_order.harga !=',0);
			$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
			$this->db->join('tb_pelanggan','tb_pelanggan.id_pelanggan = tb_order.id_pelanggan', 'left');
		}
		$query = $this->db->get();
		return $query->row();
	}
	public function report_hari($kode, $jenis, $awal, $akhir, $id_marketing){
		if(($kode=='' and $jenis=='Semua Pelanggan') or ($kode=='' and $jenis=='')){
			$this->db->select('sum(jml_beli) as total');
			$this->db->from('tb_order');
			$this->db->where('tb_order.tanggal_transaksi >=', $awal);
			$this->db->where('tb_order.tanggal_transaksi <=', $akhir);
			$this->db->where('tb_order.id_marketing', $id_marketing);
			$this->db->where('tb_order.harga !=',0);
			$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
		}else if(($kode!='' and $jenis=='Semua Pelanggan') or ($kode!='' and $jenis=='')){
			$this->db->select('sum(jml_beli) as total');
			$this->db->from('tb_order');
			$this->db->where("id_produk", $kode);
			$this->db->where('tb_order.tanggal_transaksi >=', $awal);
			$this->db->where('tb_order.tanggal_transaksi <=', $akhir);
			$this->db->where('tb_order.id_marketing', $id_marketing);
			$this->db->where('tb_order.harga !=',0);
		}else if(($kode=='' and $jenis!='Semua Pelanggan') or ($kode=='' and $jenis!='')){
			$this->db->select('sum(jml_beli) as total');
			$this->db->from('tb_order');
			$this->db->where("tb_pelanggan.jenis_pelanggan", $jenis);
			$this->db->where('tb_order.tanggal_transaksi >=', $awal);
			$this->db->where('tb_order.tanggal_transaksi <=', $akhir);
			$this->db->where('tb_order.id_marketing', $id_marketing);
			$this->db->where('tb_order.harga !=',0);
			$this->db->join('tb_pelanggan','tb_pelanggan.id_pelanggan = tb_order.id_pelanggan', 'left');
		}else{
			$this->db->select('sum(jml_beli) as total, sum(tb_detail_order.ongkir) as ongkir, tb_pelanggan.jenis_pelanggan');
			$this->db->from('tb_order');
			$this->db->join('tb_pelanggan','tb_pelanggan.id_pelanggan = tb_order.id_pelanggan', 'left');
			$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
			$this->db->where("id_produk", $kode);
			$this->db->where("tb_pelanggan.jenis_pelanggan", $jenis);
			$this->db->where('tb_order.tanggal_transaksi >=', $awal);
			$this->db->where('tb_order.tanggal_transaksi <=', $akhir);
			$this->db->where('tb_order.id_marketing', $id_marketing);
			$this->db->where('tb_order.harga !=',0);
		}
		$query = $this->db->get();
		return $query->row();
	}
	public function lap_bulan($bulan, $tahun, $id_marketing){
		$this->db->select('tb_order.*,
							tb_pelanggan.nama_pelanggan, 
							tb_pelanggan.jenis_pelanggan,
							tb_produk.nama_produk, 
							tb_marketing.nama_marketing,tb_detail_order.metode_pembayaran, tb_detail_order.jenis_order,tb_detail_order.status_bayar,tb_detail_order.ongkir');
		$this->db->from('tb_order');
		$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%Y')", $tahun);
		$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%m')", $bulan);
		$this->db->where('tb_order.id_marketing', $id_marketing);
			$this->db->where('tb_order.harga !=',0);
		$this->db->join('tb_pelanggan','tb_pelanggan.id_pelanggan = tb_order.id_pelanggan', 'left');
		$this->db->join('tb_produk','tb_produk.kode_produk = tb_order.id_produk', 'left');
		$this->db->join('tb_marketing','tb_marketing.id_marketing = tb_order.id_marketing', 'left');
		$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
		$this->db->order_by('tb_order.kode_transaksi','asc');
		$query = $this->db->get();
		return $query->result();
	}
	public function ongkir_bulan($bulan, $tahun, $id_marketing){
		$this->db->select('sum(tb_detail_order.ongkir) as ongkir');
		$this->db->from('tb_detail_order');
		$this->db->where("DATE_FORMAT(tanggal_transaksi,'%Y')", $tahun);
		$this->db->where("DATE_FORMAT(tanggal_transaksi,'%m')", $bulan);
		$this->db->where('id_marketing', $id_marketing);
		$query = $this->db->get();
		return $query->row();
	}
	public function report_bulanan($bulan,$tahun, $id_marketing){
		$this->db->select('sum(jml_beli) as total');
		$this->db->from('tb_order');
		$this->db->where("DATE_FORMAT(tanggal_transaksi,'%Y')", $tahun);
		$this->db->where("DATE_FORMAT(tanggal_transaksi,'%m')", $bulan);
		$this->db->where('id_marketing', $id_marketing);
		$this->db->where('harga !=',0);
		$query = $this->db->get();
		return $query->row();
	}
	public function jenis_bulan($jenis, $bulan, $tahun, $id_marketing){
		$this->db->select('sum(jml_beli) as total');
		$this->db->from('tb_order');
		$this->db->where("tb_detail_order.jenis_order", $jenis);
		$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%Y')", $tahun);
		$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%m')", $bulan);
		$this->db->where('tb_order.id_marketing', $id_marketing);
			$this->db->where('tb_order.harga !=',0);
		$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
		$query = $this->db->get();
		return $query->row();
	}
	public function jenisorder_bulan($kode, $cus, $jenis, $bulan, $tahun, $id_marketing){
		if(($kode=='' and $cus=='Semua Pelanggan') or ($kode=='Semua Produk' and $cus=='')){
			$this->db->select('sum(jml_beli) as total');
			$this->db->from('tb_order');
			$this->db->where("tb_detail_order.jenis_order", $jenis);
			$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%Y')", $tahun);
			$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%m')", $bulan);
			$this->db->where('tb_order.id_marketing', $id_marketing);
			$this->db->where('tb_order.harga !=',0);
			$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
		}else if(($kode!='' and $cus=='Semua Pelanggan')or ($kode!='Semua Produk' and $cus=='')){
			$this->db->select('sum(jml_beli) as total');
			$this->db->from('tb_order');
			$this->db->where("tb_detail_order.jenis_order", $jenis);
			$this->db->where("tb_order.id_produk", $kode);
			$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%Y')", $tahun);
			$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%m')", $bulan);
			$this->db->where('tb_order.id_marketing', $id_marketing);
			$this->db->where('tb_order.harga !=',0);
			$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
		}else if(($kode=='' and $cus!='Semua Pelanggan') or ($kode=='Semua Produk' and $cus!='')){
			$this->db->select('sum(jml_beli) as total');
			$this->db->from('tb_order');
			$this->db->where("tb_detail_order.jenis_order", $jenis);
			$this->db->where("tb_pelanggan.jenis_pelanggan", $cus);
			$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%Y')", $tahun);
			$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%m')", $bulan);
			$this->db->where('tb_order.id_marketing', $id_marketing);
			$this->db->where('tb_order.harga !=',0);
			$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
			$this->db->join('tb_pelanggan','tb_pelanggan.id_pelanggan = tb_order.id_pelanggan', 'left');
		}else{
			$this->db->select('sum(jml_beli) as total');
			$this->db->from('tb_order');
			$this->db->where("tb_detail_order.jenis_order", $jenis);
			$this->db->where("tb_order.id_produk", $kode);
			$this->db->where("tb_pelanggan.jenis_pelanggan", $cus);
			$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%Y')", $tahun);
			$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%m')", $bulan);
			$this->db->where('tb_order.id_marketing', $id_marketing);
			$this->db->where('tb_order.harga !=',0);
			$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
			$this->db->join('tb_pelanggan','tb_pelanggan.id_pelanggan = tb_order.id_pelanggan', 'left');
		}
		$query = $this->db->get();
		return $query->row();
	}
	public function report_bulan($kode, $jenis, $bulan, $tahun, $id_marketing){
		if(($kode=='' and $jenis=='Semua Pelanggan') or ($kode=='' and $jenis=='')){
			$this->db->select('sum(jml_beli) as total');
			$this->db->from('tb_order');
			$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%Y')", $tahun);
			$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%m')", $bulan);
			$this->db->where('tb_order.id_marketing', $id_marketing);
			$this->db->where('tb_order.harga !=',0);
			$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
		}else if(($kode!='' and $jenis=='Semua Pelanggan') or ($kode!='' and $jenis=='')){
			$this->db->select('sum(jml_beli) as total');
			$this->db->from('tb_order');
			$this->db->where("id_produk", $kode);
			$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%Y')", $tahun);
			$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%m')", $bulan);
			$this->db->where('id_marketing', $id_marketing);
			$this->db->where('harga !=',0);
		}else if(($kode=='' and $jenis!='Semua Pelanggan') or ($kode=='' and $jenis!='')){
			$this->db->select('sum(jml_beli) as total');
			$this->db->from('tb_order');
			$this->db->where("tb_pelanggan.jenis_pelanggan", $jenis);
			$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%Y')", $tahun);
			$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%m')", $bulan);
			$this->db->where('tb_order.id_marketing', $id_marketing);
			$this->db->where('tb_order.harga !=',0);
			$this->db->join('tb_pelanggan','tb_pelanggan.id_pelanggan = tb_order.id_pelanggan', 'left');
		}else{
			$this->db->select('sum(jml_beli) as total, sum(tb_detail_order.ongkir) as ongkir, tb_pelanggan.jenis_pelanggan');
			$this->db->from('tb_order');
			$this->db->join('tb_pelanggan','tb_pelanggan.id_pelanggan = tb_order.id_pelanggan', 'left');
			$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
			$this->db->where("id_produk", $kode);
			$this->db->where("tb_pelanggan.jenis_pelanggan", $jenis);
			$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%Y')", $tahun);
			$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%m')", $bulan);
			$this->db->where('tb_order.id_marketing', $id_marketing);
			$this->db->where('tb_order.harga !=',0);
		}
		$query = $this->db->get();
		return $query->row();
	}
	public function lap_tahun($tahun, $id_marketing){
		$this->db->select('tb_order.*,
							tb_pelanggan.nama_pelanggan, 
							tb_pelanggan.jenis_pelanggan,
							tb_produk.nama_produk, 
							tb_marketing.nama_marketing,tb_detail_order.metode_pembayaran, tb_detail_order.jenis_order,tb_detail_order.status_bayar,tb_detail_order.ongkir');
		$this->db->from('tb_order');
		$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%Y')", $tahun);
		$this->db->where('tb_order.id_marketing', $id_marketing);
		$this->db->where('tb_order.harga !=',0);
		$this->db->join('tb_pelanggan','tb_pelanggan.id_pelanggan = tb_order.id_pelanggan', 'left');
		$this->db->join('tb_produk','tb_produk.kode_produk = tb_order.id_produk', 'left');
		$this->db->join('tb_marketing','tb_marketing.id_marketing = tb_order.id_marketing', 'left');
		$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
		$this->db->group_by('tb_order.kode_transaksi');
		$this->db->order_by('tb_order.kode_transaksi','asc');
		$query = $this->db->get();
		return $query->result();
	}
	public function ongkir_tahun($tahun, $id_marketing){
		$this->db->select('sum(tb_detail_order.ongkir) as ongkir');
		$this->db->from('tb_detail_order');
		$this->db->where("DATE_FORMAT(tanggal_transaksi,'%Y')", $tahun);
		$this->db->where('id_marketing', $id_marketing);
		$query = $this->db->get();
		return $query->row();
	}
	public function report_tahunan($tahun, $id_marketing){
		$this->db->select('sum(jml_beli) as total');
		$this->db->from('tb_order');
		$this->db->where("DATE_FORMAT(tanggal_transaksi,'%Y')", $tahun);
		$this->db->where('id_marketing', $id_marketing);
		$this->db->where('harga !=',0);
		$query = $this->db->get();
		return $query->row();
	}
	public function jenis_tahun($jenis, $tahun, $id_marketing){
		$this->db->select('sum(jml_beli) as total');
		$this->db->from('tb_order');
		$this->db->where("tb_detail_order.jenis_order", $jenis);
		$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%Y')", $tahun);
		$this->db->where('tb_order.id_marketing', $id_marketing);
		$this->db->where('tb_order.harga !=',0);
		$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
		$query = $this->db->get();
		return $query->row();
	}
	public function jenisorder_tahun($kode, $cus, $jenis, $tahun, $id_marketing){
		if(($kode=='' and $cus=='Semua Pelanggan') or ($kode=='Semua Produk' and $cus=='')){
			$this->db->select('sum(jml_beli) as total');
			$this->db->from('tb_order');
			$this->db->where("tb_detail_order.jenis_order", $jenis);
			$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%Y')", $tahun);
			$this->db->where('tb_order.id_marketing', $id_marketing);
			$this->db->where('tb_order.harga !=',0);
			$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
		}else if(($kode!='' and $cus=='Semua Pelanggan')or ($kode!='Semua Produk' and $cus=='')){
			$this->db->select('sum(jml_beli) as total');
			$this->db->from('tb_order');
			$this->db->where("tb_detail_order.jenis_order", $jenis);
			$this->db->where("tb_order.id_produk", $kode);
			$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%Y')", $tahun);
			$this->db->where('tb_order.id_marketing', $id_marketing);
			$this->db->where('tb_order.harga !=',0);
			$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
		}else if(($kode=='' and $cus!='Semua Pelanggan') or ($kode=='Semua Produk' and $cus!='')){
			$this->db->select('sum(jml_beli) as total');
			$this->db->from('tb_order');
			$this->db->where("tb_detail_order.jenis_order", $jenis);
			$this->db->where("tb_pelanggan.jenis_pelanggan", $cus);
			$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%Y')", $tahun);
			$this->db->where('tb_order.id_marketing', $id_marketing);
			$this->db->where('tb_order.harga !=',0);
			$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
			$this->db->join('tb_pelanggan','tb_pelanggan.id_pelanggan = tb_order.id_pelanggan', 'left');
		}else{
			$this->db->select('sum(jml_beli) as total');
			$this->db->from('tb_order');
			$this->db->where("tb_detail_order.jenis_order", $jenis);
			$this->db->where("tb_order.id_produk", $kode);
			$this->db->where("tb_pelanggan.jenis_pelanggan", $cus);
			$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%Y')", $tahun);
			$this->db->where('tb_order.id_marketing', $id_marketing);
			$this->db->where('tb_order.harga !=',0);
			$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
			$this->db->join('tb_pelanggan','tb_pelanggan.id_pelanggan = tb_order.id_pelanggan', 'left');
		}
		$query = $this->db->get();
		return $query->row();
	}

	public function report_tahun($kode, $jenis, $tahun, $id_marketing){
		if(($kode=='' and $jenis=='Semua Pelanggan') or ($kode=='' and $jenis=='')){
			$this->db->select('sum(jml_beli) as total');
			$this->db->from('tb_order');
			$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%Y')", $tahun);
			$this->db->where('tb_order.id_marketing', $id_marketing);
			$this->db->where('tb_order.harga !=',0);
			$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
		}else if(($kode!='' and $jenis=='Semua Pelanggan') or ($kode!='' and $jenis=='')){
			$this->db->select('sum(jml_beli) as total');
			$this->db->from('tb_order');
			$this->db->where("id_produk", $kode);
			$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%Y')", $tahun);
			$this->db->where('tb_order.id_marketing', $id_marketing);
			$this->db->where('tb_order.harga !=',0);
		}else if(($kode=='' and $jenis!='Semua Pelanggan') or ($kode=='' and $jenis!='')){
			$this->db->select('sum(jml_beli) as total');
			$this->db->from('tb_order');
			$this->db->where("tb_pelanggan.jenis_pelanggan", $jenis);
			$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%Y')", $tahun);
			$this->db->where('tb_order.id_marketing', $id_marketing);
			$this->db->where('tb_order.harga !=',0);
			$this->db->join('tb_pelanggan','tb_pelanggan.id_pelanggan = tb_order.id_pelanggan', 'left');
		}else{
			$this->db->select('sum(jml_beli) as total, sum(tb_detail_order.ongkir) as ongkir, tb_pelanggan.jenis_pelanggan');
			$this->db->from('tb_order');
			$this->db->join('tb_pelanggan','tb_pelanggan.id_pelanggan = tb_order.id_pelanggan', 'left');
			$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
			$this->db->where("id_produk", $kode);
			$this->db->where("tb_pelanggan.jenis_pelanggan", $jenis);
			$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%Y')", $tahun);
			$this->db->where('tb_order.id_marketing', $id_marketing);
			$this->db->where('tb_order.harga !=',0);
		}
		$query = $this->db->get();
		return $query->row();
	}
	// report marketing admin
	public function count_order($data){
		$this->db->select('sum(jml_beli) as total');
		$this->db->from('tb_order');
		$this->db->where('id_marketing', $data['id']); 
	  	$this->db->where('harga!=', 0);
	  	$this->db->where("DATE_FORMAT(tanggal_transaksi,'%Y')", date('Y'));
	  	$this->db->where("DATE_FORMAT(tanggal_transaksi,'%m')", date('m'));
	  	return $this->db->get()->row();
	}
	public function count_organik($data){
		$this->db->select('sum(tb_order.jml_beli) as total');
	  	$this->db->from('tb_order');
	  	$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
	  	$this->db->where('tb_order.id_marketing', $data['id']); 
	  	$this->db->where('tb_detail_order.jenis_order', 2); 
	  	$this->db->where('tb_order.harga!=', 0);
	  	$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%Y')", date('Y'));
	  	$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%m')", date('m'));
	
  	return $this->db->get()->row();
	}
	public function count_ads($data){
		$this->db->select('sum(tb_order.jml_beli) as total');
	  	$this->db->from('tb_order');
	  	$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
	  	$this->db->where('tb_order.id_marketing', $data['id']); 
	  	$this->db->where('tb_detail_order.jenis_order', 1); 
	  	$this->db->where('tb_order.harga!=', 0);
	  	$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%Y')", date('Y'));
	  	$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%m')", date('m'));
  	return $this->db->get()->row();
	}
	//tanggal
	public function order_tgl($data){
		$this->db->select('sum(jml_beli) as total');
		$this->db->from('tb_order');
		$this->db->where('id_marketing', $data['id']); 
	  	$this->db->where('harga!=', 0);
	  	$this->db->where('tanggal_transaksi >=', $data['awal']);
		$this->db->where('tanggal_transaksi <=', $data['akhir']);
	  	return $this->db->get()->row();
	}
	public function organik_tgl($data){
		$this->db->select('sum(tb_order.jml_beli) as total');
	  	$this->db->from('tb_order');
	  	$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
	  	$this->db->where('tb_order.id_marketing', $data['id']); 
	  	$this->db->where('tb_detail_order.jenis_order', 2); 
	  	$this->db->where('tb_order.harga!=', 0);
	  	$this->db->where('tb_order.tanggal_transaksi >=', $data['awal']);
		$this->db->where('tb_order.tanggal_transaksi <=', $data['akhir']);
	
  	return $this->db->get()->row();
	}
	public function ads_tgl($data){
		$this->db->select('sum(tb_order.jml_beli) as total');
	  	$this->db->from('tb_order');
	  	$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
	  	$this->db->where('tb_order.id_marketing', $data['id']); 
	  	$this->db->where('tb_detail_order.jenis_order', 1); 
	  	$this->db->where('tb_order.harga!=', 0);
	  	$this->db->where('tb_order.tanggal_transaksi >=', $data['awal']);
		$this->db->where('tb_order.tanggal_transaksi <=', $data['akhir']);
  	return $this->db->get()->row();
	}
	//bulan
	public function order_bln($data){
		$this->db->select('sum(jml_beli) as total');
		$this->db->from('tb_order');
		$this->db->where('id_marketing', $data['id']); 
	  	$this->db->where('harga!=', 0);
	  	$this->db->where("DATE_FORMAT(tanggal_transaksi,'%Y')", $data['awal']);
	  	$this->db->where("DATE_FORMAT(tanggal_transaksi,'%m')", $data['akhir']);
	  	return $this->db->get()->row();
	}
	public function organik_bln($data){
		$this->db->select('sum(tb_order.jml_beli) as total');
	  	$this->db->from('tb_order');
	  	$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
	  	$this->db->where('tb_order.id_marketing', $data['id']); 
	  	$this->db->where('tb_detail_order.jenis_order', 2); 
	  	$this->db->where('tb_order.harga!=', 0);
	  	$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%Y')", $data['awal']);
	  	$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%m')", $data['akhir']);
	
  	return $this->db->get()->row();
	}
	public function ads_bln($data){
		$this->db->select('sum(tb_order.jml_beli) as total');
	  	$this->db->from('tb_order');
	  	$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
	  	$this->db->where('tb_order.id_marketing', $data['id']); 
	  	$this->db->where('tb_detail_order.jenis_order', 1); 
	  	$this->db->where('tb_order.harga!=', 0);
	  	$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%Y')", $data['awal']);
	  	$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%m')", $data['akhir']);
  	return $this->db->get()->row();
	}
	//tahun
	public function order_thn($data){
		$this->db->select('sum(jml_beli) as total');
		$this->db->from('tb_order');
		$this->db->where('id_marketing', $data['id']); 
	  	$this->db->where('harga!=', 0);
	  	$this->db->where("DATE_FORMAT(tanggal_transaksi,'%Y')", $data['awal']);
	  	return $this->db->get()->row();
	}
	public function organik_thn($data){
		$this->db->select('sum(tb_order.jml_beli) as total');
	  	$this->db->from('tb_order');
	  	$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
	  	$this->db->where('tb_order.id_marketing', $data['id']); 
	  	$this->db->where('tb_detail_order.jenis_order', 2); 
	  	$this->db->where('tb_order.harga!=', 0);
	  	$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%Y')", $data['awal']);
	
  	return $this->db->get()->row();
	}
	public function ads_thn($data){
		$this->db->select('sum(tb_order.jml_beli) as total');
	  	$this->db->from('tb_order');
	  	$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
	  	$this->db->where('tb_order.id_marketing', $data['id']); 
	  	$this->db->where('tb_detail_order.jenis_order', 1); 
	  	$this->db->where('tb_order.harga!=', 0);
	  	$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%Y')", $data['awal']);
  	return $this->db->get()->row();
  }
}