<?php 

/**
 * 
 */
class Produk_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	//mendapatkan data prodduk
	public function produk(){
		$this->db->select('*');
		$this->db->from('tb_produk');
		$this->db->order_by('kode_produk','desc');
		$query = $this->db->get();
		return $query->result();
	}
	//mendapatkan data produk berdasarkan kodenya untuk order
	public function get_by_produk($kode_produk){
		$response = false;
		$query = $this->db->get_where('tb_produk',array('kode_produk' => $kode_produk));
		if($query && $query->num_rows()){
			$response = $query->result_array();
		}
		return $response;
	}
	//mendapatkan data promo berdasarkan kodenya untuk order
	public function get_promo($id){
		$this->db->select('*,tb_produk.harga_customer');
		$this->db->from('tb_promo');
		$this->db->where('id_promo', $id);
		$this->db->where('status', '1');
		$this->db->join('tb_produk','tb_produk.kode_produk = tb_promo.kode_produk', 'left');
		$query = $this->db->get();
		return $query->result();
	}
	//mendapatkan data promo berdasarkan kodenya untuk order
	public function get_mitra($id){
		$this->db->select('*,tb_produk.harga_mitra');
		$this->db->from('tb_promo');
		$this->db->where('id_promo', $id);
		$this->db->where('status', '2');
		$this->db->join('tb_produk','tb_produk.kode_produk = tb_promo.kode_produk', 'left');
		$query = $this->db->get();
		return $query->result();
	}
	public function detail_by_id($kode_produk){
		$response = false;
		$this->db->where('tb_produk.kode_produk',$kode_produk);
		$query = $this->db->get('tb_produk');
		if($query && $query->num_rows()){
			$response = $query->result_array();
		}
		return $response;
	}
	public function get_by_id($id){
		$response = false;
		$query = $this->db->get_where('tb_produk',array('kode_produk' => $id));
		if($query && $query->num_rows()){
			$response = $query->result_array();
		}
		return $response;
	}
	public function promo_by_id($id_promo){
		$response = false;
		$this->db->where('tb_promo.id_promo',$id_promo);
		$query = $this->db->get('tb_promo');
		if($query && $query->num_rows()){
			$response = $query->result_array();
		}
		return $response;
	}
	//listing all home
	public function get_stok_id($kode_produk){
		$this->db->select('stok');
		$this->db->from('tb_produk');
		$this->db->where_in('kode_produk',$kode_produk);
		$query = $this->db->get();
		return $query->row();
	}
	//mengurangi stok
	public function update_qty_min($id,$data){
		$this->db->set('stok', 'stok-'.$data['stok'], FALSE);
		$this->db->where('kode_produk', $id);
		$this->db->update('tb_produk');
	}
	//listing order stok
	public function getstok(){
		$this->db->select('tb_stok.*,
							tb_pelanggan.nama_pelanggan, tb_produk.nama_produk, tb_produk.stok');
		$this->db->from('tb_stok');
		$this->db->join('tb_pelanggan','tb_pelanggan.id_pelanggan = tb_stok.id_pelanggan', 'left');
		$this->db->join('tb_produk','tb_produk.kode_produk = tb_stok.kode_produk', 'left');
		$this->db->group_by('tb_stok.id_stok');
		$this->db->order_by('id_stok','asc');
		$query = $this->db->get();
		return $query->result();
	}
	//tambah stok
	public function tambah_stok($data)
	{
		$this->db->insert('tb_stok', $data);
	}
	//update stok
	public function update_stok($id,$data){
		$this->db->set('stok', 'stok+'.$data['stok'], FALSE);
		$this->db->where('kode_produk', $id);
		$this->db->update('tb_produk');
	}
	public function getby_produk($id){
		$this->db->select('*');
		$this->db->from('tb_produk');
		$this->db->where('kode_produk', $id);;
		$query = $this->db->get();
		return $query->result();
	}
	//update status stok
	public function update($data){
		$this->db->where('kode_transaksi', $data['kode_transaksi']);
		$this->db->update('tb_stok',$data);
	}
}