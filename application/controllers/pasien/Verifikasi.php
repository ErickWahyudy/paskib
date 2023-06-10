<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Verifikasi extends CI_controller
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
	 if($this->session->userdata('Pasien') != TRUE){
     redirect(base_url(''));
     exit;
	};
   $this->load->library('Ciqrcode');

   $this->load->model('m_periksa');
	}

    public function QRcode($uuid='')
    { 
      QRcode::png(
        $kodenya = $uuid,
        $outfile = false,
        $level = QR_ECLEVEL_H,
        $size = 13,
        $margin = 2
      );
    }
      
	
}