<?php
/**
 * PHP for Codeigniter
 *
 * @package       CodeIgniter
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
   $this->load->library('form_validation');
	 // error_reporting(0);
	 if($this->session->userdata('Pasien') != TRUE){
    redirect(base_url(''));
     exit;
	};
   $this->load->model('m_periksa');
   $this->load->model('m_informasi');
   $this->load->model('m_count');
   $this->load->model('m_pengaturan');
    
}

	public function index($id='')
  {

	 $view = array(

    $data=$this->m_periksa->view_id_periksa($id)->row_array(),
    $data2 = $this->m_pengaturan->view()->row_array(),
 
        'judul'            =>'Halaman pasien',
        'count_periksa'    => $this->m_count->count_periksa($tgl=date('Y-m-d')),
        'lama_antrian'     => $this->db->get_where('tb_periksa', ['tgl_periksa' => $data['tgl_periksa'], 'waktu_keluar !=' => null, 'status' => 'S']),
        'pasien'           => $this->m_periksa->namaAntrian($tgl=date('Y-m-d'))->result_array(),
        'antrian_p'        => $this->m_periksa->viewAntrianPasien($tgl=$data['tgl_periksa'])->result_array(),
        'tgl_periksa'      => $data['tgl_periksa'],
        'uuid'             => $data['uuid'],
        'status'           => $data['status'],
        'akses'            => $data2['akses_pendaftaran'],
        'jdwl_praktek'     => $data2['jdwl_praktek'],
        'jam_praktek'      => $data2['jam_praktek'],
        'jdwl_pendaftaran' => $data2['jdwl_pendaftaran'],

        'informasi'           =>$this->m_informasi->view(),
        );
	 $this->load->view('pasien/home',$view);
	}

	
}