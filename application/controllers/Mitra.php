<?php 
/**
 * 
 */
class Mitra extends CI_Controller
{
	
	public function index()
	{
		$data = array(	'title'	=> 'PT AGI - Website Order Produk Kilat',
						'isi'	=> 'mitra/dashboard'
						); 
		$this->load->view('mitra/layout/wrapper',$data, FALSE);
	}
	public function belanja()
	{
		$data = array(	'title'	=> 'PT AGI - Website Order Produk Kilat',
						'isi'	=> 'mitra/belanja'
						);
		$this->load->view('mitra/layout/wrapper',$data, FALSE);
	}
}