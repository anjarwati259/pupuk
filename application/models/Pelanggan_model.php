<?php 

/**
 * 
 */
class Pelanggan_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	//sudah login
	public function sudah_login($id_user, $nama_user)
	{
		$this->db->select('*');
		$this->db->from('tb_pelanggan');
		$this->db->where('id_user', $id_user);
		$this->db->where('nama_pelanggan', $nama_user);
		$this->db->order_by('id_pelanggan','desc');
		$query = $this->db->get();
		return $query->row();
	}
}