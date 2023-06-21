<?php
/*halaman login utama 

author by Ismarianto Putra TEch Programer */

class Cari extends CI_controller
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
      
      $nama=$this->input->post('nama_peserta');
      $tgl_lahir = $this->input->post('tgl_lahir');
     
     //cek data login
      $peserta   = $this->Login_m->Peserta($nama,$tgl_lahir);

     if($peserta->num_rows() > 0 ){
        $DataPeserta=$peserta->row_array();
        $sessionPeserta = array(
            'peserta'           => TRUE,
        	  'id_peserta'        => $DataPeserta['id_peserta'],
            'nama_peserta'      => $DataPeserta['nama_peserta'],
            'tgl_lahir'         => $DataPeserta['tgl_lahir'],
            'asal_sekolah'      => $DataPeserta['asal_sekolah'],
            'level'             => 'peserta',
          );        
     $this->session->set_userdata($sessionPeserta);
     $this->session->set_flashdata('pesan','<div class="btn btn-primary">Anda Berhasil Login .....</div>');
     redirect(base_url('peserta/nilai_hasil'));

     }else{
          $pesan='<script>
                  swal({
                      title: "Nama / Tgl Lahir Salah Atau Data Anda Tidak Ada",
                      type: "error",
                      showConfirmButton: true,
                      confirmButtonText: "OKEE"
                      });
                </script>';
        $this->session->set_flashdata('pesan', $pesan);
       redirect(base_url('peserta/cari'));

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
  
  $this->load->view('peserta/cari',$x);

}

   }

}