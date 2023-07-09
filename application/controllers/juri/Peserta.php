<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Peserta extends CI_controller
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
   $this->load->model('m_peserta');
	}

    //peserta
    public function index($value='')
    {
      if (isset($_POST['cari'])) {
        $tahun = $this->input->post('tahun');

     $view = array('judul'     =>'Data Paserta',
                   'data'      =>$this->m_peserta->view($tahun)->result_array(),
                   'depan'     =>FALSE,
                   'tahun'     =>$tahun,
                  );

      $this->load->view('juri/peserta/form',$view);
    }else{
     $view = array('judul'     =>'Data Paserta',
                   'depan'     =>TRUE,
                  );
      $this->load->view('juri/peserta/form',$view);
    }
  }

}