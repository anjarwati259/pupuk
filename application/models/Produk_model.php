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
		$this->db->select('*');
		$this->db->from('tb_promo');
		$this->db->where('id_promo', $id);
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
}