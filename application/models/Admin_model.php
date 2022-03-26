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
		$this->db->where('jenis_pelanggan','Mitra');
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
	public function get_pelanggan($id){
		$this->db->select('*');
		$this->db->from('tb_pelanggan');
		$this->db->where('id_pelanggan',$id);
		$query = $this->db->get();
		return $query->row();
	}
	public function edit($data){
		$this->db->where('id_pelanggan', $data['id_pelanggan']);
		$this->db->update('tb_pelanggan',$data);
	}
	// ============================ calon pelanggan ======================
	public function tambah_calon($data){
		$this->db->insert('tb_calon_pelanggan', $data);
		return $this->db->insert_id();
	}
	public function get_calon($id){
		$this->db->select('*');
		$this->db->from('tb_calon_pelanggan');
		$this->db->where('id_calon',$id);
		$query = $this->db->get();
		return $query->row();
	}
	public function edit_calon($data){
		$this->db->where('id_calon', $data['id_calon']);
		$this->db->update('tb_calon_pelanggan',$data);
	}
	public function del_calon($id){
		$this->db->where('id_calon', $id);
		$this->db->delete('tb_calon_pelanggan');
	}

	// =============================== ekspedisi ===========================
	public function ekspedisi(){
		$this->db->select('*');
		$this->db->from('tb_expedisi');
		$this->db->order_by('id_expedisi','desc');
		$query = $this->db->get();
		return $query->result();
	}
	public function add_expedisi($data){
		$this->db->insert('tb_expedisi', $data);
	}
	public function get_expedisi($id){
		$this->db->select('*');
		$this->db->from('tb_expedisi');
		$this->db->where('id_expedisi',$id);
		$query = $this->db->get();
		return $query->row();
	}
	public function edit_expedisi($data){
		$this->db->where('id_expedisi', $data['id_expedisi']);
		$this->db->update('tb_expedisi',$data);
	}

	public function del_expedisi($id){
		$this->db->where('id_expedisi', $id);
		$this->db->delete('tb_expedisi');
	}

	// ======================================== Marketing ===============================
	public function marketing(){
		$this->db->select('tb_marketing.*,tb_user.username');
		$this->db->from('tb_marketing');
		$this->db->join('tb_user','tb_user.id_user=tb_marketing.id_user','left');
		$this->db->order_by('tb_marketing.id_marketing','asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_last_marketing(){
		$this->db->order_by('id_marketing', 'DESC');

		$query = $this->db->get("tb_marketing",1,0);
		return $query->result();
	}
	public function tambah_marketing($data){
		$this->db->insert('tb_marketing', $data);
	}

	public function get_marketing($id){
		$this->db->select('*');
		$this->db->from('tb_marketing');
		$this->db->where('id_marketing',$id);
		$query = $this->db->get();
		return $query->row();
	}

	public function edit_marketing($data){
		$this->db->where('id_marketing', $data['id_marketing']);
		$this->db->update('tb_marketing',$data);
	}

	public function add_user($data){
		$this->db->insert('tb_user', $data);
		return $this->db->insert_id();
	}

	public function del_user($id){
		$this->db->where('id_user', $id);
		$this->db->delete('tb_user');
	}

}