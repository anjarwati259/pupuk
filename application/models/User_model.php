<?php 

/**
 * 
 */
class User_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	//listing all user
	public function listing(){
		$this->db->select('*');
		$this->db->from('tb_user');
		$this->db->order_by('id_user','asc');
		$query = $this->db->get();
		return $query->result();
	}
	//login user
	public function login($username, $password)
	{
		$this->db->select('*');
		$this->db->from('tb_user');
		$this->db->where(array(	'username'	=> $username,
								'password'	=> sha1($password)));
		$this->db->order_by('id_user','desc');
		$query = $this->db->get();
		return $query->row();
	}
	//login user_admin
	public function user_login($id_user){
		$this->db->select('*');
		$this->db->from('tb_user');
		$this->db->where('id_user',$id_user);
		$this->db->order_by('id_user','desc');
		$query = $this->db->get();
		return $query->row();
	}

	//tambah data user
	public function tambah($data){
		$this->db->insert('tb_user', $data);
		return $this->db->insert_id();
	}
	public function user($id_user){
		$this->db->select('*');
		$this->db->from('tb_user');
		$this->db->where('id_user',$id_user);
		$this->db->order_by('id_user','asc');
		$query = $this->db->get();
		return $query->row();
	}
}