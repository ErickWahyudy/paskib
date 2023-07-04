<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Parade extends CI_controller
{
	function __construct()
	{
	 parent:: __construct();
     $this->load->helper('url');
      // needed ???
      $this->load->database();
      $this->load->library('session');
      $this->load->library('form_validation');
      
	 // error_reporting(0);
	 if($this->session->userdata('juri') != TRUE){
     redirect(base_url(''));
     exit;
	};
   $this->load->model('m_pengguna');
   $this->load->model('m_kriteria');
   $this->load->model('m_peserta');
   $this->load->model('m_parade');
   $this->load->model('m_matriks');
	}

    //view nilai
    public function lihat($id_pengguna='', $id_peserta='')
    {
      if (isset($_POST['cari'])) {
        $tahun = $this->input->post('tahun');

      $data = $this->m_kriteria->view_id('K005ndLkXQ')->row_array();
      $peserta  = $this->m_parade->view_peserta()->result_array();
      $nilai    = $this->m_parade->view_nilai()->result_array();
      $juri     = $this->m_parade->view_juri()->result_array();

     $view = array('judul'          =>'Data Nilai '.$data['kriteria'],
                   'aksi'           =>'lihat',
                   'view_juri'      =>$juri,
                   'nama_peserta'   =>$peserta,
                   'data'           =>$nilai,
                   'nama_nilai1'    =>$data['nama_nilai1'],
                    'nama_nilai2'   =>$data['nama_nilai2'],
                    'nama_nilai3'   =>$data['nama_nilai3'],
                    'nama_nilai4'   =>$data['nama_nilai4'],
                    'nama_nilai5'   =>$data['nama_nilai5'],
                    'depan'          =>FALSE,
                    'tahun'          =>$tahun,

                  );
      $this->load->view('juri/nilai/parade/lihat',$view);
    }else{
     $data = $this->m_kriteria->view_id('K005ndLkXQ')->row_array();
     $view = array('judul'          =>'Data Nilai '.$data['kriteria'],
                   'aksi'           =>'lihat',
                   'depan'          =>TRUE,
                  );
      $this->load->view('juri/nilai/parade/lihat',$view);
    }
  }

    //add nilai
    public function input()
    {
      $data = $this->m_kriteria->view_id('K005ndLkXQ')->row_array();
      $juri=$this->m_pengguna->view_id_pengguna()->row_array();

     $view = array('judul'            =>'Buat Nilai '.$data['kriteria'],
                   'aksi'             =>'add',
                   'id_pengguna'      =>$juri['id_pengguna'],
                   'nama_juri'        =>$juri['nama'],
                   'pilih_peserta'    =>$this->m_parade->view_pesertaNilai()->result_array(),
                    'nama_nilai1'     =>$data['nama_nilai1'],
                      'nama_nilai2'   =>$data['nama_nilai2'],
                      'nama_nilai3'   =>$data['nama_nilai3'],
                      'nama_nilai4'   =>$data['nama_nilai4'],
                      'nama_nilai5'   =>$data['nama_nilai5'],
                  );
      $this->load->view('juri/nilai/parade/form',$view);
    }

     //API edit
     public function api_edit($id='', $SQLupdate='')
     {
       $rules = array(
        array(
          'field' => 'nilai_wjh',
          'label' => 'nilai_wjh',
          'rules' => 'required'
        ),
        array(
          'field' => 'nilai_bdn',
          'label' => 'nilai_bdn',
          'rules' => 'required'
        ),
        array(
          'field' => 'nilai_bp',
          'label' => 'nilai_bp',
          'rules' => 'required'
        ),
        array(
          'field' => 'nilai_tgn',
          'label' => 'nilai_tgn',
          'rules' => 'required'
        ),
        array(
          'field' => 'nilai_kk',
          'label' => 'nilai_kk',
          'rules' => 'required'
        ),
       );
       $this->form_validation->set_rules($rules);
       if ($this->form_validation->run() == FALSE) {
         $response = [
           'status' => false,
           'message' => 'Tidak ada data'
         ];
       } else {
         $SQLupdate = [
            'nilai_wjh'       =>$this->input->post('nilai_wjh'),
            'nilai_bdn'       =>$this->input->post('nilai_bdn'),
            'nilai_bp'        =>$this->input->post('nilai_bp'),
            'nilai_tgn'       =>$this->input->post('nilai_tgn'),
            'nilai_kk'        =>$this->input->post('nilai_kk')
         ];
         if ($this->m_parade->update($id, $SQLupdate)) {
           $response = [
             'status' => true,
             'message' => 'Berhasil mengubah data'
           ];
         } else {
           $response = [
             'status' => false,
             'message' => 'Gagal mengubah data'
           ];
         }
       }
       $this->output
         ->set_content_type('application/json')
         ->set_output(json_encode($response));
     }
	
}