<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Jasmani extends CI_controller
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
   $this->load->model('m_jasmani');
   $this->load->model('m_matriks');
   $this->load->model('m_pengaturan');
	}

    //view nnilai
    public function lihat($id_pengguna='', $id_peserta='')
    {
      $data = $this->m_kriteria->view_id('K003BNDjht')->row_array();
      $peserta  = $this->m_jasmani->view_peserta()->result_array();
      $nilai    = $this->m_jasmani->view_nilai()->result_array();
      $juri     = $this->m_jasmani->view_juri()->result_array();

     $view = array('judul'          =>'Data '.$data['kriteria'],
                   'aksi'           =>'lihat',
                   'view_juri'      =>$juri,
                   'nama_peserta'   =>$peserta,
                   'data'           =>$nilai,
                   'nama_nilai1'    =>$data['nama_nilai1'],
                   'nama_nilai2'    =>$data['nama_nilai2'],
                   'nama_nilai3'    =>$data['nama_nilai3'],
                   'nama_nilai4'    =>$data['nama_nilai4'],
                   'nama_nilai5'    =>$data['nama_nilai5'],
                  );
      $this->load->view('juri/nilai/jasmani/lihat',$view);
    }

    //add nilai
    public function input()
    {
      $data = $this->m_kriteria->view_id('K003BNDjht')->row_array();
      $juri=$this->m_pengguna->view_id_pengguna()->row_array();

     $view = array('judul'          =>'Buat Nilai '.$data['kriteria'],
                   'aksi'           =>'add',
                   'id_pengguna'    =>$juri['id_pengguna'],
                   'nama_juri'      => $juri['nama'],
                   'pilih_peserta'  =>$this->m_jasmani->view_pesertaNilai()->result_array(),
                    'nama_nilai1'   =>$data['nama_nilai1'],
                    'nama_nilai2'   =>$data['nama_nilai2'],
                    'nama_nilai3'   =>$data['nama_nilai3'],
                    'nama_nilai4'   =>$data['nama_nilai4'],
                    'nama_nilai5'   =>$data['nama_nilai5'],
                  );
      $this->load->view('juri/nilai/jasmani/form',$view);
    }

     //API edit
     public function api_edit($id='', $SQLupdate='')
     {
       $rules = array(
         array(
           'field' => 'nilai_lari',
            'label' => 'nilai_lari',
            'rules' => 'required'
          ),
          array(
            'field' => 'nilai_pushUp',
            'label' => 'nilai_pushUp',
            'rules' => 'required'
          ),
          array(
            'field' => 'nilai_sitUp',
            'label' => 'nilai_sitUp',
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
           'nilai_lari'      => $this->input->post('nilai_lari'),
           'nilai_pushUp'    => $this->input->post('nilai_pushUp'),
           'nilai_sitUp'     => $this->input->post('nilai_sitUp')
         ];
         if ($this->m_jasmani->update($id, $SQLupdate)) {
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