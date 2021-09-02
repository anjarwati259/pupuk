<?php 

/**
 * 
 */
class Order_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	//menampilkan data order berdasarkan status bayar
	public function listing_admin($data){
		$this->db->select('tb_detail_order.*,
							tb_pelanggan.nama_pelanggan, tb_pembayaran.jumlah_bayar, tb_marketing.nama_marketing, tb_pelanggan.jenis_pelanggan');
		$this->db->from('tb_detail_order');
		$this->db->where('status_bayar', $data);
		$this->db->join('tb_pelanggan','tb_pelanggan.id_pelanggan = tb_detail_order.id_pelanggan', 'left');
		$this->db->join('tb_pembayaran','tb_pembayaran.kode_transaksi = tb_detail_order.kode_transaksi', 'left');
		$this->db->join('tb_marketing','tb_marketing.id_marketing = tb_detail_order.id_marketing', 'left');
		$this->db->group_by('tb_detail_order.kode_transaksi');
		$this->db->order_by('kode_transaksi','desc');
		$query = $this->db->get();
		return $query->result();
	}
	//menampilkan data order berdasarkan status bayar dan id marketing
	public function list_belum($id_marketing,$data){
		$this->db->select('tb_detail_order.*,
							tb_pelanggan.nama_pelanggan, tb_pembayaran.jumlah_bayar');
		$this->db->from('tb_detail_order');
		$this->db->where('tb_detail_order.status_bayar', $data);
		$this->db->where('tb_detail_order.id_marketing', $id_marketing);
		$this->db->join('tb_pelanggan','tb_pelanggan.id_pelanggan = tb_detail_order.id_pelanggan', 'left');
		$this->db->join('tb_pembayaran','tb_pembayaran.kode_transaksi = tb_detail_order.kode_transaksi', 'left');
		$this->db->group_by('tb_detail_order.kode_transaksi');
		$this->db->order_by('kode_transaksi','desc');
		$query = $this->db->get();
		return $query->result();
	}
	public function list_order($id_marketing,$data){
		$this->db->select('tb_detail_order.*,
							tb_pelanggan.nama_pelanggan, tb_pembayaran.jumlah_bayar');
		$this->db->from('tb_detail_order');
		$this->db->where('tb_detail_order.status_bayar', $data);
		$this->db->where('tb_detail_order.id_marketing', $id_marketing);
		$this->db->join('tb_pelanggan','tb_pelanggan.id_pelanggan = tb_detail_order.id_pelanggan', 'left');
		$this->db->join('tb_pembayaran','tb_pembayaran.kode_transaksi = tb_detail_order.kode_transaksi', 'left');
		$this->db->group_by('tb_detail_order.kode_transaksi');
		$this->db->order_by('kode_transaksi','desc');
		$query = $this->db->get();
		return $query->result();
	}
	
	//menampilkan data order berdasarkan status bayar dan id marketing
	public function all_list($id_marketing){
		$this->db->select('tb_detail_order.*,
							tb_pelanggan.nama_pelanggan, tb_pembayaran.jumlah_bayar');
		$this->db->from('tb_detail_order');
		$this->db->where('tb_detail_order.id_marketing', $id_marketing);
		$this->db->join('tb_pelanggan','tb_pelanggan.id_pelanggan = tb_detail_order.id_pelanggan', 'left');
		$this->db->join('tb_pembayaran','tb_pembayaran.kode_transaksi = tb_detail_order.kode_transaksi', 'left');
		$this->db->group_by('tb_detail_order.kode_transaksi');
		$this->db->order_by('kode_transaksi','asc');
		$query = $this->db->get();
		return $query->result();
	}
	//get jenis pelanggan
	public function jenis_pelanggan($kode_transaksi){
		$this->db->select('tb_pelanggan.jenis_pelanggan');
		$this->db->from('tb_detail_order');
		$this->db->where('kode_transaksi', $kode_transaksi);
		$this->db->join('tb_pelanggan','tb_pelanggan.id_pelanggan = tb_detail_order.id_pelanggan', 'left');
		$this->db->order_by('kode_transaksi','asc');
		$query = $this->db->get();
		return $query->row();
	}
	//menampilkan data order berdasarkan status bayar
	public function point_list($kode_transaksi){
		$this->db->select('tb_order.*, tb_pelanggan.jenis_pelanggan');
		$this->db->from('tb_order');
		$this->db->where('harga!=',0);
		$this->db->where('kode_transaksi', $kode_transaksi);
		$this->db->join('tb_pelanggan','tb_pelanggan.id_pelanggan = tb_order.id_pelanggan', 'left');
		$this->db->order_by('kode_transaksi','asc');
		$query = $this->db->get();
		return $query->result();
	}
	//menampilkan semua data order berdasarkan id user
	public function listing($id_user){
		$this->db->select('*');
		$this->db->from('tb_detail_order');
		$this->db->where('id_user', $id_user);
		$this->db->order_by('kode_transaksi','desc');
		$query = $this->db->get();
		return $query->result();
	}
	//menampilkan semua data order berdasarkan id user
	public function last_point($id_pelanggan){
		$this->db->select('total_point');
		$this->db->from('tb_point');
		$this->db->where('id_pelanggan', $id_pelanggan);
		$this->db->order_by('id_point','desc');
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->row();
	}
	//menampilkan semua data order
	public function Alllisting(){
		$this->db->select('tb_detail_order.*, tb_marketing.nama_marketing');
		$this->db->from('tb_detail_order');
		$this->db->join('tb_marketing','tb_marketing.id_marketing = tb_detail_order.id_marketing', 'left');
		$this->db->order_by('tanggal_transaksi','desc');
		$query = $this->db->get();
		return $query->result();
	}
	//menampilkan semua data order customer
	public function allorder($data){
		$this->db->select('tb_detail_order.*, tb_marketing.nama_marketing, tb_pelanggan.jenis_pelanggan');
		$this->db->from('tb_detail_order');
		$this->db->join('tb_marketing','tb_marketing.id_marketing = tb_detail_order.id_marketing', 'left');
		$this->db->join('tb_pelanggan','tb_pelanggan.id_pelanggan = tb_detail_order.id_pelanggan', 'left');
		$this->db->where('tb_pelanggan.jenis_pelanggan', $data);
		$this->db->order_by('tanggal_transaksi','desc');
		$query = $this->db->get();
		return $query->result();
	}
	//mendapatkan data transaksi berdasarkan kodenya
	public function kode_order($kode_transaksi){
		$this->db->select('tb_order.*,
						tb_produk.nama_produk, tb_promo.nama_promo as nama, tb_produk.gambar');
		$this->db->from('tb_order');
		//join
		$this->db->join('tb_produk', 'tb_produk.kode_produk = tb_order.id_produk', 'left');
		$this->db->join('tb_promo', 'tb_promo.id_promo = tb_order.id_promo', 'left');
		//end join
		$this->db->where('kode_transaksi', $kode_transaksi);
		// $this->db->group_by('tb_order.kode_transaksi');
		$this->db->order_by('id_order','asc');
		$query = $this->db->get();
		return $query->result();
	}
	//detail
	public function kode_transaksi($kode_transaksi){
		$this->db->select('tb_detail_order.*, tb_rekening.nama_bank, tb_rekening.no_rekening, tb_marketing.nama_marketing');
		$this->db->from('tb_detail_order');
		//join
		$this->db->join('tb_rekening', 'tb_rekening.id_rekening = tb_detail_order.id_rekening', 'left');
		$this->db->join('tb_marketing', 'tb_marketing.id_marketing = tb_detail_order.id_marketing', 'left');
		//end join
		$this->db->where('kode_transaksi', $kode_transaksi);
		$this->db->order_by('kode_transaksi','desc');
		$query = $this->db->get();
		return $query->row();
	}
	//update status untuk konfirmasi jika sudah dibayar
	public function update_status($data)
	{
		$this->db->where('kode_transaksi', $data['kode_transaksi']);
		$this->db->update('tb_detail_order',$data);
	}
	//pembayaran
	public function bayar($data){
		$this->db->insert('tb_pembayaran', $data);
	}
	//tambah detail order
	public function tambah($data)
	{
		$this->db->insert('tb_detail_order', $data);
	}
	//tambah point
	public function tambah_point($data)
	{
		$this->db->insert('tb_point', $data);
	}
	//tambah order
	public function tambah_order($data)
	{
		$this->db->insert('tb_order', $data);
	}
	//tambah order
	public function tambahorder($data)
	{
		$this->db->insert_batch('tb_order', $data);
	}
	//digunakan untuk mencari kode transaksi terakhir
	public function get_last_id(){
		$this->db->order_by('tanggal_transaksi', 'DESC');

		$query = $this->db->get("tb_detail_order",1,0);
		return $query->result();
	}
	//digunakan untuk mencari nama
	public function getnama($nama){
		$this->db->like('nama_pelanggan', $nama , 'both');
        $this->db->order_by('nama_pelanggan', 'ASC');
        $this->db->limit(10);
        return $this->db->get('tb_pelanggan')->result();
	}
	//tambah stok
	public function tambah_stok($data)
	{
		$this->db->insert('tb_stok', $data);
	}
	//tambah stok customer
	public function stok($data)
	{
		$this->db->insert_batch('tb_stok', $data);
	}
	//batal pesanan
	public function batal($kode_transaksi)
	{
	$this->db->where('kode_transaksi',$kode_transaksi);
    $this->db->delete('tb_stok');
	}
	public function get_stok($kode_transaksi)
	{
		$this->db->select('*');
		$this->db->from('tb_order');
		$this->db->where('kode_transaksi', $kode_transaksi);
		$this->db->order_by('kode_transaksi','desc');
		$query = $this->db->get();
		return $query->result();
	}
	public function reward(){
		$this->db->select('m1.*, tb_pelanggan.nama_pelanggan');
		$this->db->from('tb_point m1');
		//join
		$this->db->join('tb_point m2', 'm1.id_pelanggan = m2.id_pelanggan AND m1.id_point < m2.id_point', 'left');
		$this->db->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = m1.id_pelanggan', 'left');
		//end join
		$this->db->where('m2.id_point',NULL);
		$this->db->order_by('m1.id_pelanggan','asc');
		$query = $this->db->get();
		return $query->result();
	}
	public function detailreward($id_pelanggan){
		$this->db->select('*');
		$this->db->from('tb_point');
		$this->db->where('tb_point.id_pelanggan', $id_pelanggan);
		$this->db->order_by('tb_point.id_point','asc');
		$query = $this->db->get();
		return $query->result();
	}
	//edit data pelanggan
	public function status_baca($data){
		$this->db->where('kode_transaksi', $data['kode_transaksi']);
		$this->db->update('tb_detail_order',$data);
	}
	public function expedisi(){
		$this->db->select('*');
		$this->db->from('tb_expedisi');
		$this->db->order_by('id_expedisi','asc');
		$query = $this->db->get();
		return $query->result();
	}


// ====================== Report ==================== //
	public function laporan(){
		$this->db->select('tb_order.*,
							tb_pelanggan.nama_pelanggan, 
							tb_pelanggan.jenis_pelanggan,
							tb_produk.nama_produk, 
							tb_marketing.nama_marketing,tb_detail_order.metode_pembayaran, tb_detail_order.jenis_order,tb_detail_order.status_bayar,tb_detail_order.ongkir');
		$this->db->from('tb_order');
		$this->db->where('tb_order.harga !=',0);
		$this->db->join('tb_pelanggan','tb_pelanggan.id_pelanggan = tb_order.id_pelanggan', 'left');
		$this->db->join('tb_produk','tb_produk.kode_produk = tb_order.id_produk', 'left');
		$this->db->join('tb_marketing','tb_marketing.id_marketing = tb_order.id_marketing', 'left');
		$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
		$this->db->order_by('tb_order.kode_transaksi','asc');
		$query = $this->db->get();
		return $query->result();
	}
	public function report($kode, $jenis){
		if(($kode=='' and $jenis=='Semua Pelanggan') or ($kode=='' and $jenis=='')){
			$this->db->select('sum(jml_beli) as total');
			$this->db->from('tb_order');
			$this->db->where('harga !=',0);
			$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
		}else if(($kode!='' and $jenis=='Semua Pelanggan') or ($kode!='' and $jenis=='')){
			$this->db->select('sum(jml_beli) as total');
			$this->db->from('tb_order');
			$this->db->where("id_produk", $kode);
			$this->db->where('harga !=',0);
		}else if(($kode=='' and $jenis!='Semua Pelanggan') or ($kode=='' and $jenis!='')){
			$this->db->select('sum(jml_beli) as total');
			$this->db->from('tb_order');
			$this->db->where("tb_pelanggan.jenis_pelanggan", $jenis);
			$this->db->where('harga !=',0);
			$this->db->join('tb_pelanggan','tb_pelanggan.id_pelanggan = tb_order.id_pelanggan', 'left');
		}else{
			$this->db->select('sum(jml_beli) as total, sum(tb_detail_order.ongkir) as ongkir, tb_pelanggan.jenis_pelanggan');
			$this->db->from('tb_order');
			$this->db->join('tb_pelanggan','tb_pelanggan.id_pelanggan = tb_order.id_pelanggan', 'left');
			$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
			$this->db->where("id_produk", $kode);
			$this->db->where("tb_pelanggan.jenis_pelanggan", $jenis);
			$this->db->where('harga !=',0);
		}
		$query = $this->db->get();
		return $query->row();
	}
	public function report_ongkir($kode, $jenis){
		if(($kode=='' and $jenis=='Semua Pelanggan') or ($kode=='' and $jenis=='')){
			$this->db->select('sum(ongkir) as total');
			$this->db->from('tb_detail_order');
		}else if(($kode!='' and $jenis=='Semua Pelanggan') or ($kode!='' and $jenis=='')){
			$this->db->select('sum(ongkir) as total');
			$this->db->from('tb_detail_order');
			$this->db->join('tb_order','tb_order.kode_transaksi = tb_detail_order.kode_transaksi', 'left');
			$this->db->where("tb_order.id_produk", $kode);
			$this->db->where('tb_order.harga !=',0);
		}else if(($kode=='' and $jenis!='Semua Pelanggan') or ($kode=='' and $jenis!='')){
			$this->db->select('sum(ongkir) as total');
			$this->db->from('tb_detail_order');
			$this->db->join('tb_pelanggan','tb_pelanggan.kode_transaksi = tb_detail_order.kode_transaksi', 'left');
			$this->db->where("tb_pelanggan.jenis_pelanggan", $jenis);
		}else{
			$this->db->select('sum(ongkir) as total');
			$this->db->from('tb_detail_order');
			$this->db->join('tb_order','tb_order.kode_transaksi = tb_detail_order.kode_transaksi', 'left');
			$this->db->join('tb_pelanggan','tb_pelanggan.id_pelanggan = tb_detail_order.id_pelanggan', 'left');
			$this->db->where("tb_order.id_produk", $kode);
			$this->db->where('tb_order.harga !=',0);
			$this->db->where("tb_pelanggan.jenis_pelanggan", $jenis);
		}
		$query = $this->db->get();
		return $query->row();
	}
	public function report_hari($kode, $jenis, $awal, $akhir){
		if(($kode=='' and $jenis=='Semua Pelanggan') or ($kode=='' and $jenis=='')){
			$this->db->select('sum(jml_beli) as total');
			$this->db->from('tb_order');
			$this->db->where('tb_order.tanggal_transaksi >=', $awal);
			$this->db->where('tb_order.tanggal_transaksi <=', $akhir);
			$this->db->where('tb_order.harga !=',0);
			$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
		}else if(($kode!='' and $jenis=='Semua Pelanggan') or ($kode!='' and $jenis=='')){
			$this->db->select('sum(jml_beli) as total');
			$this->db->from('tb_order');
			$this->db->where("id_produk", $kode);
			$this->db->where('tb_order.tanggal_transaksi >=', $awal);
			$this->db->where('tb_order.tanggal_transaksi <=', $akhir);
			$this->db->where('tb_order.harga !=',0);
		}else if(($kode=='' and $jenis!='Semua Pelanggan') or ($kode=='' and $jenis!='')){
			$this->db->select('sum(jml_beli) as total');
			$this->db->from('tb_order');
			$this->db->where("tb_pelanggan.jenis_pelanggan", $jenis);
			$this->db->where('tb_order.tanggal_transaksi >=', $awal);
			$this->db->where('tb_order.tanggal_transaksi <=', $akhir);
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
			$this->db->where('tb_order.harga !=',0);
		}
		$query = $this->db->get();
		return $query->row();
	}
	public function report_bulan($kode, $jenis, $bulan, $tahun){
		if(($kode=='' and $jenis=='Semua Pelanggan') or ($kode=='' and $jenis=='')){
			$this->db->select('sum(jml_beli) as total');
			$this->db->from('tb_order');
			$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%Y')", $tahun);
			$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%m')", $bulan);
			$this->db->where('tb_order.harga !=',0);
			$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
		}else if(($kode!='' and $jenis=='Semua Pelanggan') or ($kode!='' and $jenis=='')){
			$this->db->select('sum(jml_beli) as total');
			$this->db->from('tb_order');
			$this->db->where("id_produk", $kode);
			$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%Y')", $tahun);
			$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%m')", $bulan);
			$this->db->where('tb_order.harga !=',0);
		}else if(($kode=='' and $jenis!='Semua Pelanggan') or ($kode=='' and $jenis!='')){
			$this->db->select('sum(jml_beli) as total');
			$this->db->from('tb_order');
			$this->db->where("tb_pelanggan.jenis_pelanggan", $jenis);
			$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%Y')", $tahun);
			$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%m')", $bulan);
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
			$this->db->where('tb_order.harga !=',0);
		}
		$query = $this->db->get();
		return $query->row();
	}
	public function report_tahun($kode, $jenis, $tahun){
		if(($kode=='' and $jenis=='Semua Pelanggan') or ($kode=='' and $jenis=='')){
			$this->db->select('sum(jml_beli) as total');
			$this->db->from('tb_order');
			$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%Y')", $tahun);
			$this->db->where('tb_order.harga !=',0);
			$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
		}else if(($kode!='' and $jenis=='Semua Pelanggan') or ($kode!='' and $jenis=='')){
			$this->db->select('sum(jml_beli) as total');
			$this->db->from('tb_order');
			$this->db->where("id_produk", $kode);
			$this->db->where('tb_order.harga !=',0);
			$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%Y')", $tahun);
		}else if(($kode=='' and $jenis!='Semua Pelanggan') or ($kode=='' and $jenis!='')){
			$this->db->select('sum(jml_beli) as total');
			$this->db->from('tb_order');
			$this->db->where("tb_pelanggan.jenis_pelanggan", $jenis);
			$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%Y')", $tahun);
			$this->db->where('tb_order.harga !=',0);
			$this->db->join('tb_pelanggan','tb_pelanggan.id_pelanggan = tb_order.id_pelanggan', 'left');
		}else{
			$this->db->select('sum(jml_beli) as total, sum(tb_detail_order.ongkir) as ongkir, tb_pelanggan.jenis_pelanggan');
			$this->db->from('tb_order');
			$this->db->join('tb_pelanggan','tb_pelanggan.id_pelanggan = tb_order.id_pelanggan', 'left');
			$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
			$this->db->where('tb_order.harga !=',0);
			$this->db->where("id_produk", $kode);
			$this->db->where("tb_pelanggan.jenis_pelanggan", $jenis);
			$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%Y')", $tahun);
		}
		$query = $this->db->get();
		return $query->row();
	}

	public function total_ongkir(){
		$this->db->select('sum(tb_detail_order.ongkir) as ongkir');
		$this->db->from('tb_detail_order');
		$query = $this->db->get();
		return $query->row();
	}
	public function ongkir_hari($awal, $akhir){
		$this->db->select('sum(ongkir) as ongkir');
		$this->db->from('tb_detail_order');
		$this->db->where("DATE(tanggal_transaksi) >=", $awal);
		$this->db->where("DATE(tanggal_transaksi) <=", $akhir);
		$query = $this->db->get();
		return $query->row();
	}
	public function ongkir_bulan($bulan, $tahun){
		$this->db->select('sum(tb_detail_order.ongkir) as ongkir');
		$this->db->from('tb_detail_order');
		$this->db->where("DATE_FORMAT(tanggal_transaksi,'%Y')", $tahun);
		$this->db->where("DATE_FORMAT(tanggal_transaksi,'%m')", $bulan);
		$query = $this->db->get();
		return $query->row();
	}
	public function ongkir_tahun($tahun){
		$this->db->select('sum(tb_detail_order.ongkir) as ongkir');
		$this->db->from('tb_detail_order');
		$this->db->where("DATE_FORMAT(tanggal_transaksi,'%Y')", $tahun);
		$query = $this->db->get();
		return $query->row();
	}
	public function jenis($jenis){
		$this->db->select('sum(jml_beli) as total');
		$this->db->from('tb_order');
		$this->db->where("tb_detail_order.jenis_order", $jenis);
		$this->db->where('tb_order.harga !=',0);
		$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
		$query = $this->db->get();
		return $query->row();
	}
	public function jenis_hari($jenis, $awal, $akhir){
		$this->db->select('sum(jml_beli) as total');
		$this->db->from('tb_order');
		$this->db->where("tb_detail_order.jenis_order", $jenis);
		$this->db->where('tb_order.tanggal_transaksi >=', $awal);
		$this->db->where('tb_order.tanggal_transaksi <=', $akhir);
		$this->db->where('tb_order.harga !=',0);
		$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
		$query = $this->db->get();
		return $query->row();
	}
	public function jenis_bulan($jenis, $bulan, $tahun){
		$this->db->select('sum(jml_beli) as total');
		$this->db->from('tb_order');
		$this->db->where("tb_detail_order.jenis_order", $jenis);
		$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%Y')", $tahun);
		$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%m')", $bulan);
		$this->db->where('tb_order.harga !=',0);
		$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
		$query = $this->db->get();
		return $query->row();
	}
	public function jenis_tahun($jenis, $tahun){
		$this->db->select('sum(jml_beli) as total');
		$this->db->from('tb_order');
		$this->db->where("tb_detail_order.jenis_order", $jenis);
		$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%Y')", $tahun);
		$this->db->where('tb_order.harga !=',0);
		$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
		$query = $this->db->get();
		return $query->row();
	}
	public function jenis_order($kode, $cus, $jenis){
		if(($kode=='' and $cus=='Semua Pelanggan') or ($kode=='Semua Produk' and $cus=='')){
			$this->db->select('sum(jml_beli) as total');
			$this->db->from('tb_order');
			$this->db->where("tb_detail_order.jenis_order", $jenis);
			$this->db->where('tb_order.harga !=',0);
			$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
		}else if(($kode!='' and $cus=='Semua Pelanggan')or ($kode!='Semua Produk' and $cus=='')){
			$this->db->select('sum(jml_beli) as total');
			$this->db->from('tb_order');
			$this->db->where("tb_detail_order.jenis_order", $jenis);
			$this->db->where("tb_order.id_produk", $kode);
			$this->db->where('tb_order.harga !=',0);
			$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
		}else if(($kode=='' and $cus!='Semua Pelanggan') or ($kode=='Semua Produk' and $cus!='')){
			$this->db->select('sum(jml_beli) as total');
			$this->db->from('tb_order');
			$this->db->where("tb_detail_order.jenis_order", $jenis);
			$this->db->where("tb_pelanggan.jenis_pelanggan", $cus);
			$this->db->where('tb_order.harga !=',0);
			$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
			$this->db->join('tb_pelanggan','tb_pelanggan.id_pelanggan = tb_order.id_pelanggan', 'left');
		}else{
			$this->db->select('sum(jml_beli) as total');
			$this->db->from('tb_order');
			$this->db->where("tb_detail_order.jenis_order", $jenis);
			$this->db->where("tb_order.id_produk", $kode);
			$this->db->where("tb_pelanggan.jenis_pelanggan", $cus);
			$this->db->where('tb_order.harga !=',0);
			$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
			$this->db->join('tb_pelanggan','tb_pelanggan.id_pelanggan = tb_order.id_pelanggan', 'left');
		}
		$query = $this->db->get();
		return $query->row();
	}
	public function jenisorder_hari($kode, $cus, $jenis, $awal, $akhir){
		if(($kode=='' and $cus=='Semua Pelanggan') or ($kode=='Semua Produk' and $cus=='')){
			$this->db->select('sum(jml_beli) as total');
			$this->db->from('tb_order');
			$this->db->where("tb_detail_order.jenis_order", $jenis);
			$this->db->where('tb_order.tanggal_transaksi >=', $awal);
			$this->db->where('tb_order.tanggal_transaksi <=', $akhir);
			$this->db->where('tb_order.harga !=',0);
			$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
		}else if(($kode!='' and $cus=='Semua Pelanggan')or ($kode!='Semua Produk' and $cus=='')){
			$this->db->select('sum(jml_beli) as total');
			$this->db->from('tb_order');
			$this->db->where("tb_detail_order.jenis_order", $jenis);
			$this->db->where("tb_order.id_produk", $kode);
			$this->db->where('tb_order.tanggal_transaksi >=', $awal);
			$this->db->where('tb_order.tanggal_transaksi <=', $akhir);
			$this->db->where('tb_order.harga !=',0);
			$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
		}else if(($kode=='' and $cus!='Semua Pelanggan') or ($kode=='Semua Produk' and $cus!='')){
			$this->db->select('sum(jml_beli) as total');
			$this->db->from('tb_order');
			$this->db->where("tb_detail_order.jenis_order", $jenis);
			$this->db->where("tb_pelanggan.jenis_pelanggan", $cus);
			$this->db->where('tb_order.tanggal_transaksi >=', $awal);
			$this->db->where('tb_order.tanggal_transaksi <=', $akhir);
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
			$this->db->where('tb_order.harga !=',0);
			$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
			$this->db->join('tb_pelanggan','tb_pelanggan.id_pelanggan = tb_order.id_pelanggan', 'left');
		}
		$query = $this->db->get();
		return $query->row();
	}
	public function jenisorder_bulan($kode, $cus, $jenis, $bulan, $tahun){
		if(($kode=='' and $cus=='Semua Pelanggan') or ($kode=='Semua Produk' and $cus=='')){
			$this->db->select('sum(jml_beli) as total');
			$this->db->from('tb_order');
			$this->db->where("tb_detail_order.jenis_order", $jenis);
			$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%Y')", $tahun);
			$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%m')", $bulan);
			$this->db->where('tb_order.harga !=',0);
			$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
		}else if(($kode!='' and $cus=='Semua Pelanggan')or ($kode!='Semua Produk' and $cus=='')){
			$this->db->select('sum(jml_beli) as total');
			$this->db->from('tb_order');
			$this->db->where("tb_detail_order.jenis_order", $jenis);
			$this->db->where("tb_order.id_produk", $kode);
			$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%Y')", $tahun);
			$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%m')", $bulan);
			$this->db->where('tb_order.harga !=',0);
			$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
		}else if(($kode=='' and $cus!='Semua Pelanggan') or ($kode=='Semua Produk' and $cus!='')){
			$this->db->select('sum(jml_beli) as total');
			$this->db->from('tb_order');
			$this->db->where("tb_detail_order.jenis_order", $jenis);
			$this->db->where("tb_pelanggan.jenis_pelanggan", $cus);
			$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%Y')", $tahun);
			$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%m')", $bulan);
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
			$this->db->where('tb_order.harga !=',0);
			$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
			$this->db->join('tb_pelanggan','tb_pelanggan.id_pelanggan = tb_order.id_pelanggan', 'left');
		}
		$query = $this->db->get();
		return $query->row();
	}
	public function jenisorder_tahun($kode, $cus, $jenis, $tahun){
		if(($kode=='' and $cus=='Semua Pelanggan') or ($kode=='Semua Produk' and $cus=='')){
			$this->db->select('sum(jml_beli) as total');
			$this->db->from('tb_order');
			$this->db->where("tb_detail_order.jenis_order", $jenis);
			$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%Y')", $tahun);
			$this->db->where('tb_order.harga !=',0);
			$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
		}else if(($kode!='' and $cus=='Semua Pelanggan')or ($kode!='Semua Produk' and $cus=='')){
			$this->db->select('sum(jml_beli) as total');
			$this->db->from('tb_order');
			$this->db->where("tb_detail_order.jenis_order", $jenis);
			$this->db->where("tb_order.id_produk", $kode);
			$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%Y')", $tahun);
			$this->db->where('tb_order.harga !=',0);
			$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
		}else if(($kode=='' and $cus!='Semua Pelanggan') or ($kode=='Semua Produk' and $cus!='')){
			$this->db->select('sum(jml_beli) as total');
			$this->db->from('tb_order');
			$this->db->where("tb_detail_order.jenis_order", $jenis);
			$this->db->where("tb_pelanggan.jenis_pelanggan", $cus);
			$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%Y')", $tahun);
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
			$this->db->where('tb_order.harga !=',0);
			$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
			$this->db->join('tb_pelanggan','tb_pelanggan.id_pelanggan = tb_order.id_pelanggan', 'left');
		}
		$query = $this->db->get();
		return $query->row();
	}
	public function report2(){
		$this->db->select('sum(jml_beli) as total');
		$this->db->from('tb_order');
		$this->db->where('tb_order.harga !=',0);
		$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
		$query = $this->db->get();
		return $query->row();
	}
	public function report_harian($awal,$akhir){
		$this->db->select('sum(jml_beli) as total');
		$this->db->from('tb_order');
		$this->db->where('tb_order.tanggal_transaksi >=', $awal);
		$this->db->where('tb_order.tanggal_transaksi <=', $akhir);
		$this->db->where('tb_order.harga !=',0);
		$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
		$query = $this->db->get();
		return $query->row();
	}
	public function report_bulanan($bulan,$tahun){
		$this->db->select('sum(jml_beli) as total');
		$this->db->from('tb_order');
		$this->db->where("DATE_FORMAT(tanggal_transaksi,'%Y')", $tahun);
		$this->db->where("DATE_FORMAT(tanggal_transaksi,'%m')", $bulan);
		$this->db->where('tb_order.harga !=',0);
		$query = $this->db->get();
		return $query->row();
	}
	public function report_tahunan($tahun){
		$this->db->select('sum(jml_beli) as total');
		$this->db->from('tb_order');
		$this->db->where("DATE_FORMAT(tanggal_transaksi,'%Y')", $tahun);
		$this->db->where('tb_order.harga !=',0);
		$query = $this->db->get();
		return $query->row();
	}
	//laporan order
	public function lap_harian($awal, $akhir){
		$this->db->select('tb_order.*,
							tb_pelanggan.nama_pelanggan, 
							tb_pelanggan.jenis_pelanggan,
							tb_produk.nama_produk, 
							tb_marketing.nama_marketing,tb_detail_order.metode_pembayaran, tb_detail_order.jenis_order,tb_detail_order.status_bayar,tb_detail_order.ongkir');
		$this->db->from('tb_order');
		$this->db->where('tb_order.tanggal_transaksi >=', $awal);
		$this->db->where('tb_order.tanggal_transaksi <=', $akhir);
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
	//laporan order
	public function lap_bulan($bulan, $tahun){
		$this->db->select('tb_order.*,
							tb_pelanggan.nama_pelanggan, 
							tb_pelanggan.jenis_pelanggan,
							tb_produk.nama_produk, 
							tb_marketing.nama_marketing,tb_detail_order.metode_pembayaran, tb_detail_order.jenis_order,tb_detail_order.status_bayar,tb_detail_order.ongkir');
		$this->db->from('tb_order');
		$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%Y')", $tahun);
		$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%m')", $bulan);
		$this->db->where('tb_order.harga !=',0);
		$this->db->join('tb_pelanggan','tb_pelanggan.id_pelanggan = tb_order.id_pelanggan', 'left');
		$this->db->join('tb_produk','tb_produk.kode_produk = tb_order.id_produk', 'left');
		$this->db->join('tb_marketing','tb_marketing.id_marketing = tb_order.id_marketing', 'left');
		$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
		$this->db->order_by('tb_order.kode_transaksi','asc');
		$query = $this->db->get();
		return $query->result();
	}
	
	public function total_bulan($awal,$akhir,$tahun){
		$this->db->select('sum(total_transaksi) as total');
		$this->db->from('tb_order');
		$this->db->where("DATE_FORMAT(tanggal_transaksi,'%Y')", $tahun);
		$this->db->where("DATE_FORMAT(tanggal_transaksi,'%m') >=", $awal);
		$this->db->where("DATE_FORMAT(tanggal_transaksi,'%m') <=", $akhir);
		$this->db->where('tb_order.harga !=',0);
		$query = $this->db->get();
		return $query->row();
	}
	//laporan order
	public function lap_tahun($tahun){
		$this->db->select('tb_order.*,
							tb_pelanggan.nama_pelanggan, 
							tb_pelanggan.jenis_pelanggan,
							tb_produk.nama_produk, 
							tb_marketing.nama_marketing,tb_detail_order.metode_pembayaran, tb_detail_order.jenis_order,tb_detail_order.status_bayar,tb_detail_order.ongkir');
		$this->db->from('tb_order');
		$this->db->where("DATE_FORMAT(tb_order.tanggal_transaksi,'%Y')", $tahun);
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
	public function total_tahun($tahun){
		$this->db->select('sum(total_transaksi) as total');
		$this->db->from('tb_order');
		$this->db->where("DATE_FORMAT(tanggal_transaksi,'%Y')", $tahun);
		$query = $this->db->get();
		$this->db->where('tb_order.harga !=',0);
		return $query->row();
	}
	public function total_harga(){
		$this->db->select('sum(total_harga) as total');
		$this->db->from('tb_order');
		$query = $this->db->get();
		return $query->row();
	}
	public function harga_harian($awal,$akhir){
		$this->db->select('sum(total_harga) as total');
		$this->db->from('tb_order');
		$this->db->where('tanggal_transaksi >=', $awal);
		$this->db->where('tanggal_transaksi <=', $akhir);
		$query = $this->db->get();
		return $query->row();
	}

	public function report_harga($kode,$jenis){
		if(($kode=='' and $jenis=='Semua Pelanggan') or ($kode=='' and $jenis=='')){
			$this->db->select('sum(total_harga) as total');
			$this->db->from('tb_order');
			$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
		}else if(($kode!='' and $jenis=='Semua Pelanggan') or ($kode!='' and $jenis=='')){
			$this->db->select('sum(total_harga) as total');
			$this->db->from('tb_order');
			$this->db->where("id_produk", $kode);
		}else if(($kode=='' and $jenis!='Semua Pelanggan') or ($kode=='' and $jenis!='')){
			$this->db->select('sum(total_harga) as total');
			$this->db->from('tb_order');
			$this->db->where("tb_pelanggan.jenis_pelanggan", $jenis);
			$this->db->join('tb_pelanggan','tb_pelanggan.id_pelanggan = tb_order.id_pelanggan', 'left');
		}else{
			$this->db->select('sum(total_harga) as total, sum(tb_detail_order.ongkir) as ongkir, tb_pelanggan.jenis_pelanggan');
			$this->db->from('tb_order');
			$this->db->join('tb_pelanggan','tb_pelanggan.id_pelanggan = tb_order.id_pelanggan', 'left');
			$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
			$this->db->where("id_produk", $kode);
			$this->db->where("tb_pelanggan.jenis_pelanggan", $jenis);
		}
		$query = $this->db->get();
		return $query->row();
	}
	public function report_harga1($kode,$jenis,$awal,$akhir){//hari
		if(($kode=='' and $jenis=='Semua Pelanggan') or ($kode=='' and $jenis=='')){
			$this->db->select('sum(total_harga) as total');
			$this->db->from('tb_order');
			$this->db->where("DATE(tb_order.tanggal_transaksi) >=", $awal);
			$this->db->where("DATE(tb_order.tanggal_transaksi) <=", $akhir);
			$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
		}else if(($kode!='' and $jenis=='Semua Pelanggan') or ($kode!='' and $jenis=='')){
			$this->db->select('sum(total_harga) as total');
			$this->db->from('tb_order');
			$this->db->where("id_produk", $kode);
			$this->db->where("DATE(tb_order.tanggal_transaksi) >=", $awal);
			$this->db->where("DATE(tb_order.tanggal_transaksi) <=", $akhir);
		}else if(($kode=='' and $jenis!='Semua Pelanggan') or ($kode=='' and $jenis!='')){
			$this->db->select('sum(total_harga) as total');
			$this->db->from('tb_order');
			$this->db->where("tb_pelanggan.jenis_pelanggan", $jenis);
			$this->db->where("DATE(tb_order.tanggal_transaksi) >=", $awal);
			$this->db->where("DATE(tb_order.tanggal_transaksi) <=", $akhir);
			$this->db->join('tb_pelanggan','tb_pelanggan.id_pelanggan = tb_order.id_pelanggan', 'left');
		}else{
			$this->db->select('sum(total_harga) as total, sum(tb_detail_order.ongkir) as ongkir, tb_pelanggan.jenis_pelanggan');
			$this->db->from('tb_order');
			$this->db->join('tb_pelanggan','tb_pelanggan.id_pelanggan = tb_order.id_pelanggan', 'left');
			$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
			$this->db->where("id_produk", $kode);
			$this->db->where("tb_pelanggan.jenis_pelanggan", $jenis);
			$this->db->where("DATE(tb_order.tanggal_transaksi) >=", $awal);
			$this->db->where("DATE(tb_order.tanggal_transaksi) <=", $akhir);
		}
		$query = $this->db->get();
		return $query->row();
	}
	public function report_ongkir1($kode, $jenis,$awal,$akhir){//hari
		if(($kode=='' and $jenis=='Semua Pelanggan') or ($kode=='' and $jenis=='')){
			$this->db->select('sum(ongkir) as total');
			$this->db->from('tb_detail_order');
			$this->db->where("DATE(tanggal_transaksi) >=", $awal);
			$this->db->where("DATE(tanggal_transaksi) <=", $akhir);
		}else if(($kode!='' and $jenis=='Semua Pelanggan') or ($kode!='' and $jenis=='')){
			$this->db->select('sum(ongkir) as total');
			$this->db->from('tb_detail_order');
			$this->db->join('tb_order','tb_order.kode_transaksi = tb_detail_order.kode_transaksi', 'left');
			$this->db->where("tb_order.id_produk", $kode);
			$this->db->where("DATE(tanggal_transaksi) >=", $awal);
			$this->db->where("DATE(tanggal_transaksi) <=", $akhir);
			$this->db->where('tb_order.harga !=',0);
		}else if(($kode=='' and $jenis!='Semua Pelanggan') or ($kode=='' and $jenis!='')){
			$this->db->select('sum(ongkir) as total');
			$this->db->from('tb_detail_order');
			$this->db->join('tb_pelanggan','tb_pelanggan.kode_transaksi = tb_detail_order.kode_transaksi', 'left');
			$this->db->where("tb_pelanggan.jenis_pelanggan", $jenis);
			$this->db->where("DATE(tanggal_transaksi) >=", $awal);
			$this->db->where("DATE(tanggal_transaksi) <=", $akhir);
			$this->db->where('tb_order.harga !=',0);
		}else{
			$this->db->select('sum(ongkir) as total');
			$this->db->from('tb_detail_order');
			$this->db->join('tb_order','tb_order.kode_transaksi = tb_detail_order.kode_transaksi', 'left');
			$this->db->join('tb_pelanggan','tb_pelanggan.id_pelanggan = tb_detail_order.id_pelanggan', 'left');
			$this->db->where("tb_order.id_produk", $kode);
			$this->db->where('tb_order.harga !=',0);
			$this->db->where("tb_pelanggan.jenis_pelanggan", $jenis);
			$this->db->where("DATE(tanggal_transaksi) >=", $awal);
			$this->db->where("DATE(tanggal_transaksi) <=", $akhir);
		}
		$query = $this->db->get();
		return $query->row();
	}



// =========================== Edit Order =========================== //
	public function total_transaksi($awal,$akhir){
		$this->db->select('sum(total_transaksi) as total');
		$this->db->from('tb_order');
		$this->db->where('tb_order.tanggal_transaksi >=', $awal);
		$this->db->where('tb_order.tanggal_transaksi <=', $akhir);
		$query = $this->db->get();
		return $query->row();
	}
	public function edit_detail($data){
		$this->db->where('kode_transaksi', $data['kode_transaksi']);
		$this->db->update('tb_detail_order',$data);
	}
	public function edit_customer($data){
		$this->db->where('id_pelanggan', $data['id_pelanggan']);
		$this->db->update('tb_detail_order',$data);
	}
	public function edit_order($data){
		$this->db->update_batch('tb_order',$data, 'id_order'); 
	}
	public function delete_stok($kode_transaksi){
		$this->db->where('kode_transaksi', $kode_transaksi);
		$this->db->delete('tb_stok'); 
	}
	public function delete_order($kode_transaksi){
		$this->db->where('kode_transaksi', $kode_transaksi);
		$this->db->delete('tb_order'); 
	}
	public function delete_detail($kode_transaksi){
		$this->db->where('kode_transaksi', $kode_transaksi);
		$this->db->delete('tb_detail_order'); 
	}

	// ======================== pengiriman ========================//
	public function data_kirim($resi){
		$this->db->select('tb_detail_order.*, tb_marketing.nama_marketing');
		$this->db->from('tb_detail_order');
		$this->db->where('status_bayar', 0);
		$this->db->join('tb_marketing','tb_marketing.id_marketing = tb_detail_order.id_marketing', 'left');
		$query = $this->db->get();
		return $query->result();
	}
	public function sudah_kirim(){
		$this->db->select('tb_detail_order.*, tb_marketing.nama_marketing');
		$this->db->from('tb_detail_order');
		$this->db->where('status_bayar', 1);
		$this->db->join('tb_marketing','tb_marketing.id_marketing = tb_detail_order.id_marketing', 'left');
		$query = $this->db->get();
		return $query->result();
	}
	
}