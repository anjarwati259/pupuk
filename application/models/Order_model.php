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
	//menampilkan data order
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
	//mendapatkan data transaksi berdasarkan kodenya
	public function kode_order($kode_transaksi){
		$this->db->select('tb_order.*, 
						tb_produk.nama_produk, tb_promo.nama_promo as nama');
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
	//digunakan untuk mencari kode transaksi terakhir
	public function get_last_id(){
		$this->db->order_by('kode_transaksi', 'DESC');

		$query = $this->db->get("tb_detail_order",1,0);
		return $query->result();
	}

}