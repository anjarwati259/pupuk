<?php 
/**
 * 
 */
class Login extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('pelanggan_model');
    $this->load->model('wilayah_model');
  }
  //halaman login
  public function index()
  {
    //validasi
    $this->form_validation->set_rules('username','Username','required',
        array(  'required'  => '%s harus diisi'));
    $this->form_validation->set_rules('password','Password','required',
        array(  'required'  => '%s harus diisi'));

    if($this->form_validation->run())
    {
      $username   = $this->input->post('username');
      $password   = $this->input->post('password');
      //proses ke simple login
      $this->simple_login->login($username,$password);
    }
    //end validasi

    $this->load->view('login/login');
  }

  //fungsi register
  public function register()
  {
    //validation
    $valid = $this-> form_validation;

    $valid->set_rules('nama_pelanggan', 'Nama Lengkap','required',
        array(  'required'    => '%s harus diisi'));

    $valid->set_rules('email', 'Email','required|valid_email|is_unique[tb_user.email]',
        array(  'required'    => '%s harus diisi',
            'valid_email' => '%s tidak valid',
            'is_unique'   => '%s sudah terdaftar'
          ));
    $valid->set_rules('password', 'Password','required',
        array(  'required'    => '%s harus diisi',
          ));
    $valid->set_rules('no_hp', 'No. Hp','required',
        array(  'required'    => '%s harus diisi',
          ));

    if($valid->run()===FALSE){
      //end validation
    $this->load->view('login/register');
    }else{
      $pelanggan_id = $this->pelanggan_model->get_last_id();
      $provinsi = $this->wilayah_model->listing();

      if($pelanggan_id){
        $id = substr($pelanggan_id[0]->id_pelanggan, 1);
        $id_pelanggan = generate_code('C', $id);
      }else{
        $id_pelanggan = 'C001';
      }
      //masuk database
      $i = $this->input;
      //insert table user
      $data_user = array('nama_user'   => $i->post('nama_pelanggan'),
                      'email'          => $i->post('email'),
                      'username'       => $i->post('username'),
                      'password'       => SHA1($i->post('password')),
                      'hak_akses'       => '4',
            );
      $id_user = $this->user_model->tambah($data_user);
      //insert table pelanggan
      $data = array(  'id_pelanggan'  => $id_pelanggan,
                      'id_user'       => $id_user,
                      'nama_pelanggan'=> $i->post('nama_pelanggan'),
                      'no_hp'         => $i->post('no_hp'),
                      'alamat'        => $i->post('alamat'),
                      'provinsi'      => $i->post('provinsi'),
                      'kabupaten'     => $i->post('kabupaten'),
                      'kecamatan'     => $i->post('kecamatan'),
                      'jenis_pelanggan'=> 'Customer',
                      'tanggal_daftar' => date('Y-m-d')
            );
      $this->pelanggan_model->tambah($data);
      //create session login 
      $this->simple_login->login($i->post('username'),$i->post('password'));
      //end create session
      $this->session->set_flashdata('sukses','Registrasi berhasil');
      redirect(base_url('home'), 'refresh');
    }
    //end masuk database
  }

  //fungsi logout
  public function logout()
  {
    //ambil fungsi logout dari simple_login
    $this->simple_login->logout();
  }
}