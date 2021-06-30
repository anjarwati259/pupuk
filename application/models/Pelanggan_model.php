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
	//menampilkan semua data pelanggan
	public function alllisting(){
		$this->db->select('*');
		$this->db->from('tb_pelanggan');
		$this->db->order_by('id_pelanggan','desc');
		$query = $this->db->get();
		return $query->result();
	}
	//menampilkan data semua customer
	public function customer(){
		$this->db->select('*');
		$this->db->from('tb_pelanggan');
		$this->db->where('jenis_pelanggan', 'Customer');
		$this->db->order_by('id_pelanggan','desc');
		$query = $this->db->get();
		return $query->result();
	}
	//menampilkan data semua mitra
	public function mitra(){
		$this->db->select('*');
		$this->db->from('tb_pelanggan');;
		$this->db->where('jenis_pelanggan', 'Mitra');
		$this->db->order_by('id_pelanggan','desc');
		$query = $this->db->get();
		return $query->result();
	}
	//menampilkan data semua distributor
	public function distributor(){
		$this->db->select('*');
		$this->db->from('tb_pelanggan');
		$this->db->where('jenis_pelanggan', 'Distributor');
		$this->db->order_by('id_pelanggan','desc');
		$query = $this->db->get();
		return $query->result();
	}
	//digunakan untuk mengambil detail data pelanggan
	public function detail($id_pelanggan){
		$this->db->select('*');
		$this->db->from('tb_pelanggan');
		$this->db->where('id_pelanggan', $id_pelanggan);
		$this->db->order_by('id_pelanggan','desc');
		$query = $this->db->get();
		return $query->row();
	}
	//edit data pelanggan
	public function edit($data){
		$this->db->where('id_pelanggan', $data['id_pelanggan']);
		$this->db->update('tb_pelanggan',$data);
	}
	//tambah data customer
	public function tambah($data){
		$this->db->insert('tb_pelanggan', $data);
		return $this->db->insert_id();
	}
	//delete data pelanggan
	public function delete($data){
		$this->db->where('id_pelanggan', $data['id_pelanggan']);
		$this->db->delete('tb_pelanggan',$data);
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
	//digunakan untuk mencari id pelanggan terakhir
	public function get_last_id(){
		$this->db->order_by('id_pelanggan', 'DESC');

		$query = $this->db->get("tb_pelanggan",1,0);
		return $query->result();
	}
	//get pelanggan
}