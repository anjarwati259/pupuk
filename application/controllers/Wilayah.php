<?php 
/**
 * 
 */
class Wilayah extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('wilayah_model');
	}

	public function index(){
		$wilayah = $this->wilayah_model->listing();

		$data = array(	'title'		=> 'Data Wilayah',
						'wilayah'	=> $wilayah,
						'isi'		=> 'wilayah/list'
						);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}
	public function getprov(){
		$id = $this->input->post('id');
		$data=$this->wilayah_model->get_prov($id);
        echo json_encode($data);
	}
	public function get_wilayah(){
		$data = $this->input->post('data');
		$id = $this->input->post('id');
		

		$n=strlen($id);
		$m=($n==2?5:($n==5?8:13));
	if($data == "kabupaten"){
		$wilayah = $this->wilayah_model->get_kabupaten($n,$id,$m);
		 foreach ($wilayah as $wilayah) {
		 	$data1 ="<option datakab='$wilayah->nama' value='$wilayah->kode'>$wilayah->nama</option>";
		 	echo $data1;
		 }


	}elseif($data == "kecamatan"){
		$wilayah = $this->wilayah_model->get_kecamatan($n,$id,$m);
		//$data1 ="<option value=''> $n </option>";
		  foreach ($wilayah as $wilayah) {
		  	$data1 ="<option datakec='$wilayah->nama' value='$wilayah->kode'>$wilayah->nama</option>";
		  	echo $data1;
		  }
	}
	}
}