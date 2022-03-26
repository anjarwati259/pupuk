<?php 
/**
 * 
 */
class Wilayah_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function listing(){
		$this->db->select('*');
		$this->db->from('wilayah_2020');
		$this->db->where('CHAR_LENGTH(kode)=2');
		$this->db->order_by('nama','asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_prov($id){
		$hsl=$this->db->query("SELECT nama FROM wilayah_2020 WHERE kode='$id'");
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil=array(
                    'nama' => $data->nama,
                    );
            }
        }
        return $hasil;
	}
	public function get_kabupaten($n,$id,$m){
		$this->db->select('*');
		$this->db->from('wilayah_2020');
		$this->db->where('LEFT(kode,2)', $id);
		$this->db->where('CHAR_LENGTH(kode)', $m);
		$this->db->order_by('nama','asc');
		$query = $this->db->get();
		return $query->result();
	}
	public function get_kecamatan($n,$id,$m){
		$this->db->select('*');
		$this->db->from('wilayah_2020');
		$this->db->where('LEFT(kode,5)', $id);
		$this->db->where('CHAR_LENGTH(kode)', $m);
		$this->db->order_by('nama','asc');
		$query = $this->db->get();
		return $query->result();
	}
	public function data_setting(){
		$this->db->select('*');
		$this->db->from('tb_setting');
		$this->db->where('id', 1);
		$query = $this->db->get();
		return $query->row();
	}
	public function edit($data){
		$this->db->where('id', $data['id']);
		$this->db->update('tb_setting',$data);
	}

	public function getprov($prov){
		$this->db->select('*');
		$this->db->from('wilayah_2020');
		$this->db->where('CHAR_LENGTH(kode)=2');
		$this->db->where('nama',$prov);
		$query = $this->db->get();
		return $query->row();
	}
	public function getkab($kab){
		$this->db->select('*');
		$this->db->from('wilayah_2020');
		$this->db->where('CHAR_LENGTH(kode)=5');
		$this->db->where('nama',$kab);
		$query = $this->db->get();
		return $query->row();
	}
	public function getkec($kec){
		$this->db->select('*');
		$this->db->from('wilayah_2020');
		$this->db->where('CHAR_LENGTH(kode)=8');
		$this->db->where('nama',$kec);
		$query = $this->db->get();
		return $query->row();
	}
	
}