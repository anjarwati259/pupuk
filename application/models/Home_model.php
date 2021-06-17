<?php 

/**
 * 
 */
class Home_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	//listing all promo
	public function promo(){
		$this->db->select('*');
		$this->db->from('tb_promo');
		$this->db->where('status','1');
		$this->db->order_by('id_promo','asc');
		$query = $this->db->get();
		return $query->result();
	}
	//listing all produk
	public function produk(){
		$this->db->select('*');
		$this->db->from('tb_produk');
		$this->db->order_by('kode_produk','asc');
		$query = $this->db->get();
		return $query->result();
	}
	//listing all detail produk
	public function detail_produk($kode_produk){
		$this->db->select('*');
		$this->db->from('tb_produk');
		$this->db->where('kode_produk',$kode_produk);
		$this->db->order_by('kode_produk','asc');
		$query = $this->db->get();
		return $query->result();
	}
	//gambar produk
	public function gambar($kode_produk){
		$this->db->select('gambar');
		$this->db->from('tb_produk');
		$this->db->where('kode_produk',$kode_produk);
		$this->db->order_by('kode_produk','asc');
		$query = $this->db->get();
		return $query->row();
	}
	//listing all detail promo
	public function detail_promo($id_promo){
		$this->db->select('*');
		$this->db->from('tb_promo');
		$this->db->where('id_promo',$id_promo);
		$this->db->order_by('id_promo','asc');
		$query = $this->db->get();
		return $query->result();
	}
	//gambar promo
	public function gambar_promo($id_promo){
		$this->db->select('gambar');
		$this->db->from('tb_promo');
		$this->db->where('id_promo',$id_promo);
		$this->db->order_by('id_promo','asc');
		$query = $this->db->get();
		return $query->row();
	}
	//listing produk
	public function listing_produk($kode_produk){
		$this->db->select('*');
		$this->db->from('tb_produk');
		$this->db->where('kode_produk',$kode_produk);
		$this->db->order_by('kode_produk','asc');
		$query = $this->db->get();
		return $query->row();
	}
	//listing produk
	public function listing_promo($id_promo){
		$this->db->select('*');
		$this->db->from('tb_promo');
		$this->db->where('id_promo',$id_promo);
		$this->db->order_by('id_promo','asc');
		$query = $this->db->get();
		return $query->row();
	}
}