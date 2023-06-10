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
	 if($this->session->userdata('Dokter') != TRUE){
     redirect(base_url(''));
     exit;
	};
	 $this->load->model('M_dokter');
	 $this->load->model('m_periksa');
	 $this->load->model('m_count');
	}

	public function index($id='')
	{
	
	 $data=$this->m_periksa->viewAntrian($id)->row_array();

	 $view = array(
        'judul'            =>'Halaman Administrator',
		'count_periksa'    => $this->m_count->count_periksa($tgl=date('Y-m-d')),
        'pasien'           => $this->m_periksa->namaAntrian($tgl=date('Y-m-d'))->result_array(),
        'antrian_p'        => $this->m_periksa->viewAntrianPasien($tgl=date('Y-m-d'))->result_array(),
		'lama_antrian'     => $this->db->get_where('tb_periksa', ['tgl_periksa' => date('Y-m-d'), 'waktu_keluar !=' => null, 'status' => 'S']),

     );
	 $this->load->view('dokter/home',$view);

	}

	
}