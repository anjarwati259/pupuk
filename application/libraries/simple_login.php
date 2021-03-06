<?php 
/**
 * 
 */
class Simple_login
{
  protected $CI;

  public function __construct()
  {
    $this->CI =& get_instance();
    //load data model user
    $this->CI->load->model('user_model');
  }
  public function login($username, $password)
  {
    $check = $this->CI->user_model->login($username, $password);
    //jika ada data user, maka create session login
    if($check){
    
    $id_user  = $check->id_user;
      $nama_user  = $check->nama_user;
      $hak_akses  = $check->hak_akses;
      //create session
      $this->CI->session->set_userdata('id_user',$id_user);
      $this->CI->session->set_userdata('nama_user',$nama_user);
      $this->CI->session->set_userdata('username',$username);
      $this->CI->session->set_userdata('hak_akses',$hak_akses);
      //redirect ke halaman admin yang diproteksi
      if($hak_akses=='1'){
      redirect(base_url('office/admin'),'refresh');
      }else if($hak_akses=='2'){
        redirect(base_url('page/distributor'),'refresh');
      }else if($hak_akses=='3'){
        redirect(base_url('mitra'),'refresh');
      }else if($hak_akses=='4'){
        redirect(base_url('home'),'refresh');
      }else if($hak_akses=='5'){
        redirect(base_url('marketing'),'refresh');
      }else if($hak_akses=='6'){
        redirect(base_url('pengiriman'),'refresh');
      }
    }else{
      //kalau tidak ada, maka suruh login lagi
      $this->CI->session->set_flashdata('warning','Username atau password salah');
      redirect(base_url('login'),'refresh');
    }
  }
  //fungsi cek login
  public function cek_login()
  {
    //memeriksa apakah session sudah atau belum, jika belum alihkan ke halaman login
    if($this->CI->session->userdata('username')==""){
      $this->CI->session->set_flashdata('warning','Anda belum login');
      redirect(base_url('login'),'refresh');
    }
  }
}