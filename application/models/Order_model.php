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
							tb_pelanggan.nama_pelanggan, tb_pembayaran.jumlah_bayar, tb_marketing.nama_marketing');
		$this->db->from('tb_detail_order');
		$this->db->where('status_bayar', $data);
		$this->db->join('tb_pelanggan','tb_pelanggan.id_pelanggan = tb_detail_order.id_pelanggan', 'left');
		$this->db->join('tb_pembayaran','tb_pembayaran.kode_transaksi = tb_detail_order.kode_transaksi', 'left');
		$this->db->join('tb_marketing','tb_marketing.id_marketing = tb_detail_order.id_marketing', 'left');
		$this->db->group_by('tb_detail_order.kode_transaksi');
		$this->db->order_by('kode_transaksi','asc');
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
		$this->db->order_by('kode_transaksi','asc');
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
		$this->db->select('*');
		$this->db->from('tb_detail_order');
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
		$this->db->order_by('kode_transaksi', 'DESC');

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
	//laporan order
	public function lap_harian($awal, $akhir){
		$this->db->select('tb_order.*,
							tb_pelanggan.nama_pelanggan, tb_produk.nama_produk, tb_marketing.nama_marketing, tb_detail_order.metode_pembayaran, tb_detail_order.jenis_order, tb_detail_order.status_bayar');
		$this->db->from('tb_order');
		$this->db->where('tb_order.tanggal_transaksi >=', $awal);
		$this->db->where('tb_order.tanggal_transaksi <=', $akhir);
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
	public function lap_bulan($awal, $akhir, $tahun){
		$this->db->select('tb_order.*,
							tb_pelanggan.nama_pelanggan, tb_produk.nama_produk, tb_marketing.nama_marketing, tb_detail_order.metode_pembayaran, tb_detail_order.jenis_order, tb_detail_order.status_bayar');
		$this->db->from('tb_order');
		$this->db->where('DATE_FORMAT(tb_order.tanggal_transaksi,%Y)', $tahun);
		$this->db->where('DATE_FORMAT(tb_order.tanggal_transaksi,%m) >=', $awal);
		$this->db->where('DATE_FORMAT(tb_order.tanggal_transaksi,%m) <=', $akhir);
		$this->db->join('tb_pelanggan','tb_pelanggan.id_pelanggan = tb_order.id_pelanggan', 'left');
		$this->db->join('tb_produk','tb_produk.kode_produk = tb_order.id_produk', 'left');
		$this->db->join('tb_marketing','tb_marketing.id_marketing = tb_order.id_marketing', 'left');
		$this->db->join('tb_detail_order','tb_detail_order.kode_transaksi = tb_order.kode_transaksi', 'left');
		$this->db->group_by('tb_order.kode_transaksi');
		$this->db->order_by('tb_order.kode_transaksi','asc');
		$query = $this->db->get();
		return $query->result();
	}
	public function total_transaksi($awal,$akhir){
		$this->db->select('sum(total_transaksi) as total');
		$this->db->from('tb_order');
		$this->db->where('tb_order.tanggal_transaksi >=', $awal);
		$this->db->where('tb_order.tanggal_transaksi <=', $akhir);
		$query = $this->db->get();
		return $query->row();
	}
}