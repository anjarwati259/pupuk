<?php 
/**
 * 
 */
class Datatable extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('datatable_model');
    // $this->load->model('wilayah_model');
  }
  public function get_pelanggan()
  {
    $query  = "SELECT tb_pelanggan.*, DATE_FORMAT(tb_pelanggan.tanggal_daftar, '%e %M %Y') as tanggal,tb_marketing.nama_marketing FROM tb_pelanggan 
               JOIN tb_marketing ON tb_pelanggan.id_marketing = tb_marketing.id_marketing";
    $search = array('tanggal_daftar','nama_marketing','nama_pelanggan','kabupaten');
    //$where  = null; 
    $where  = array('tb_pelanggan.jenis_pelanggan' => 'Customer');
    
    // jika memakai IS NULL pada where sql
    $isWhere = null;
    // $isWhere = 'artikel.deleted_at IS NULL';
    header('Content-Type: application/json');
    echo $this->datatable_model->get_tables_query($query,$search,$where,$isWhere);
  }

  

}