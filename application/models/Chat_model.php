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
	public function add_group($data){
		$this->db->insert('tb_chat_group', $data);
	}
	public function update_chat(){
		$this->db->set('total_chat', 'total_chat+1', FALSE);
		$this->db->update('tb_user_group');
	}
	public function get_chat($id_user){
		$this->db->select('*');
		$this->db->from('tb_user_group');
		$this->db->where('id_user', $id_user);
		$query = $this->db->get();
		return $query->row();
	}
	public function up_chat($data){
		$this->db->where('id_user', $data['id_user']);
		$this->db->update('tb_user_group',$data);
	}
}