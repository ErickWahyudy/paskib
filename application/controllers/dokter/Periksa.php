<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Periksa extends CI_controller
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
	 if($this->session->userdata('Dokter') != TRUE){
     redirect(base_url(''));
     exit;
	};
   $this->load->model('m_periksa');
   $this->load->model('m_pasien');
	}

    //antrian
    public function antrian($tgl='')
    {
      if (isset($_POST['cari'])) {
        //cek data apabila berhasi Di kirim maka postdata akan melakukan cek .... dan sebaliknya
        $tgl = $this->input->post('tgl');
     $view = array('judul'     =>'Data Antrian Periksa',
                   'aksi'      =>'antrian',
                   'data'      =>$this->m_periksa->viewAntrian($tgl),
                   'tgl'       =>$tgl,
                   'depan'    =>FALSE,
                  );
      $this->load->view('dokter/periksa/form',$view);
      }else{
      $view = array('judul'     =>'Buka Data Antrian',
                    'aksi'      =>'antrian',
                    'depan'    =>TRUE,
                    );
      $this->load->view('dokter/periksa/form',$view);
      }
    }

    //antrian
    public function sudah($value='')
    {
     $view = array('judul'     =>'Sudah Periksa',
                   'aksi'      =>'sudah',
                   'data'      =>$this->m_periksa->viewSudah(),
                  );
      $this->load->view('dokter/periksa/form',$view);
    }

    //antrian
    public function batal($value='')
    {
     $view = array('judul'     =>'Batal Periksa',
                   'aksi'      =>'batal',
                   'data'      =>$this->m_periksa->viewBatal(),
                  );
      $this->load->view('dokter/periksa/form',$view);
    }


    private function waktu($value='')
    {
      //gmt +7
      date_default_timezone_set('Asia/Jakarta');
      $waktu = date('H:i:s');
      return $waktu;
    }

    //API edit pasien
    public function sudah_periksa($id='', $SQLupdate='')
    {
      $rules = array(
        array(
          'field' => 'catatan',
          'label' => 'catatan',
          'rules' => 'required'
        )
      );
      $this->form_validation->set_rules($rules);
      if ($this->form_validation->run() == FALSE) {
        $response = [
          'status' => false,
          'message' => 'Tidak ada data'
        ];
      } else {
        $SQLupdate = [
          'catatan'                   =>$this->input->post('catatan'),
          'status'                    =>'S',
          'waktu_keluar'              =>$this->waktu()
        ];
        if ($this->m_periksa->update($id, $SQLupdate)) {
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