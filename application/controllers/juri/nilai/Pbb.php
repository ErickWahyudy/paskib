<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Pbb extends CI_controller
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
   $this->load->model('m_pbb');
   $this->load->model('m_matriks');
	}

    //view nnilai
    public function lihat($id_pengguna='', $id_peserta='')
    {
      $data = $this->m_kriteria->view_id('K004RHwS3n')->row_array();
      $peserta  = $this->m_pbb->view_pesertaNilai()->result_array();
      $nilai    = $this->m_pbb->view_nilai()->result_array();
      $juri     = $this->m_pbb->view_juri()->result_array();

     $view = array('judul'          =>'Data Nilai '.$data['kriteria'],
                   'aksi'           =>'lihat',
                   'view_juri'      =>$juri,
                   'nama_peserta'   =>$peserta,
                   'data'           =>$nilai,
                    'nama_nilai1'   =>$data['nama_nilai1'],
                    'nama_nilai2'   =>$data['nama_nilai2'],
                    'nama_nilai3'   =>$data['nama_nilai3'],
                    'nama_nilai4'   =>$data['nama_nilai4'],
                    'nama_nilai5'   =>$data['nama_nilai5'],
                  );
      $this->load->view('juri/nilai/pbb/lihat',$view);
    }

    //add nilai
public function input()
{
  $data = $this->m_kriteria->view_id('K004RHwS3n')->row_array();
  $juri=$this->m_pengguna->view_id_pengguna()->row_array();

 $view = array('judul'          =>'Buat Nilai '.$data['kriteria'],
               'aksi'           =>'add',
               'id_pengguna'    =>$juri['id_pengguna'],
               'nama_juri'      =>$juri['nama'],
               'pilih_peserta'  =>$this->m_pbb->view_pesertaNilai()->result_array(),
                'nama_nilai1'   =>$data['nama_nilai1'],
                'nama_nilai2'   =>$data['nama_nilai2'],
                'nama_nilai3'   =>$data['nama_nilai3'],
                'nama_nilai4'   =>$data['nama_nilai4'],
                'nama_nilai5'   =>$data['nama_nilai5'],
              );
  $this->load->view('juri/nilai/pbb/form',$view);
}

 //API edit dokter
 public function api_edit($id='', $SQLupdate='')
 {
   $rules = array(
    array(
      'field' => 'nilai_sk',
      'label' => 'nilai_sk',
      'rules' => 'required'
    ),
    array(
      'field' => 'nilai_gb',
      'label' => 'nilai_gb',
      'rules' => 'required'
    ),
    array(
      'field' => 'nilai_gd',
      'label' => 'nilai_gd',
      'rules' => 'required'
    ),
    array(
      'field' => 'nilai_ab',
      'label' => 'nilai_ab',
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
        'nilai_sk'        =>$this->input->post('nilai_sk'),
        'nilai_gb'        =>$this->input->post('nilai_gb'),
        'nilai_gd'        =>$this->input->post('nilai_gd'),
        'nilai_ab'        =>$this->input->post('nilai_ab')
     ];
     if ($this->m_pbb->update($id, $SQLupdate)) {
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