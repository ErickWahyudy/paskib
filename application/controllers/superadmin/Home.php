<?php
/**
 * PHP for Codeigniter
 *
 * @package        	CodeIgniter
 * @pengembang		Kassandra Production (https://kassandra.my.id)
 * @Author			@erikwahyudy
 * @version			3.0
 */

defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Home extends CI_controller
{
	function __construct()
	{
	 parent:: __construct();
     $this->load->helper('url');
      // needed ???
      $this->load->database();
      $this->load->library('session');
      
	 // error_reporting(0);
	 if($this->session->userdata('superadmin') != TRUE){
     redirect(base_url(''));
     exit;
	};
	 $this->load->model('M_admin');

	}

	public function index($id='')
	{
	 $view = array(
        'judul'            	=>'Halaman Administrator',
		'superadmin'        => $this->db->get_where('tb_pengguna', ['id_level' => '1'])->num_rows(),
        'admin'          	=> $this->db->get_where('tb_pengguna', ['id_level' => '2'])->num_rows(),
        'juri'          	=> $this->db->get_where('tb_pengguna', ['id_level' => '3'])->num_rows(),

     );
	 $this->load->view('superadmin/home',$view);
	}

public function keluar($value='')
{

$this->session->sess_destroy();
echo "<script>alert('Anda Telah Keluar Dari Halaman Administrator')</script>";;
redirect(base_url(''));
}

	
}