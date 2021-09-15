<?php 

/**
 * 
 */
class Chat_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function chat_group(){
		$this->db->select('tb_chat_group.*, tb_marketing.nama_marketing');
		$this->db->from('tb_chat_group');
		$this->db->join('tb_marketing','tb_marketing.id_user = tb_chat_group.id_user', 'left');
		$query = $this->db->get();
		return $query->result();
	}
}