<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Nilai_hasil extends CI_controller
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
	 if($this->session->userdata('peserta') != TRUE){
     redirect(base_url(''));
     exit;
	};
   $this->load->model('m_pengguna');
   $this->load->model('m_nilai_hasil');
   $this->load->model('m_pengaturan');
	}

    //view nilai
    public function index($value='')
    {
     $view = array('judul'     =>'Data Hasil Nilai',
                   'data'      =>$this->m_nilai_hasil->view()->result_array(),
                  );

      $this->load->view('peserta/nilai_hasil',$view);
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
    private function id_nilai($value='')
    {
    $this->m_nilai_hasil->id_urut();
    $query   = $this->db->get();
    $data    = $query->row_array();
    $id      = $data['id_nilai'];
    $karakter= $this->acak_id(5);
    $urut    = substr($id, 1, 3);
    $tambah  = (int) $urut + 1;
    
    if (strlen($tambah) == 1){
    $newID = "H"."00".$tambah.$karakter;
        }else if (strlen($tambah) == 2){
        $newID = "H"."0".$tambah.$karakter;
            }else (strlen($tambah) == 3){
            $newID = "H".$tambah.$karakter
            };
        return $newID;
    }


  //API add jasmani
  public function api_add($value='')
  {
    $rules = array(
      array(
        'field' => 'id_peserta[]',
        'label' => 'id_peserta',
        'rules' => 'required'
      ),
      array(
        'field' => 'hasil[]',
        'label' => 'hasil',
        'rules' => 'required'
      ),
    );
    $this->form_validation->set_rules($rules);
    if ($this->form_validation->run() == FALSE) {
      $pesan=array(
        'status'  =>FALSE,
        'pesan'   =>'Tidak ada data yang di kirim');
      echo json_encode($pesan);
    }else{
        $aid        =$this->input->post('id_peserta');
        $ahasil     =$this->input->post('hasil');

        if(!empty($aid)){
          for ($i=0; $i < count($aid); $i++) { 
            $id_peserta       =$aid[$i];
            $hasil            =$ahasil[$i];
            $id_nilai         =$this->id_nilai();
            $SQLinsert        =array(
                                    'id_nilai'    =>$id_nilai,
                                    'id_peserta'    =>$id_peserta,
                                    'hasil'         =>$hasil,
                                  );
            $this->m_nilai_hasil->add($SQLinsert);
            }
            $pesan=array(
              'status'  =>TRUE,
              'pesan'   =>'Berhasil menambahkan data');
            echo json_encode($pesan);
            }else{
                $pesan=array(
                    'status'  =>FALSE,
                    'pesan'   =>'Tidak ada data yang di kirim');
                echo json_encode($pesan);
                }
            }
        }


     //API hapus
     public function api_empty_table($value='')
     {
       if ($this->m_nilai_hasil->delete_semua_data()) {
         $response = [
           'status' => true,
           'message' => 'Berhasil menghapus data'
         ];
       } else {
         $response = [
           'status' => false,
           'message' => 'Gagal menghapus data'
         ];
       }
       $this->output
           ->set_content_type('application/json')
           ->set_output(json_encode($response));
     }
     
	
}