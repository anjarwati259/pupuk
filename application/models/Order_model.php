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
							tb_pelanggan.nama_pelanggan, tb_pembayaran.jumlah_bayar');
		$this->db->from('tb_detail_order');
		$this->db->where('status_bayar', $data);
		$this->db->join('tb_pelanggan','tb_pelanggan.id_pelanggan = tb_detail_order.id_pelanggan', 'left');
		$this->db->join('tb_pembayaran','tb_pembayaran.kode_transaksi = tb_detail_order.kode_transaksi', 'left');
		$this->db->group_by('tb_detail_order.kode_transaksi');
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
		$this->db->select('tb_detail_order.*, tb_rekening.nama_bank, tb_rekening.no_rekening');
		$this->db->from('tb_detail_order');
		//join
		$this->db->join('tb_rekening', 'tb_rekening.id_rekening = tb_detail_order.id_rekening', 'left');
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
    $this->db->delete(array('tb_detail_order', 'tb_order'));
	}
}