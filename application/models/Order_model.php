<?php 

/**
 * 
 */
class Order_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	//tambah detail order
	public function tambah($data)
	{
		$this->db->insert('tb_detail_order', $data);
	}
	//tambah order
	public function tambah_order($data)
	{
		$this->db->insert('tb_order', $data);
	}

}