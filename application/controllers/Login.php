<?php
/*halaman login utama 

author by Ismarianto Putra TEch Programer */

class Login extends CI_controller
{
	
	function __construct()
	{
	parent::__construct();	
  $this->load->helper('url');
  // needed ???
  $this->load->database();
  $this->load->library('session');
  
	$this->load->model('Login_m');
  $this->load->model('m_pengaturan');
	
	}

   public function index()
   {
   	if(isset($_POST['login'])){
      
      $nama=$this->input->post('email');
      $email=$this->input->post('email');
      $password=$this->input->post('password');
     
     //cek data login
      $superadmin   = $this->Login_m->Superadmin($nama,$email,md5($password));
      $admin        = $this->Login_m->Admin($nama,$email,md5($password));
      $juri         = $this->Login_m->Juri($nama,$email,md5($password));

     if($superadmin->num_rows() > 0 ){
        $DataSuperAdmin=$superadmin->row_array();
        $sessionSuperAdmin = array(
            'superadmin'        => TRUE,
        	  'id_pengguna'       => $DataSuperAdmin['id_pengguna'],
            'email'             => $DataSuperAdmin['email'],
            'password'          => $DataSuperAdmin['password'],
            'nama'              => $DataSuperAdmin['nama'],
            'keterangan'        => $DataSuperAdmin['keterangan'],
            'level'             => $DataSuperAdmin['id_level'],
          );        
     $this->session->set_userdata($sessionSuperAdmin);
     $this->session->set_flashdata('pesan','<div class="btn btn-primary">Anda Berhasil Login .....</div>');
     redirect(base_url('superadmin/home'));


     }elseif($admin->num_rows() > 0){
        $DataAdmin=$admin->row_array();
        $sessionAdmin = array(
            'admin'             => TRUE,
        	  'id_pengguna'       => $DataAdmin['id_pengguna'],
            'email'             => $DataAdmin['email'],
            'password'          => $DataAdmin['password'],
            'nama'              => $DataAdmin['nama'],
            'keterangan'        => $DataAdmin['keterangan'],
            'level'             => $DataAdmin['id_level'],
              );       
    
     $this->session->set_userdata($sessionAdmin);
     $this->session->set_flashdata('pesan','<div class="btn btn-success">Anda Berhasil Login .....</div>');
     redirect(base_url('admin/home'));

    }elseif($juri->num_rows() > 0){
      $DataJuri=$juri->row_array();
      $sessionJuri = array(
            'juri'             => TRUE,
            'id_pengguna'       => $DataJuri['id_pengguna'],
            'email'             => $DataJuri['email'],
            'password'          => $DataJuri['password'],
            'nama'              => $DataJuri['nama'],
            'keterangan'        => $DataJuri['keterangan'],
            'level'             => $DataJuri['id_level'],
            );       
  
   $this->session->set_userdata($sessionJuri);
   $this->session->set_flashdata('pesan','<div class="btn btn-success">Anda Berhasil Login .....</div>');
   redirect(base_url('juri/home'));

     }else{
          $pesan='<script>
                  swal({
                      title: "Nama / Email / Password Salah Atau Akun Anda Tidak Aktif",
                      type: "error",
                      showConfirmButton: true,
                      confirmButtonText: "OKEE"
                      });
                </script>';
        $this->session->set_flashdata('pesan', $pesan);
       redirect(base_url('login'));

     }
}else{ 
  $data = $this->m_pengaturan->view()->row_array();
  $x = array(
  	          'judul' =>'Login Aplikasi',
              'nama_judul'        =>$data['nama_judul'],
              'meta_keywords'     =>$data['meta_keywords'],
              'meta_description'  =>$data['meta_description'],
              'logo'              =>$data['logo'],
            );
  
  $this->load->view('login',$x);

}

   }

}