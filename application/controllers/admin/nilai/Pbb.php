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
	 if($this->session->userdata('admin') != TRUE){
     redirect(base_url(''));
     exit;
	};
   $this->load->model('m_pengguna');
   $this->load->model('m_kriteria');
   $this->load->model('m_peserta');
   $this->load->model('m_pbb');
	}

    //view nnilai
    public function lihat($id_pengguna='', $id_peserta='')
    {
      $data = $this->m_kriteria->view_id('K004RHwS3n')->row_array();
      $peserta  = $this->m_pbb->view_peserta()->result_array();
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
      $this->load->view('admin/nilai/pbb/lihat',$view);
    }

    //add nilai
public function input()
{
  $data = $this->m_kriteria->view_id('K004RHwS3n')->row_array();
 $view = array('judul'          =>'Buat Nilai '.$data['kriteria'],
               'aksi'           =>'add',
               'pilih_juri'     =>$this->m_pengguna->viewJuri()->result_array(),
               'pilih_peserta'  =>$this->m_peserta->view()->result_array(),
                'nama_nilai1'   =>$data['nama_nilai1'],
                'nama_nilai2'   =>$data['nama_nilai2'],
                'nama_nilai3'   =>$data['nama_nilai3'],
                'nama_nilai4'   =>$data['nama_nilai4'],
                'nama_nilai5'   =>$data['nama_nilai5'],
              );
  $this->load->view('admin/nilai/pbb/form',$view);
}

//view nnilai
public function edit($id_pengguna='', $id_peserta='')
{
  $data = $this->m_kriteria->view_id('K004RHwS3n')->row_array();
  $peserta  = $this->m_pbb->view_peserta()->result_array();
  $nilai    = $this->m_pbb->view_nilai()->result_array();
  $juri     = $this->m_pbb->view_juri()->result_array();

 $view = array('judul'          =>'Data Nilai '.$data['kriteria'],
               'aksi'           =>'edit',
               'view_juri'      =>$juri,
               'nama_peserta'   =>$peserta,
               'data'           =>$nilai,
                'nama_nilai1'   =>$data['nama_nilai1'],
                'nama_nilai2'   =>$data['nama_nilai2'],
                'nama_nilai3'   =>$data['nama_nilai3'],
                'nama_nilai4'   =>$data['nama_nilai4'],
                'nama_nilai5'   =>$data['nama_nilai5'],
              );
  $this->load->view('admin/nilai/pbb/form',$view);
}
	
}