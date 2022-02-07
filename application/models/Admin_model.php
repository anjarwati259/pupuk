<?php 

/**
 * 
 */
class Admin_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	//listing all user
	public function pelanggan($jenis){
		$this->db->select('tb_pelanggan.*,tb_marketing.nama_marketing');
		$this->db->from('tb_pelanggan');
		$this->db->order_by('id_user','asc');
		$this->db->where('jenis_pelanggan',$jenis);
		$this->db->join('tb_marketing','tb_marketing.id_marketing = tb_pelanggan.id_marketing', 'left');
		$query = $this->db->get();
		return $query->result();
	}
	//tambah data customer
	public function tambah($data){
		$this->db->insert('tb_pelanggan', $data);
		return $this->db->insert_id();
	}
	public function get_last_id(){
		$this->db->order_by('tanggal_daftar', 'DESC');

		$query = $this->db->get("tb_pelanggan",1,0);
		return $query->result();
	}
	public function check_id($id){
		$this->db->select('id_pelanggan');
		$this->db->from('tb_pelanggan');
		$this->db->where("id_pelanggan", $id);
		$query = $this->db->get();
		return $query->result();
	}
}