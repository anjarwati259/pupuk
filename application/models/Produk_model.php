<?php 

/**
 * 
 */
class Produk_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	//mendapatkan data prodduk
	public function produk(){
		$this->db->select('*');
		$this->db->from('tb_produk');
		$this->db->order_by('kode_produk','asc');
		$query = $this->db->get();
		return $query->result();
	}
	//mendapatkan data produk berdasarkan kodenya untuk order
	public function get_by_produk($kode_produk){
		$response = false;
		$query = $this->db->get_where('tb_produk',array('kode_produk' => $kode_produk));
		if($query && $query->num_rows()){
			$response = $query->result_array();
		}
		return $response;
	}
	//mendapatkan data promo berdasarkan kodenya untuk order
	public function get_promo($id){
		$this->db->select('*,tb_produk.harga_customer');
		$this->db->from('tb_promo');
		$this->db->where('id_promo', $id);
		$this->db->where('status', '1');
		$this->db->join('tb_produk','tb_produk.kode_produk = tb_promo.kode_produk', 'left');
		$query = $this->db->get();
		return $query->result();
	}
	//mendapatkan data promo berdasarkan kodenya untuk order
	public function get_mitra($id){
		$this->db->select('*,tb_produk.harga_mitra');
		$this->db->from('tb_promo');
		$this->db->where('id_promo', $id);
		$this->db->where('status', '2');
		$this->db->join('tb_produk','tb_produk.kode_produk = tb_promo.kode_produk', 'left');
		$query = $this->db->get();
		return $query->result();
	}
	public function detail_by_id($kode_produk){
		$response = false;
		$this->db->where('tb_produk.kode_produk',$kode_produk);
		$query = $this->db->get('tb_produk');
		if($query && $query->num_rows()){
			$response = $query->result_array();
		}
		return $response;
	}
	public function get_by_id($id){
		$response = false;
		$query = $this->db->get_where('tb_produk',array('kode_produk' => $id));
		if($query && $query->num_rows()){
			$response = $query->result_array();
		}
		return $response;
	}
	// ============================= stok ===========================
	public function promo_by_id($id_promo){
		$response = false;
		$this->db->where('tb_promo.id_promo',$id_promo);
		$query = $this->db->get('tb_promo');
		if($query && $query->num_rows()){
			$response = $query->result_array();
		}
		return $response;
	}
	//listing all home
	public function get_stok_id($kode_produk){
		$this->db->select('stok');
		$this->db->from('tb_produk');
		$this->db->where_in('kode_produk',$kode_produk);
		$query = $this->db->get();
		return $query->row();
	}
	//mengurangi stok
	public function update_qty_min($id,$data){
		$this->db->set('stok', 'stok-'.$data['stok'], FALSE);
		$this->db->where('kode_produk', $id);
		$this->db->update('tb_produk');
	}
	//listing order stok
	public function get_stok(){
		$this->db->select('tb_stok.*,
							tb_pelanggan.nama_pelanggan, tb_produk.nama_produk, tb_produk.stok');
		$this->db->from('tb_stok');
		$this->db->join('tb_pelanggan','tb_pelanggan.id_pelanggan = tb_stok.id_pelanggan', 'left');
		$this->db->join('tb_produk','tb_produk.kode_produk = tb_stok.kode_produk', 'left');
		//$this->db->group_by('tb_stok.id_stok');
		$this->db->order_by('tb_stok.id_stok','asc');
		$query = $this->db->get();
		return $query->result();
	}
	public function stok($kode_transaksi){
		$this->db->select('*');
		$this->db->from('tb_stok');
		$this->db->where('kode_transaksi', $kode_transaksi);
		$query = $this->db->get();
		return $query->result();
	}
	//tambah stok
	public function tambah_stok($data)
	{
		$this->db->insert('tb_stok', $data);
	}
	//update stok
	public function update_stok($id,$data){
		$this->db->set('stok', 'stok+'.$data['stok'], FALSE);
		$this->db->where('kode_produk', $id);
		$this->db->update('tb_produk');
	}
	public function stok_min($id,$data){
		$this->db->set('stok', 'stok-'.$data['stok'], FALSE);
		$this->db->where('kode_produk', $id);
		$this->db->update('tb_produk');
	}
	public function getby_produk($id){
		$this->db->select('*');
		$this->db->from('tb_produk');
		$this->db->where('kode_produk', $id);;
		$query = $this->db->get();
		return $query->result();
	}
	//update status stok
	public function update($data){
		$this->db->where('kode_transaksi', $data['kode_transaksi']);
		$this->db->update('tb_stok',$data);
	}
	public function update_produk($data){
		$this->db->where('kode_produk', $data['kode_produk']);
		$this->db->update('tb_produk',$data);
	}

	public function allstok(){
		$this->db->select('sum(qty) as total');
		$this->db->from('tb_stok');
		$query = $this->db->get();
		return $query->row();
	}
	public function allbonus(){
		$this->db->select('sum(qty) as total');
		$this->db->from('tb_stok');
		$this->db->where('bonus', '1');
		$query = $this->db->get();
		return $query->row();
	}
	public function allsampel(){
		$this->db->select('sum(qty) as total');
		$this->db->from('tb_stok');
		$this->db->where('status', 'sampel');
		$query = $this->db->get();
		return $query->row();
	}
	public function allsisa(){
		$this->db->select('sum(stok) as total');
		$this->db->from('tb_produk');
		$query = $this->db->get();
		return $query->row();
	}
	public function report($kode, $jenis){
		if(($kode=='' and $jenis=='Semua') or ($kode=='' and $jenis=='')){
			$this->db->select('sum(qty) as total');
			$this->db->from('tb_stok');
			$this->db->order_by('id_stok','asc');
		}else if(($kode!='' and $jenis=='Semua') or ($kode!='' and $jenis=='')){
			$this->db->select('sum(qty) as total');
			$this->db->from('tb_stok');
			$this->db->where("kode_produk", $kode);
			$this->db->order_by('id_stok','asc');
		}else if(($kode=='' and $jenis!='Semua') or ($kode=='' and $jenis!='')){
			$this->db->select('sum(qty) as total');
			$this->db->from('tb_stok');
			$this->db->where("status", $jenis);
			$this->db->order_by('id_stok','asc');
		}else{
			$this->db->select('sum(qty) as total');
			$this->db->from('tb_stok');
			$this->db->where("kode_produk", $kode);
			$this->db->where("status", $jenis);
			$this->db->order_by('id_stok','asc');
		}
		$query = $this->db->get();
		return $query->row();
	}
	public function bonus($kode,$jenis){
		if(($kode=='' and $jenis=='Semua') or ($kode=='' and $jenis=='')){
			$this->db->select('sum(qty) as total');
			$this->db->from('tb_stok');
			$this->db->where("bonus", 1);
		}else if(($kode!='' and $jenis=='Semua') or ($kode!='' and $jenis=='')){
			$this->db->select('sum(qty) as total');
			$this->db->from('tb_stok');
			$this->db->where("kode_produk", $kode);
			$this->db->where("bonus", 1);
		}else if(($kode=='' and $jenis!='Semua') or ($kode=='' and $jenis!='')){
			$this->db->select('sum(qty) as total');
			$this->db->from('tb_stok');
			$this->db->where("status", $jenis);
			$this->db->where("bonus", 1);
		}else{
			$this->db->select('sum(qty) as total');
			$this->db->from('tb_stok');
			$this->db->where("kode_produk", $kode);
			$this->db->where("status", $jenis);
			$this->db->where("bonus", 1);
		}
		$query = $this->db->get();
		return $query->row();
	}
	public function sample($kode){
		if($kode==''){
			$this->db->select('sum(qty) as total');
			$this->db->from('tb_stok');
			$this->db->where("status", 'sampel');
		}else{
			$this->db->select('sum(qty) as total');
			$this->db->from('tb_stok');
			$this->db->where("kode_produk", $kode);
			$this->db->where("status", 'sampel');
		}
		$query = $this->db->get();
		return $query->row();
	}
	public function sisa_stok($kode){
		if($kode==''){
			$this->db->select('sum(stok) as stok');
			$this->db->from('tb_produk');
		}else{
			$this->db->select('stok');
			$this->db->from('tb_produk');
			$this->db->where("kode_produk", $kode);
		}
		$query = $this->db->get();
		return $query->row();
	}
	//stok harian
	public function stok_harian($awal, $akhir,$status,$sampel){
		$this->db->select('tb_stok.*,
							tb_pelanggan.nama_pelanggan, tb_produk.nama_produk, tb_produk.stok');
		$this->db->from('tb_stok');
		$this->db->where('tb_stok.tanggal >=', $awal);
		$this->db->where('tb_stok.tanggal <=', $akhir);
		$this->db->join('tb_pelanggan','tb_pelanggan.id_pelanggan = tb_stok.id_pelanggan', 'left');
		$this->db->join('tb_produk','tb_produk.kode_produk = tb_stok.kode_produk', 'left');
		//$this->db->order_by('tb_stok.id_stok','asc');
		$query = $this->db->get();
		return $query->result();
	}
	public function stok_hari($awal,$akhir){
		$this->db->select('sum(qty) as total');
		$this->db->from('tb_stok');
		$this->db->where('tanggal >=', $awal);
		$this->db->where('tanggal <=', $akhir);
		$query = $this->db->get();
		return $query->row();
	}
	public function bonus_hari($awal,$akhir){
		$this->db->select('sum(qty) as total');
		$this->db->from('tb_stok');
		$this->db->where('tanggal >=', $awal);
		$this->db->where('tanggal <=', $akhir);
		$this->db->where('bonus', '1');
		$query = $this->db->get();
		return $query->row();
	}
	public function sampel_hari($awal,$akhir){
		$this->db->select('sum(qty) as total');
		$this->db->from('tb_stok');
		$this->db->where('tanggal >=', $awal);
		$this->db->where('tanggal <=', $akhir);
		$this->db->where('status', 'sampel');
		$query = $this->db->get();
		return $query->row();
	}
	public function report_hari($kode, $jenis,$awal, $akhir){
		if(($kode=='' and $jenis=='Semua') or ($kode=='' and $jenis=='')){
			$this->db->select('sum(qty) as total');
			$this->db->from('tb_stok');
			$this->db->where('tanggal >=', $awal);
			$this->db->where('tanggal <=', $akhir);
		}else if(($kode!='' and $jenis=='Semua') or ($kode!='' and $jenis=='')){
			$this->db->select('sum(qty) as total');
			$this->db->from('tb_stok');
			$this->db->where("kode_produk", $kode);
			$this->db->where('tanggal >=', $awal);
			$this->db->where('tanggal <=', $akhir);
		}else if(($kode=='' and $jenis!='Semua') or ($kode=='' and $jenis!='')){
			$this->db->select('sum(qty) as total');
			$this->db->from('tb_stok');
			$this->db->where("status", $jenis);
			$this->db->where('tanggal >=', $awal);
			$this->db->where('tanggal <=', $akhir);
		}else{
			$this->db->select('sum(qty) as total');
			$this->db->from('tb_stok');
			$this->db->where("kode_produk", $kode);
			$this->db->where("status", $jenis);
			$this->db->where('tanggal >=', $awal);
			$this->db->where('tanggal <=', $akhir);
		}
		$query = $this->db->get();
		return $query->row();
	}
	public function bonus_harian($kode,$jenis,$awal,$akhir){
		if(($kode=='' and $jenis=='Semua') or ($kode=='' and $jenis=='')){
			$this->db->select('sum(qty) as total');
			$this->db->from('tb_stok');
			$this->db->where("bonus", 1);
			$this->db->where('tanggal >=', $awal);
			$this->db->where('tanggal <=', $akhir);
		}else if(($kode!='' and $jenis=='Semua') or ($kode!='' and $jenis=='')){
			$this->db->select('sum(qty) as total');
			$this->db->from('tb_stok');
			$this->db->where("kode_produk", $kode);
			$this->db->where("bonus", 1);
			$this->db->where('tanggal >=', $awal);
			$this->db->where('tanggal <=', $akhir);
		}else if(($kode=='' and $jenis!='Semua') or ($kode=='' and $jenis!='')){
			$this->db->select('sum(qty) as total');
			$this->db->from('tb_stok');
			$this->db->where("status", $jenis);
			$this->db->where("bonus", 1);
			$this->db->where('tanggal >=', $awal);
			$this->db->where('tanggal <=', $akhir);
		}else{
			$this->db->select('sum(qty) as total');
			$this->db->from('tb_stok');
			$this->db->where("kode_produk", $kode);
			$this->db->where("status", $jenis);
			$this->db->where("bonus", 1);
			$this->db->where('tanggal >=', $awal);
			$this->db->where('tanggal <=', $akhir);
		}
		$query = $this->db->get();
		return $query->row();
	}
	public function sample_harian($kode,$awal,$akhir){
		if($kode==''){
			$this->db->select('sum(qty) as total');
			$this->db->from('tb_stok');
			$this->db->where("status", 'sampel');
			$this->db->where('tanggal >=', $awal);
			$this->db->where('tanggal <=', $akhir);
		}else{
			$this->db->select('sum(qty) as total');
			$this->db->from('tb_stok');
			$this->db->where("kode_produk", $kode);
			$this->db->where("status", 'sampel');
			$this->db->where('tanggal >=', $awal);
			$this->db->where('tanggal <=', $akhir);
		}
		$query = $this->db->get();
		return $query->row();
	}

	// bulanan
	public function stok_bulanan($bulan, $tahun){
		$this->db->select('tb_stok.*,
							tb_pelanggan.nama_pelanggan, tb_produk.nama_produk, tb_produk.stok');
		$this->db->from('tb_stok');
		$this->db->where("DATE_FORMAT(tanggal,'%Y')", $tahun);
		$this->db->where("DATE_FORMAT(tanggal,'%m')", $bulan);
		$this->db->join('tb_pelanggan','tb_pelanggan.id_pelanggan = tb_stok.id_pelanggan', 'left');
		$this->db->join('tb_produk','tb_produk.kode_produk = tb_stok.kode_produk', 'left');
		$this->db->order_by('tb_stok.id_stok','asc');
		$query = $this->db->get();
		return $query->result();
	}
	public function stok_bulan($bulan,$tahun){
		$this->db->select('sum(qty) as total');
		$this->db->from('tb_stok');
		$this->db->where("DATE_FORMAT(tanggal,'%Y')", $tahun);
		$this->db->where("DATE_FORMAT(tanggal,'%m')", $bulan);
		$query = $this->db->get();
		return $query->row();
	}
	public function bonus_bulan($bulan,$tahun){
		$this->db->select('sum(qty) as total');
		$this->db->from('tb_stok');
		$this->db->where("DATE_FORMAT(tanggal,'%Y')", $tahun);
		$this->db->where("DATE_FORMAT(tanggal,'%m')", $bulan);
		$this->db->where('bonus', '1');
		$query = $this->db->get();
		return $query->row();
	}
	public function sampel_bulan($bulan,$tahun){
		$this->db->select('sum(qty) as total');
		$this->db->from('tb_stok');
		$this->db->where("DATE_FORMAT(tanggal,'%Y')", $tahun);
		$this->db->where("DATE_FORMAT(tanggal,'%m')", $bulan);
		$this->db->where('status', 'sampel');
		$query = $this->db->get();
		return $query->row();
	}
	public function report_bulan($kode, $jenis,$bulan,$tahun){
		if(($kode=='' and $jenis=='Semua') or ($kode=='' and $jenis=='')){
			$this->db->select('sum(qty) as total');
			$this->db->from('tb_stok');
			$this->db->where("DATE_FORMAT(tanggal,'%Y')", $tahun);
			$this->db->where("DATE_FORMAT(tanggal,'%m')", $bulan);
		}else if(($kode!='' and $jenis=='Semua') or ($kode!='' and $jenis=='')){
			$this->db->select('sum(qty) as total');
			$this->db->from('tb_stok');
			$this->db->where("kode_produk", $kode);
			$this->db->where("DATE_FORMAT(tanggal,'%Y')", $tahun);
			$this->db->where("DATE_FORMAT(tanggal,'%m')", $bulan);
		}else if(($kode=='' and $jenis!='Semua') or ($kode=='' and $jenis!='')){
			$this->db->select('sum(qty) as total');
			$this->db->from('tb_stok');
			$this->db->where("status", $jenis);
			$this->db->where("DATE_FORMAT(tanggal,'%Y')", $tahun);
			$this->db->where("DATE_FORMAT(tanggal,'%m')", $bulan);
		}else{
			$this->db->select('sum(qty) as total');
			$this->db->from('tb_stok');
			$this->db->where("kode_produk", $kode);
			$this->db->where("status", $jenis);
			$this->db->where("DATE_FORMAT(tanggal,'%Y')", $tahun);
			$this->db->where("DATE_FORMAT(tanggal,'%m')", $bulan);
		}
		$query = $this->db->get();
		return $query->row();
	}
	public function bonus_bulanan($kode,$jenis,$bulan,$tahun){
		if(($kode=='' and $jenis=='Semua') or ($kode=='' and $jenis=='')){
			$this->db->select('sum(qty) as total');
			$this->db->from('tb_stok');
			$this->db->where("bonus", 1);
			$this->db->where("DATE_FORMAT(tanggal,'%Y')", $tahun);
			$this->db->where("DATE_FORMAT(tanggal,'%m')", $bulan);
		}else if(($kode!='' and $jenis=='Semua') or ($kode!='' and $jenis=='')){
			$this->db->select('sum(qty) as total');
			$this->db->from('tb_stok');
			$this->db->where("kode_produk", $kode);
			$this->db->where("bonus", 1);
			$this->db->where("DATE_FORMAT(tanggal,'%Y')", $tahun);
			$this->db->where("DATE_FORMAT(tanggal,'%m')", $bulan);
		}else if(($kode=='' and $jenis!='Semua') or ($kode=='' and $jenis!='')){
			$this->db->select('sum(qty) as total');
			$this->db->from('tb_stok');
			$this->db->where("status", $jenis);
			$this->db->where("bonus", 1);
			$this->db->where("DATE_FORMAT(tanggal,'%Y')", $tahun);
			$this->db->where("DATE_FORMAT(tanggal,'%m')", $bulan);
		}else{
			$this->db->select('sum(qty) as total');
			$this->db->from('tb_stok');
			$this->db->where("kode_produk", $kode);
			$this->db->where("status", $jenis);
			$this->db->where("bonus", 1);
			$this->db->where("DATE_FORMAT(tanggal,'%Y')", $tahun);
			$this->db->where("DATE_FORMAT(tanggal,'%m')", $bulan);
		}
		$query = $this->db->get();
		return $query->row();
	}
	public function sample_bulanan($kode,$bulan,$tahun){
		if($kode==''){
			$this->db->select('sum(qty) as total');
			$this->db->from('tb_stok');
			$this->db->where("status", 'sampel');
			$this->db->where("DATE_FORMAT(tanggal,'%Y')", $tahun);
			$this->db->where("DATE_FORMAT(tanggal,'%m')", $bulan);
		}else{
			$this->db->select('sum(qty) as total');
			$this->db->from('tb_stok');
			$this->db->where("kode_produk", $kode);
			$this->db->where("status", 'sampel');
			$this->db->where("DATE_FORMAT(tanggal,'%Y')", $tahun);
			$this->db->where("DATE_FORMAT(tanggal,'%m')", $bulan);
		}
		$query = $this->db->get();
		return $query->row();
	}

	//tahun
	public function stok_tahunan($tahun){
		$this->db->select('tb_stok.*,
							tb_pelanggan.nama_pelanggan, tb_produk.nama_produk, tb_produk.stok');
		$this->db->from('tb_stok');
		$this->db->where("DATE_FORMAT(tb_stok.tanggal,'%Y')", $tahun);
		$this->db->join('tb_pelanggan','tb_pelanggan.id_pelanggan = tb_stok.id_pelanggan', 'left');
		$this->db->join('tb_produk','tb_produk.kode_produk = tb_stok.kode_produk', 'left');
		$this->db->order_by('tb_stok.id_stok','asc');
		$query = $this->db->get();
		return $query->result();
	}
	public function stok_tahun($tahun){
		$this->db->select('sum(qty) as total');
		$this->db->from('tb_stok');
		$this->db->where("DATE_FORMAT(tanggal,'%Y')", $tahun);
		$query = $this->db->get();
		return $query->row();
	}
	public function bonus_tahun($tahun){
		$this->db->select('sum(qty) as total');
		$this->db->from('tb_stok');
		$this->db->where("DATE_FORMAT(tanggal,'%Y')", $tahun);
		$this->db->where('bonus', '1');
		$query = $this->db->get();
		return $query->row();
	}
	public function sampel_tahun($tahun){
		$this->db->select('sum(qty) as total');
		$this->db->from('tb_stok');
		$this->db->where("DATE_FORMAT(tanggal,'%Y')", $tahun);
		$this->db->where('status', 'sampel');
		$query = $this->db->get();
		return $query->row();
	}
	public function report_tahun($kode, $jenis,$tahun){
		if(($kode=='' and $jenis=='Semua') or ($kode=='' and $jenis=='')){
			$this->db->select('sum(qty) as total');
			$this->db->from('tb_stok');
			$this->db->where("DATE_FORMAT(tanggal,'%Y')", $tahun);
		}else if(($kode!='' and $jenis=='Semua') or ($kode!='' and $jenis=='')){
			$this->db->select('sum(qty) as total');
			$this->db->from('tb_stok');
			$this->db->where("kode_produk", $kode);
			//$this->db->where("DATE_FORMAT(tanggal,'%Y')", $tahun);
		}else if(($kode=='' and $jenis!='Semua') or ($kode=='' and $jenis!='')){
			$this->db->select('sum(qty) as total');
			$this->db->from('tb_stok');
			$this->db->where("status", $jenis);
			$this->db->where("DATE_FORMAT(tanggal,'%Y')", $tahun);
		}else{
			$this->db->select('sum(qty) as total');
			$this->db->from('tb_stok');
			$this->db->where("kode_produk", $kode);
			$this->db->where("status", $jenis);
			$this->db->where("DATE_FORMAT(tanggal,'%Y')", $tahun);
		}
		$query = $this->db->get();
		return $query->row();
	}
	public function bonus_tahunan($kode,$jenis,$tahun){
		if(($kode=='' and $jenis=='Semua') or ($kode=='' and $jenis=='')){
			$this->db->select('sum(qty) as total');
			$this->db->from('tb_stok');
			$this->db->where("bonus", 1);
			$this->db->where("DATE_FORMAT(tanggal,'%Y')", $tahun);
		}else if(($kode!='' and $jenis=='Semua') or ($kode!='' and $jenis=='')){
			$this->db->select('sum(qty) as total');
			$this->db->from('tb_stok');
			$this->db->where("kode_produk", $kode);
			$this->db->where("bonus", 1);
			$this->db->where("DATE_FORMAT(tanggal,'%Y')", $tahun);
		}else if(($kode=='' and $jenis!='Semua') or ($kode=='' and $jenis!='')){
			$this->db->select('sum(qty) as total');
			$this->db->from('tb_stok');
			$this->db->where("status", $jenis);
			$this->db->where("bonus", 1);
			$this->db->where("DATE_FORMAT(tanggal,'%Y')", $tahun);
		}else{
			$this->db->select('sum(qty) as total');
			$this->db->from('tb_stok');
			$this->db->where("kode_produk", $kode);
			$this->db->where("status", $jenis);
			$this->db->where("bonus", 1);
			$this->db->where("DATE_FORMAT(tanggal,'%Y')", $tahun);
		}
		$query = $this->db->get();
		return $query->row();
	}
	public function sample_tahunan($kode,$tahun){
		if($kode==''){
			$this->db->select('sum(qty) as total');
			$this->db->from('tb_stok');
			$this->db->where("status", 'sampel');
			$this->db->where("DATE_FORMAT(tanggal,'%Y')", $tahun);
		}else{
			$this->db->select('sum(qty) as total');
			$this->db->from('tb_stok');
			$this->db->where("kode_produk", $kode);
			$this->db->where("status", 'sampel');
			$this->db->where("DATE_FORMAT(tanggal,'%Y')", $tahun);
		}
		$query = $this->db->get();
		return $query->row();
	}

	public function get_order($id){
		$this->db->select('tb_order.*, tb_produk.nama_produk');
		$this->db->from('tb_order');
		$this->db->where("kode_transaksi", $id);
		$this->db->join('tb_produk','tb_produk.kode_produk = tb_order.id_produk', 'left');
		$query = $this->db->get();
		return $query->result();
	}
	//tambah retur
	public function retur($data)
	{
		$this->db->insert('tb_retur', $data);
	}
	//rep
	public function lap_stok($kode_produk,$status){
		$this->db->select('sum(qty) as total');
        $this->db->from('tb_stok');
        $this->db->where('kode_produk', $kode_produk);
        $this->db->where('status', $status);
        $this->db->where("DATE_FORMAT(tanggal,'%Y')", date('Y'));
        $this->db->where("DATE_FORMAT(tanggal,'%m')", date('m'));
        $query = $this->db->get();
        return $query->row();
	}
	//

}