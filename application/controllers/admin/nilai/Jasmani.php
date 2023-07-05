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
   $this->load->model('m_matriks');
   $this->load->model('m_pengaturan');
	}

     //view nnilai
     public function lihat($id_pengguna='', $id_peserta='')
     {
      if (isset($_POST['cari'])) {
        $tahun = $this->input->post('tahun');

       $data = $this->m_kriteria->view_id('K003BNDjht')->row_array();
       $peserta  = $this->m_jasmani->view_peserta()->result_array();
       $nilai    = $this->m_jasmani->view_nilai($tahun)->result_array();
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
                    'depan'          =>FALSE,
                    'tahun'          =>$tahun,
                   );
       $this->load->view('admin/nilai/jasmani/lihat',$view);
     }else{
      $data = $this->m_kriteria->view_id('K003BNDjht')->row_array();
      $view = array('judul'          =>'Data '.$data['kriteria'],
                    'aksi'           =>'lihat',
                    'depan'          =>TRUE,
                   );
       $this->load->view('admin/nilai/jasmani/lihat',$view);
      }
    }

    //add nilai
    public function input()
    {
      $data = $this->m_kriteria->view_id('K003BNDjht')->row_array();
     $view = array('judul'          =>'Buat Nilai '.$data['kriteria'],
                   'aksi'           =>'add',
                   'pilih_juri'     =>$this->m_pengguna->viewJuri()->result_array(),
                   'pilih_peserta'  =>$this->m_peserta->view()->result_array(),
                    'nama_nilai1'   =>$data['nama_nilai1'],
                    'nama_nilai2'   =>$data['nama_nilai2'],
                    'nama_nilai3'   =>$data['nama_nilai3'],
                    'nama_nilai4'   =>$data['nama_nilai4'],
                    'nama_nilai5'   =>$data['nama_nilai5'],
                  );
      $this->load->view('admin/nilai/jasmani/form',$view);
    }


    //view nnilai
    public function edit($id_pengguna='', $id_peserta='')
    {
      if (isset($_POST['cari'])) {
        $tahun = $this->input->post('tahun');

      $data = $this->m_kriteria->view_id('K003BNDjht')->row_array();
      $peserta  = $this->m_jasmani->view_peserta()->result_array();
      $nilai    = $this->m_jasmani->view_nilai($tahun)->result_array();
      $juri     = $this->m_jasmani->view_juri()->result_array();

     $view = array('judul'          =>'Data Nilai '.$data['kriteria'],
                   'aksi'           =>'edit',
                   'view_juri'      =>$juri,
                   'nama_peserta'   =>$peserta,
                   'data'           =>$nilai,
                    'nama_nilai1'   =>$data['nama_nilai1'],
                    'nama_nilai2'   =>$data['nama_nilai2'],
                    'nama_nilai3'   =>$data['nama_nilai3'],
                    'nama_nilai4'   =>$data['nama_nilai4'],
                    'nama_nilai5'   =>$data['nama_nilai5'],
                    'depan'         =>FALSE,
                    'tahun'         =>$tahun,
                  );
      $this->load->view('admin/nilai/jasmani/form',$view);
    }else{
      $data = $this->m_kriteria->view_id('K003BNDjht')->row_array();
      $view = array('judul'          =>'Data Nilai '.$data['kriteria'],
                    'aksi'           =>'edit',
                    'depan'          =>TRUE,
                  );
      $this->load->view('admin/nilai/jasmani/form',$view);
      }
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
    private function id_jasmani_urut($value='')
    {
    $this->m_jasmani->id_urut();
    $query   = $this->db->get();
    $data    = $query->row_array();
    $id      = $data['id_jasmani'];
    $karakter= $this->acak_id(5);
    $urut    = substr($id, 1, 3);
    $tambah  = (int) $urut + 1;
    
    if (strlen($tambah) == 1){
    $newID = "j"."00".$tambah.$karakter;
        }else if (strlen($tambah) == 2){
        $newID = "j"."0".$tambah.$karakter;
            }else (strlen($tambah) == 3){
            $newID = "j".$tambah.$karakter
            };
        return $newID;
    }


  //API add jasmani
  public function api_add($value='')
  {
    $rules = array(
      array(
        'field' => 'id_pengguna',
        'label' => 'id_pengguna',
        'rules' => 'required'
      ),
      array(
        'field' => 'id_peserta[]',
        'label' => 'id_peserta',
        'rules' => 'required'
      ),
    );
    $this->form_validation->set_rules($rules);
    if ($this->form_validation->run() == FALSE) {
      $response = [
        'status' => false,
        'message' => 'Tidak ada data'
      ];
    } else {
      $aid        =$this->input->post('id_peserta');
      $apengguna  =$this->input->post('id_pengguna');
      $atahun     =$this->input->post('tahun');

      if(!empty($aid)){
        for ($i=0; $i < count($aid); $i++) { 
          $id_peserta = $aid[$i];
          $id_jasmani = $this->id_jasmani_urut();
          $tahun      = $atahun;
          $SQLinsert = [
            'id_jasmani'      => $id_jasmani,
            'id_pengguna'     => $apengguna,
            'id_peserta'      => $id_peserta,
            'tahun'           => $tahun
          ];
          $this->m_jasmani->add($SQLinsert);
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

     //API edit
     public function api_edit($id='', $SQLupdate='')
     {
       $rules = array(
         array(
           'field' => 'nilai_lari',
            'label' => 'nilai_lari',
            'rules' => 'required'
          ),
          array(
            'field' => 'nilai_pushUp',
            'label' => 'nilai_pushUp',
            'rules' => 'required'
          ),
          array(
            'field' => 'nilai_sitUp',
            'label' => 'nilai_sitUp',
            'rules' => 'required'
          ),
       );
       $this->form_validation->set_rules($rules);
       if ($this->form_validation->run() == FALSE) {
         $response = [
           'status' => false,
           'message' => 'Tidak ada data'
         ];
       } else {
         $SQLupdate = [
           'nilai_lari'      => $this->input->post('nilai_lari'),
           'nilai_pushUp'    => $this->input->post('nilai_pushUp'),
           'nilai_sitUp'     => $this->input->post('nilai_sitUp')
         ];
         if ($this->m_jasmani->update($id, $SQLupdate)) {
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

     //API hapus
     public function api_empty_table($value='')
     {
       if ($this->m_jasmani->delete_semua_data()) {
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