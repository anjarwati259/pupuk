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
	
}