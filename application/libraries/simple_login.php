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

  //fungsi login
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
      redirect(base_url('admin/dashboard'),'refresh');
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
  public function login_user($id_user,$id_admin){
    $check = $this->CI->user_model->user_login($id_user);
    $id_user  = $check->id_user;
    $username = $check->username;
    $nama_user  = $check->nama_user;
    $hak_akses  = '7';
    //create session
    $this->CI->session->set_userdata('id_user',$id_user);
    $this->CI->session->set_userdata('nama_user',$nama_user);
    $this->CI->session->set_userdata('username',$username);
    $this->CI->session->set_userdata('hak_akses',$hak_akses);
    $this->CI->session->set_userdata('id_admin',$id_admin);

    redirect(base_url('marketing'),'refresh');
  }
  public function back_admin($id_admin){
    $check = $this->CI->user_model->user_login($id_admin);
    $id_user  = $check->id_user;
    $username = $check->username;
    $nama_user  = $check->nama_user;
    $hak_akses  = $check->hak_akses;

    $this->CI->session->set_userdata('id_user',$id_user);
    $this->CI->session->set_userdata('nama_user',$nama_user);
    $this->CI->session->set_userdata('username',$username);
    $this->CI->session->set_userdata('hak_akses',$hak_akses);

    redirect(base_url('marketing/report_marketing'),'refresh');
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
  //fungsi cek hak akses
  public function admin()
  {
    //memeriksa apakah session sudah atau belum, jika belum alihkan ke halaman login
    if($this->CI->session->userdata('hak_akses')!="1"){
      $this->CI->session->set_flashdata('warning','Anda Tidak Memiliki Akses');
      redirect(base_url('login'),'refresh');
      //echo "anda tidak memiliki akses";
    }
  }
  //fungsi cek hak akses
  public function customer()
  {
    //memeriksa apakah session sudah atau belum, jika belum alihkan ke halaman login
    if($this->CI->session->userdata('hak_akses')!="4"){
      $this->CI->session->set_flashdata('warning','Anda Tidak Memiliki Akses');
      redirect(base_url('login'),'refresh');
      //echo "anda tidak memiliki akses";
    }
  }
  public function mitra()
  {
    //memeriksa apakah session sudah atau belum, jika belum alihkan ke halaman login
    if($this->CI->session->userdata('hak_akses')!="3"){
      $this->CI->session->set_flashdata('warning','Anda Tidak Memiliki Akses');
      redirect(base_url('login'),'refresh');
      //echo "anda tidak memiliki akses";
    }
  }
  public function marketing()
  {
    //memeriksa apakah session sudah atau belum, jika belum alihkan ke halaman login
    $hak_akses = $this->CI->session->userdata('hak_akses');
    if($hak_akses!="5" || $hak_akses!="7"){
      $this->CI->session->set_flashdata('warning','Anda Tidak Memiliki Akses');
      redirect(base_url('login'),'refresh');
      //echo "anda tidak memiliki akses";
    }
  }
  public function pengiriman()
  {
    //memeriksa apakah session sudah atau belum, jika belum alihkan ke halaman login
    if($this->CI->session->userdata('hak_akses')!="6"){
      $this->CI->session->set_flashdata('warning','Anda Tidak Memiliki Akses');
      redirect(base_url('login'),'refresh');
      //echo "anda tidak memiliki akses";
    }else{
      $this->CI->session->set_flashdata('warning','bisa');
    }
  }
  //fungsi logout
  public function logout()
  {
    //membuang semua session yang telah diset pada saat login
    $this->CI->session->unset_userdata('id_user');
    $this->CI->session->unset_userdata('nama');
    $this->CI->session->unset_userdata('username');
    $this->CI->session->unset_userdata('akses_level');
    //setelah session dibuang, maka redirect ke login
    $this->CI->session->set_flashdata('sukses','Anda berhasil logout');
    redirect(base_url('login'),'refresh');
  }
}