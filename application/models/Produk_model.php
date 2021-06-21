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
		$this->db->select('*,tb_produk.harga_customer');
		$this->db->from('tb_promo');
		$this->db->where('id_promo', $id);
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
}