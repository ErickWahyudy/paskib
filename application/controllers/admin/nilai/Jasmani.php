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
	 if($this->session->userdata('admin') != TRUE){
     redirect(base_url(''));
     exit;
	};
   $this->load->model('m_pengguna');
   $this->load->model('m_kriteria');
   $this->load->model('m_peserta');
   $this->load->model('m_jasmani');
   $this->load->model('m_pengaturan');
	}

     //view nnilai
     public function lihat($id_pengguna='', $id_peserta='')
     {
       $data = $this->m_kriteria->view_id('K003BNDjht')->row_array();
       $peserta  = $this->m_jasmani->view_peserta()->result_array();
       $nilai    = $this->m_jasmani->view_nilai()->result_array();
       $juri     = $this->db->limit(1)->get_where('tb_pengguna', ['id_level' => '3'])->result_array();
 
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
       $this->load->view('admin/nilai/jasmani/lihat',$view);
     }
     
	
}