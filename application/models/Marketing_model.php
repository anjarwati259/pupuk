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
	public function marketing(){
		$this->db->select('*');
		$this->db->from('tb_marketing');
		$this->db->order_by('id_marketing','asc');
		$query = $this->db->get();
		return $query->result();
	}
}