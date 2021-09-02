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
		$this->db->select('tb_pelanggan.*, tb_marketing.nama_marketing');
		$this->db->from('tb_pelanggan');
		$this->db->where('jenis_pelanggan', 'Customer');
		$this->db->join('tb_marketing','tb_marketing.id_marketing = tb_pelanggan.id_marketing', 'left');
		$this->db->order_by('id_pelanggan','desc');
		$query = $this->db->get();
		return $query->result();
	}
	//menampilkan data semua mitra
	public function mitra(){
		$this->db->select('tb_pelanggan.*,tb_marketing.nama_marketing');
		$this->db->from('tb_pelanggan');;
		$this->db->where('jenis_pelanggan', 'Mitra');
		$this->db->join('tb_marketing','tb_marketing.id_marketing = tb_pelanggan.id_marketing', 'left');
		$this->db->order_by('id_pelanggan','desc');
		$query = $this->db->get();
		return $query->result();
	}
	//menampilkan data semua distributor
	public function distributor(){
		$this->db->select('tb_pelanggan.*, tb_marketing.nama_marketing');
		$this->db->from('tb_pelanggan');
		$this->db->where('jenis_pelanggan', 'Distributor');
		$this->db->join('tb_marketing','tb_marketing.id_marketing = tb_pelanggan.id_marketing', 'left');
		$this->db->order_by('id_pelanggan','desc');
		$query = $this->db->get();
		return $query->result();
	}
	//digunakan untuk mengambil detail data pelanggan
	public function detail($id_pelanggan){
		$this->db->select('tb_pelanggan.*,tb_pelanggan.id_pelanggan as id, tb_marketing.nama_marketing');
		$this->db->from('tb_pelanggan');
		$this->db->where('tb_pelanggan.id_pelanggan', $id_pelanggan);
		$this->db->join('tb_marketing','tb_marketing.id_marketing = tb_pelanggan.id_marketing', 'left');
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
	public function get_pelanggan($id_pelanggan){
		$this->db->select('*');
		$this->db->from('tb_pelanggan');
		$this->db->where('id_pelanggan', $id_pelanggan);
		$query = $this->db->get();
		return $query->row(); 
	}
	//get pelanggan
	public function get_marketing($id_marketing,$data){
		$this->db->select('*');
		$this->db->from('tb_pelanggan');
		$this->db->where('jenis_pelanggan', $data);
		$this->db->where('id_marketing', $id_marketing);
		$this->db->order_by('id_pelanggan','desc');
		$query = $this->db->get();
		return $query->result();
	}
	public function marketing(){
		$this->db->select('*');
		$this->db->from('tb_marketing');
		$this->db->order_by('id_marketing','desc');
		$query = $this->db->get();
		return $query->result();
	}
	public function get_invoice($id_pelanggan){
		$this->db->select('tb_pelanggan.*, tb_detail_order.kode_transaksi');
		$this->db->from('tb_pelanggan');
		$this->db->where('tb_pelanggan.id_pelanggan', $id_pelanggan);
		$this->db->join('tb_detail_order','tb_detail_order.id_pelanggan = tb_pelanggan.id_pelanggan', 'left');
		$query = $this->db->get();
		return $query->row();
	}
	public function insert_aktivitas($data){
		$this->db->insert('tb_ativitas', $data);
	}
	public function follow($id_pelanggan){
		$this->db->select('tb_ativitas.*, tb_marketing.nama_marketing, tb_pelanggan.nama_pelanggan');
		$this->db->from('tb_ativitas');
		$this->db->where('tb_ativitas.id_pelanggan', $id_pelanggan);
		$this->db->join('tb_pelanggan','tb_pelanggan.id_pelanggan = tb_ativitas.id_pelanggan', 'left');
		$this->db->join('tb_marketing','tb_marketing.id_marketing = tb_ativitas.id_marketing', 'left');
		$this->db->order_by('id_aktivitas','desc');
		$query = $this->db->get();
		return $query->result();
	}
	public function follow_calon($id_calon){
		$this->db->select('tb_ativitas.*, tb_marketing.nama_marketing, tb_calon_pelanggan.nama_calon');
		$this->db->from('tb_ativitas');
		$this->db->where('tb_ativitas.id_pelanggan', $id_calon);
		$this->db->join('tb_calon_pelanggan','tb_calon_pelanggan.id_calon = tb_ativitas.id_pelanggan', 'left');
		$this->db->join('tb_marketing','tb_marketing.id_marketing = tb_ativitas.id_marketing', 'left');
		$this->db->order_by('id_aktivitas','desc');
		$query = $this->db->get();
		return $query->result();
	}
	public function total_follow($id_pelanggan){
		$this->db->select('count(*) as total');
		$this->db->from('tb_ativitas');
		$this->db->where('id_pelanggan', $id_pelanggan);
		$query = $this->db->get();
		return $query->row();
	}
	public function last_contact($id_pelanggan){
		$this->db->select('last_kontak');
		$this->db->from('tb_ativitas');
		$this->db->where('id_pelanggan', $id_pelanggan);
		$this->db->order_by('id_pelanggan','desc');
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->row();
	}
// =========================== Calon =======================================//
	public function listcalon($id_marketing){
		$this->db->select('*');
		$this->db->from('tb_calon_pelanggan');
		$this->db->where('id_marketing', $id_marketing);
		$this->db->order_by('tanggal','desc');
		$query = $this->db->get();
		return $query->result();
	}
	public function list_calon(){
		$this->db->select('tb_calon_pelanggan.*,tb_marketing.nama_marketing');
		$this->db->from('tb_calon_pelanggan');
		$this->db->join('tb_marketing','tb_marketing.id_marketing = tb_calon_pelanggan.id_marketing', 'left');
		//$this->db->where('id_marketing', $id_marketing);
		$this->db->order_by('tanggal','desc');
		$query = $this->db->get();
		return $query->result();
	}
	//digunakan untuk mencari id pelanggan terakhir
	public function get_last_calon(){
		$this->db->order_by('id_calon', 'DESC');

		$query = $this->db->get("tb_calon_pelanggan",1,0);
		return $query->result();
	}
	public function tambah_calon($data){
		$this->db->insert('tb_calon_pelanggan', $data);
	}
	public function edit_calon($data){
		$this->db->where('id_calon', $data['id_calon']);
		$this->db->update('tb_calon_pelanggan',$data);
	}
	public function calon($id_calon){
		$this->db->select('tb_calon_pelanggan.*, tb_marketing.nama_marketing');
		$this->db->from('tb_calon_pelanggan');
		$this->db->join('tb_marketing','tb_marketing.id_marketing = tb_calon_pelanggan.id_marketing', 'left');
		$this->db->where('id_calon', $id_calon);
		$query = $this->db->get();
		return $query->row();
	}
}