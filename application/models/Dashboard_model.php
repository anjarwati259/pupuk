<?php 

/**
 * 
 */
class Dashboard_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function pelanggan_id($id_user){
		$this->db->select('tb_pelanggan.id_pelanggan, tb_user.id_user');
		$this->db->from('tb_user');
		$this->db->where('tb_user.id_user', $id_user);
		$this->db->join('tb_pelanggan','tb_pelanggan.id_user = tb_user.id_user', 'left');
		$this->db->order_by('tb_user.id_user','asc');
		$query = $this->db->get();
		return $query->row();
	}
	public function order_admin(){
		$this->db->select('COUNT(*) as total');
		$this->db->from('tb_detail_order');
		$this->db->where('status_bayar', '0');
		$query = $this->db->get();
		return $query->row();
	}
	public function pelanggan($data){
		$this->db->select('COUNT(*) as total');
		$this->db->from('tb_pelanggan');
		$this->db->where('jenis_pelanggan', $data);
		$query = $this->db->get();
		return $query->row();
	}
	public function stok(){
		$this->db->select('SUM(stok) as total');
		$this->db->from('tb_produk');
		$query = $this->db->get();
		return $query->row();
	}
	public function point_mitra($id_pelanggan){
		$this->db->select('*');
		$this->db->from('tb_point');
		$this->db->where('id_pelanggan', $id_pelanggan);
		$this->db->order_by('id_point','desc');
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->row();
	}
	//order harian
	public function harian(){
		$this->db->select('SUM(total_item) as total');
		$this->db->from('tb_detail_order');
		$this->db->where('tanggal_transaksi',date('Y-m-d'));
		$this->db->order_by('tanggal_transaksi','desc');
		$query = $this->db->get();
		return $query->row();
	}
	//order mingguan
	public function mingguan(){
		$date_start = strtotime('last Sunday');
		$week_start = date('Y-m-d', $date_start);
		$date_end = strtotime('next Sunday');
		$week_end = date('Y-m-d', $date_end);

		$this->db->select('SUM(total_item) as total, tanggal_transaksi as y');
		$this->db->from('tb_detail_order');
		$this->db->where('tanggal_transaksi >=',$week_start);
		$this->db->where('tanggal_transaksi <',$week_end);
		$this->db->order_by('tanggal_transaksi','desc');
		$query = $this->db->get();
		return $query->row();
	}
	//order bulanan
	public function bulanan(){
		$bulan = date('Y-m');

		$this->db->select('SUM(total_item) as total, tanggal_transaksi');
		$this->db->from('tb_detail_order');
		$this->db->where("DATE_FORMAT(tanggal_transaksi,'%Y-%m')", $bulan);
		$this->db->order_by('tanggal_transaksi','desc');
		$query = $this->db->get();
		return $query->row();
	}
	public function order_baru(){
		$this->db->select('*');
		$this->db->from('tb_detail_order');
		$this->db->order_by('tanggal_transaksi','asc');
		$this->db->where('status_bayar',0);
		$this->db->limit(6);
		$query = $this->db->get();
		return $query->result();
	}
	public function hari(){
		$today = date("Y-m-d",strtotime("today"));
		$yesterday = date("Y-m-d",strtotime("-7 day"));	

		$this->db->select('tanggal_transaksi, SUM(jml_beli) as total');
		$this->db->from('tb_order');
		$this->db->where('tanggal_transaksi <=',$today);
		$this->db->where('tanggal_transaksi >=',$yesterday);
		$this->db->where('harga !=',0);
		$this->db->group_by('tanggal_transaksi');
		$this->db->order_by('tanggal_transaksi','asc');
		$query = $this->db->get();
		return $query->result();
	}
	//menampilkan chart untuk per produk
	public function chart($id_produk){
		$today = date("Y-m-d",strtotime("today"));
		$yesterday = date("Y-m-d",strtotime("-7 day"));	

		$this->db->select('SUM(jml_beli) as total');
		$this->db->from('tb_order');
		$this->db->where('tanggal_transaksi <=',$today);
		$this->db->where('tanggal_transaksi >',$yesterday);
		$this->db->where('harga !=',0);
		$this->db->where('id_produk', $id_produk);
		$this->db->group_by('tanggal_transaksi');
		$this->db->order_by('tanggal_transaksi','asc');
		$query = $this->db->get();
		return $query->row();
	}
	public function order(){
		$id_user = $this->session->userdata('id_user');
		$this->db->select('COUNT(*) as total');
		$this->db->from('tb_detail_order');
		$this->db->where('id_user', $id_user);
		$query = $this->db->get();
		return $query->row();
	}
	//reward
	public function reward(){
		$this->db->select('*');
		$this->db->from('tb_reward');
		$this->db->order_by('pencapaian','asc');
		$query = $this->db->get();
		return $query->result();
	}
	public function get_reward($id_reward){
		$this->db->select('*');
		$this->db->from('tb_reward');
		$this->db->where('id_reward', $id_reward);
		$query = $this->db->get();
		return $query->row();
	}
	//select pencairan reward
	public function get_pencairan($id_pelanggan){
		$this->db->select('tb_pencairan_reward.*, tb_reward.pencapaian, tb_reward.reward');
		$this->db->from('tb_pencairan_reward');
		$this->db->where('id_pelanggan', $id_pelanggan);
		$this->db->join('tb_reward','tb_reward.id_reward = tb_pencairan_reward.id_reward', 'left');
		$query = $this->db->get();
		return $query->result();
	}
	//tambah pencairan reward
	public function pencairan_reward($data){
		$this->db->insert('tb_pencairan_reward', $data);
	}
}