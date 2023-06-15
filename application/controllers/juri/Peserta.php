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
     $view = array('judul'     =>'Data Paserta',
                   'data'      =>$this->m_peserta->view()->result_array(),
                  );

      $this->load->view('juri/peserta/form',$view);
    }

}