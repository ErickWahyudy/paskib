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
	 if($this->session->userdata('Pasien') != TRUE){
     redirect(base_url(''));
     exit;
	};
   $this->load->library('Ciqrcode');

   $this->load->model('m_periksa');
   $this->load->model('m_pasien');
   $this->load->model('m_pengaturan');
	}

    //antrian
    public function riwayat($value='')
    {
     $view = array('judul'          =>'Data Riwayat Periksa',
                   'aksi'           =>'riwayat',
                   'data'           =>$this->m_periksa->view_id_periksa(),
                  );
      $this->load->view('pasien/periksa',$view);
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

    public function buat_jadwal($value='')
    {
      $data = $this->m_pengaturan->view()->row_array();

     $view = array('judul'                =>'Buat Jadwal Periksa',
                   'aksi'                 =>'buat_jadwal',
                   'data'                 =>$this->m_periksa->view_id_periksa(),
                   'akses'                =>$data['akses_pendaftaran'],
                   'jdwl_praktek'         =>$data['jdwl_praktek'],
                   'jam_praktek'          =>$data['jam_praktek'],
                   'jdwl_pendaftaran'     =>$data['jdwl_pendaftaran'],
                  );
      $this->load->view('pasien/periksa',$view);
    }


    private function acak_id($panjang)
    {
        $karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
        $string = '';
        for ($i = 0; $i < $panjang; $i++) {
            $pos = rand(0, strlen($karakter) - 1);
            $string .= $karakter{$pos};
        }
        return $string;
    }

    //mengambil id antrian urut terakhir dan acak 5 digit
    private function id_antrian_urut($value='')
    {
    $this->m_periksa->id_urut();
    $query   = $this->db->get();
    $data    = $query->row_array();
    $id      = $data['id_antrian'];
    $karakter= $this->acak_id(5);
    $urut    = substr($id, 1, 3);
    $tambah  = (int) $urut + 1;
    
    if (strlen($tambah) == 1){
    $newID = "A"."00".$tambah.$karakter;
        }else if (strlen($tambah) == 2){
        $newID = "A"."0".$tambah.$karakter;
            }else (strlen($tambah) == 3){
            $newID = "A".$tambah.$karakter
            };
        return $newID;
    }


  //API add periksa
  public function api_add($value='')
  {
    $rules = array(
      array(
        'field' => 'keluhan',
        'label' => 'keluhan',
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
      $SQLinsert = [
        'id_antrian'      =>$this->id_antrian_urut(),
        'id_pasien'       =>$this->session->userdata('id_pasien'),
        'kode_antrian'    =>$this->acak_id(4),
        'mens_terakhir'   =>$this->input->post('mens_terakhir'),
        'keluhan'         =>$this->input->post('keluhan'),
        'tgl_periksa'     =>$this->input->post('tgl_periksa'),
        'status'          =>'PV',
        'uuid'            =>$this->acak_id(16)
      ];
      if ($this->m_periksa->add($SQLinsert)) {
        $response = [
          'status' => true,
          'message' => 'Berhasil menambahkan data'
        ];
      } else {
        $response = [
          'status' => false,
          'message' => 'Gagal menambahkan data'
        ];
      }
  }
  
  $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($response));
}

    //API verifikasi
  public function verifikasi($id='') {
    if(empty($id)){
      $response = [
        'status' => false,
        'message' => 'Tidak ada data yang dipilih'
      ];
    }else{
      $SQLupdate=array(
        'status'                    =>'ANTRI'
      );
      $cek=$this->m_periksa->update($id,$SQLupdate);
      if($cek){
        $response = [
          'status' => true,
          'message' => 'Berhasil'
        ];
        //mengirim email ke pelanggan dengan phpmailer
        //dibawahini untuk script phpmailer
      }else{
        $response = [
          'status' => false,
          'message' => 'Gagal'
        ];
      }
    }
    echo json_encode($response);
  }
    
    //API batal_periksa
    public function batal_periksa($id='') {
      if(empty($id)){
        $response = [
          'status' => false,
          'message' => 'Tidak ada data yang dipilih'
        ];
      }else{
        $SQLupdate=array(
          'status'                    =>'BTL'
        );
        $cek=$this->m_periksa->update($id,$SQLupdate);
        if($cek){
          $response = [
            'status' => true,
            'message' => 'Berhasil'
          ];
          //mengirim email ke pelanggan dengan phpmailer
          //dibawahini untuk script phpmailer
        }else{
          $response = [
            'status' => false,
            'message' => 'Gagal'
          ];
        }
      }
      echo json_encode($response);
    }
      
	
}