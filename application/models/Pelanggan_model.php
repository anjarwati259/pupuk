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
		$this->db->order_by('tanggal_daftar', 'DESC');

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
	public function get_id_pelanggan($id_user){
		$this->db->select('*');
		$this->db->from('tb_pelanggan');
		$this->db->where('id_user', $id_user);
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
	//get all customer by marketing
	public function get_allmarketing($id_marketing){
		$this->db->select('*');
		$this->db->from('tb_pelanggan');
		$this->db->where('id_marketing', $id_marketing);
		$this->db->order_by('tanggal_daftar','desc');
		$query = $this->db->get();
		return $query->result();
	}
	public function marketing(){
		$this->db->select('*');
		$this->db->from('tb_marketing');
		$this->db->order_by('id_marketing','asc');
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
		$this->db->limit(5);
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
		$this->db->where('status !=',2);
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

	// filter customer
	public function tot_customer($id_marketing){
		$this->db->select('COUNT(*) as total');
		$this->db->from('tb_pelanggan');
		$this->db->where('id_marketing', $id_marketing);
		$query = $this->db->get();
		return $query->row();
	}
	public function calon_cus($id_marketing){
		$this->db->select('COUNT(*) as total');
		$this->db->from('tb_calon_pelanggan');
		$this->db->where('status !=',2);
		$this->db->where('id_marketing', $id_marketing);
		$query = $this->db->get();
		return $query->row();
	}
	public function lap_cus($id,$status){
		$this->db->select('COUNT(*) as total');
		$this->db->from('tb_pelanggan');
		$this->db->where('id_marketing', $id);
		$this->db->where('status', $status);
		$query = $this->db->get();
		return $query->row();
	}
	public function lap_calon($id,$status){
		$this->db->select('COUNT(*) as total');
		$this->db->from('tb_calon_pelanggan');
		$this->db->where('id_marketing', $id);
		$this->db->where('status !=',2);
		$this->db->where('status', $status);
		$query = $this->db->get();
		return $query->row();
	}
	public function get_tanggal($id,$awal,$akhir){
		$this->db->select('*');
		$this->db->from('tb_pelanggan');
		$this->db->where('id_marketing', $id);
		$this->db->where('tanggal_daftar >=', $awal);
		$this->db->where('tanggal_daftar <=', $akhir);
		$query = $this->db->get();
		return $query->result();
	}
	public function list_tanggal($id,$awal,$akhir){
		$this->db->select('*');
		$this->db->from('tb_calon_pelanggan');
		$this->db->where('id_marketing', $id);
		$this->db->where('status !=',2);
		$this->db->where('tanggal >=', $awal);
		$this->db->where('tanggal <=', $akhir);
		$query = $this->db->get();
		return $query->result();
	}
	public function tot_tanggal($id,$awal,$akhir){
		$this->db->select('COUNT(*) as total');
		$this->db->from('tb_pelanggan');
		$this->db->where('id_marketing', $id);
		$this->db->where('tanggal_daftar >=', $awal);
		$this->db->where('tanggal_daftar <=', $akhir);
		$query = $this->db->get();
		return $query->row();
	}
	public function calon_tanggal($id,$awal,$akhir){
		$this->db->select('COUNT(*) as total');
		$this->db->from('tb_calon_pelanggan');
		$this->db->where('id_marketing', $id);
		$this->db->where('status !=',2);
		$this->db->where('tanggal >=', $awal);
		$this->db->where('tanggal <=', $akhir);
		$query = $this->db->get();
		return $query->row();
	}
	public function tgl_cus($id,$data){
		$this->db->select('COUNT(*) as total');
		$this->db->from('tb_pelanggan');
		$this->db->where('id_marketing', $id);
		$this->db->where('status', $data['status']);
		$this->db->where('tanggal_daftar >=', $data['awal']);
		$this->db->where('tanggal_daftar <=', $data['akhir']);
		$query = $this->db->get();
		return $query->row();
	}
	public function tgl_calon($id,$data){
		$this->db->select('COUNT(*) as total');
		$this->db->from('tb_calon_pelanggan');
		$this->db->where('id_marketing', $id);
		$this->db->where('status', $data['status']);
		$this->db->where('status !=',2);
		$this->db->where('tanggal >=', $data['awal']);
		$this->db->where('tanggal <=', $data['akhir']);
		$query = $this->db->get();
		return $query->row();
	}
	// bulan
	public function get_bulan($id,$bulan,$tahun){
		$this->db->select('*');
		$this->db->from('tb_pelanggan');
		$this->db->where('id_marketing', $id);
		$this->db->where("DATE_FORMAT(tanggal_daftar,'%Y')", $tahun);
		$this->db->where("DATE_FORMAT(tanggal_daftar,'%m')", $bulan);
		$query = $this->db->get();
		return $query->result();
	}
	public function list_bulan($id,$bulan,$tahun){
		$this->db->select('*');
		$this->db->from('tb_calon_pelanggan');
		$this->db->where('id_marketing', $id);
		$this->db->where('status !=',2);
		$this->db->where("DATE_FORMAT(tanggal,'%Y')", $tahun);
		$this->db->where("DATE_FORMAT(tanggal,'%m')", $bulan);
		$query = $this->db->get();
		return $query->result();
	}
	public function tot_bulan($id,$bulan,$tahun){
		$this->db->select('COUNT(*) as total');
		$this->db->from('tb_pelanggan');
		$this->db->where('id_marketing', $id);
		$this->db->where("DATE_FORMAT(tanggal_daftar,'%Y')", $tahun);
		$this->db->where("DATE_FORMAT(tanggal_daftar,'%m')", $bulan);
		$query = $this->db->get();
		return $query->row();
	}
	public function calon_bulan($id,$bulan,$tahun){
		$this->db->select('COUNT(*) as total');
		$this->db->from('tb_calon_pelanggan');
		$this->db->where('status !=',2);
		$this->db->where('id_marketing', $id);
		$this->db->where("DATE_FORMAT(tanggal,'%Y')", $tahun);
		$this->db->where("DATE_FORMAT(tanggal,'%m')", $bulan);
		$query = $this->db->get();
		return $query->row();
	}
	public function bln_cus($id,$data){
		$this->db->select('COUNT(*) as total');
		$this->db->from('tb_pelanggan');
		$this->db->where('id_marketing', $id);
		$this->db->where('status', $data['status']);
		$this->db->where("DATE_FORMAT(tanggal_daftar,'%Y')", $data['tahun']);
		$this->db->where("DATE_FORMAT(tanggal_daftar,'%m')", $data['bulan']);
		$query = $this->db->get();
		return $query->row();
	}
	public function bln_calon($id,$data){
		$this->db->select('COUNT(*) as total');
		$this->db->from('tb_calon_pelanggan');
		$this->db->where('id_marketing', $id);
		$this->db->where('status !=',2);
		$this->db->where('status', $data['status']);
		$this->db->where("DATE_FORMAT(tanggal,'%Y')", $data['tahun']);
		$this->db->where("DATE_FORMAT(tanggal,'%m')", $data['bulan']);
		$query = $this->db->get();
		return $query->row();
	}
	//tahun
	public function get_tahun($id,$tahun){
		$this->db->select('*');
		$this->db->from('tb_pelanggan');
		$this->db->where('id_marketing', $id);
		$this->db->where("DATE_FORMAT(tanggal_daftar,'%Y')", $tahun);
		$query = $this->db->get();
		return $query->result();
	}
	public function list_tahun($id,$tahun){
		$this->db->select('*');
		$this->db->from('tb_calon_pelanggan');
		$this->db->where('status !=',2);
		$this->db->where('id_marketing', $id);
		$this->db->where("DATE_FORMAT(tanggal,'%Y')", $tahun);
		$query = $this->db->get();
		return $query->result();
	}
	public function tot_tahun($id,$tahun){
		$this->db->select('COUNT(*) as total');
		$this->db->from('tb_pelanggan');
		$this->db->where('id_marketing', $id);
		$this->db->where("DATE_FORMAT(tanggal_daftar,'%Y')", $tahun);
		$query = $this->db->get();
		return $query->row();
	}
	public function calon_tahun($id,$tahun){
		$this->db->select('COUNT(*) as total');
		$this->db->from('tb_calon_pelanggan');
		$this->db->where('status !=',2);
		$this->db->where('id_marketing', $id);
		$this->db->where("DATE_FORMAT(tanggal,'%Y')", $tahun);
		$query = $this->db->get();
		return $query->row();
	}
	public function thn_cus($id,$data){
		$this->db->select('COUNT(*) as total');
		$this->db->from('tb_pelanggan');
		$this->db->where('id_marketing', $id);
		$this->db->where('status', $data['status']);
		$this->db->where("DATE_FORMAT(tanggal_daftar,'%Y')", $data['tahun']);
		$query = $this->db->get();
		return $query->row();
	}
	public function thn_calon($id,$data){
		$this->db->select('COUNT(*) as total');
		$this->db->from('tb_calon_pelanggan');
		$this->db->where('id_marketing', $id);
		$this->db->where('status !=',2);
		$this->db->where('status', $data['status']);
		$this->db->where("DATE_FORMAT(tanggal,'%Y')", $data['tahun']);
		$query = $this->db->get();
		return $query->row();
	}
	public function calon_tgl($id,$awal,$akhir){
		$hak_akses = $this->session->userdata('hak_akses');
		$this->db->select('tb_calon_pelanggan.*,tb_marketing.nama_marketing');
		$this->db->from('tb_calon_pelanggan');
		$this->db->join('tb_marketing','tb_marketing.id_marketing = tb_calon_pelanggan.id_marketing', 'left');
		if($hak_akses!=1){
		$this->db->where('tb_calon_pelanggan.id_marketing', $id);
		}
		$this->db->where('tb_calon_pelanggan.tanggal >=', $awal);
		$this->db->where('tb_calon_pelanggan.tanggal <=', $akhir);
		$query = $this->db->get();
		return $query->result();
	}
	public function calon_bln($id,$bulan,$tahun){
		$hak_akses = $this->session->userdata('hak_akses');
		$this->db->select('tb_calon_pelanggan.*,tb_marketing.nama_marketing');
		$this->db->from('tb_calon_pelanggan');
		$this->db->join('tb_marketing','tb_marketing.id_marketing = tb_calon_pelanggan.id_marketing', 'left');
		if($hak_akses!=1){
		$this->db->where('tb_calon_pelanggan.id_marketing', $id);
		}
		$this->db->where("DATE_FORMAT(tb_calon_pelanggan.tanggal,'%Y')", $tahun);
		$this->db->where("DATE_FORMAT(tb_calon_pelanggan.tanggal,'%m')", $bulan);
		$query = $this->db->get();
		return $query->result();
	}
	public function calon_thn($id,$tahun){
		$hak_akses = $this->session->userdata('hak_akses');
		$this->db->select('tb_calon_pelanggan.*,tb_marketing.nama_marketing');
		$this->db->from('tb_calon_pelanggan');
		$this->db->join('tb_marketing','tb_marketing.id_marketing = tb_calon_pelanggan.id_marketing', 'left');
		if($hak_akses!=1){
		$this->db->where('tb_calon_pelanggan.id_marketing', $id);
		}
		$this->db->where("DATE_FORMAT(tb_calon_pelanggan.tanggal,'%Y')", $tahun);
		$query = $this->db->get();
		return $query->result();
	}
	public function check_id($id){
		$this->db->select('id_pelanggan');
		$this->db->from('tb_pelanggan');
		$this->db->where("id_pelanggan", $id);
		$query = $this->db->get();
		return $query->result();
	}
}