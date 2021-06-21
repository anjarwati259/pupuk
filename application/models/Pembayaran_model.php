<?php 

/**
 * 
 */
class Pembayaran_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	//pembayaran
	public function bayar($data){
		$this->db->insert('tb_pembayaran', $data);
	}
	//edit
	public function edit($data){
		$this->db->where('kode_transaksi', $data['kode_transaksi']);
		$this->db->update('tb_pembayaran',$data);
	}
	//detail bayar
	public function detail($kode_transaksi)
	{
		$this->db->select('tb_pembayaran.*,
							tb_rekening.nama_bank AS bank,
							tb_rekening.no_rekening as rekening,
							tb_rekening.nama_pemilik');
		$this->db->from('tb_pembayaran');
		//join
		$this->db->join('tb_rekening', 'tb_rekening.id_rekening = tb_pembayaran.id_rekening', 'left');
		//end join
		$this->db->group_by('tb_pembayaran.id_pembayaran');
		$this->db->where('tb_pembayaran.kode_transaksi', $kode_transaksi);
		$this->db->order_by('id_pembayaran','desc');
		$query = $this->db->get();
		return $query->row();
	}
}