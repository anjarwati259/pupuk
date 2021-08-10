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
	
}