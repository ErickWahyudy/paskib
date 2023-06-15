<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Matriks extends CI_controller
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
	 if($this->session->userdata('superadmin') != TRUE){
     redirect(base_url(''));
     exit;
	};
   $this->load->model('m_pengguna');
   $this->load->model('m_kriteria');
   $this->load->model('m_matriks');
   $this->load->model('m_pengaturan');
	}

    //view nilai
    public function index($id_pengguna='', $id_peserta='')
    {
      
      $peserta      = $this->m_matriks->view_peserta()->result_array();
      $nilai        = $this->m_matriks->view_nilai()->result_array();
      $kriteria     = $this->m_matriks->view_kriteria()->result_array();
      
      
       

        //Perhitungan Moora
        $criteria = $this->m_kriteria->view()->result_array();
        $criteria = array_column($criteria, 'kriteria'); // Menggunakan kolom kriteria sebagai kriteria
        $weights = $this->m_kriteria->view()->result_array();
        $weights = array_column($weights, 'bobot'); // Menggunakan kolom bobot sebagai bobot
        
        
        // Data matriks nilai
        $matrix = [];
        foreach ($peserta as $p) {
            $nilai = $this->m_matriks->view_nilai($p['id_peserta']); // Misalnya, mengambil data nilai dari model
            $tinggi_bb = $this->NilaiKriteriaTinggiBB($p['tinggi_bb']);
            $berat_bb =  $this->NilaiKriteriaBeratBB($p['berat_bb']);

            $nilai_kriteria = [];
            $nilai_kriteria[] = $tinggi_bb;
            $nilai_kriteria[] = $berat_bb;

            foreach ($nilai->result_array() as $n) {
                $nilai_kriteria[] = $n['nilai_kriteria'];
            }

            $matrix[] = $nilai_kriteria;
        }

        //jika database kosong maka tampilkan pesan tidak ada data
        if (empty($nilai)) {
          $view['pesan'] = 'Tidak ada data';
        } elseif ($nilai->num_rows() == 0) {
          $view['pesan'] = 'Tidak ada data';
        } else {
  
        

        // Hitung jumlah kriteria dan alternatif
        $numCriteria = count($criteria);
        $numAlternatives = count($peserta);

        // Normalisasi bobot
        $sumWeights = array_sum($weights);
        $normalizedWeights = [];
        foreach ($weights as $weight) {
            $normalizedWeights[] = $weight / $sumWeights;
        }
       

        // Hitung nilai Moora
        $results = [];
        for ($i = 0; $i < $numAlternatives; $i++) {
            $result = 0;
            for ($j = 0; $j < $numCriteria; $j++) {
                $result += $matrix[$i][$j] * $normalizedWeights[$j];
            }
            $results[] = $result;
        }
        
      // Tampilkan hasil moora ke view
      $view['peserta'] = $peserta;
      $view['criteria'] = $criteria;
      $view['weights'] = $weights;
      $view['matrix'] = $matrix;
      $view['alternatives'] = array_column($peserta, 'nama_peserta'); // Menggunakan kolom nama_peserta sebagai alternatif
      $view['results'] = $results; // Hasil perhitungan metode Moora
      }
 
      //view
      $view['judul']                ='Nilai Matriks';
      $view['nama_peserta']         =$peserta;
      $view['view_kriteria']        =$kriteria;
      $view['data']                 =$nilai;
      $view['nilai_peserta']        =$nilai;
      
                 
      $this->load->view('superadmin/nilai/total_nilai/lihat',$view);
    }
 

      //nilai kriteria tinggi bb
      public function NilaiKriteriaTinggiBB($tinggi_bb)
      {
          // Logika perhitungan nilai kriteria
          if ($tinggi_bb >= 165 && $tinggi_bb <= 171) {
              $nilai = 3;
          } elseif ($tinggi_bb >= 172 && $tinggi_bb <= 175) {
              $nilai = 2;
          } elseif ($tinggi_bb >= 176 && $tinggi_bb <= 190) {
              $nilai = 1;
          } else {
              $nilai = 0; // Nilai default jika berat badan tidak masuk ke dalam rentang yang ditentukan
          }
  
          return $nilai;
      }
  
      //nilai kriteria berat bb
      public function NilaiKriteriaBeratBB($berat_bb)
      {
          // Logika perhitungan nilai kriteria
          if ($berat_bb >= 50 && $berat_bb <= 65) {
              $nilai = 3;
          } elseif ($berat_bb >= 66 && $berat_bb <= 75) {
              $nilai = 2;
          } elseif ($berat_bb >= 76 && $berat_bb <= 90) {
              $nilai = 1;
          } else {
              $nilai = 0; // Nilai default jika berat badan tidak masuk ke dalam rentang yang ditentukan
          }
  
          return $nilai;
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
    private function id_matriks($value='')
    {
    $this->m_matriks->id_urut();
    $query   = $this->db->get();
    $data    = $query->row_array();
    $id      = $data['id_nilai'];
    $karakter= $this->acak_id(5);
    $urut    = substr($id, 1, 3);
    $tambah  = (int) $urut + 1;
    
    if (strlen($tambah) == 1){
    $newID = "T"."00".$tambah.$karakter;
        }else if (strlen($tambah) == 2){
        $newID = "T"."0".$tambah.$karakter;
            }else (strlen($tambah) == 3){
            $newID = "T".$tambah.$karakter
            };
        return $newID;
    }


  //API add jasmani
  public function api_add_jasmani($value='')
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
      array(
        'field' => 'nilai_kriteria[]',
        'label' => 'nilai_kriteria',
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
        $anilai     =$this->input->post('nilai_kriteria');

        if(!empty($aid)){
          for ($i=0; $i < count($aid); $i++) { 
            $id_peserta       =$aid[$i];
            $hasil            =$ahasil[$i];
            $nilai_kriteria   =$anilai[$i];
            $id_nilai         =$this->id_matriks();
            $id_kriteria      ='K003BNDjht';
            $SQLinsert        =array(
                                    'id_nilai'      =>$id_nilai,
                                    'id_peserta'    =>$id_peserta,
                                    'id_kriteria'   =>$id_kriteria,
                                    'hasil'         =>$hasil,
                                    'nilai_kriteria'=>$nilai_kriteria,
                                  );
            $this->m_matriks->add($SQLinsert);
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

//API add parade
  public function api_add_parade($value='')
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
      array(
        'field' => 'nilai_kriteria[]',
        'label' => 'nilai_kriteria',
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
        $anilai     =$this->input->post('nilai_kriteria');

        if(!empty($aid)){
          for ($i=0; $i < count($aid); $i++) { 
            $id_peserta         =$aid[$i];
            $hasil              =$ahasil[$i];
            $nilai_kriteria     =$anilai[$i];
            $id_nilai           =$this->id_matriks();
            $id_kriteria        ='K005ndLkXQ';
            $SQLinsert          =array(
                                      'id_nilai'    =>$id_nilai,
                                      'id_peserta'  =>$id_peserta,
                                      'id_kriteria' =>$id_kriteria,
                                      'hasil'       =>$hasil,
                                      'nilai_kriteria'=>$nilai_kriteria,
                                    );
            $this->m_matriks->add($SQLinsert);
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

    //API add pbb
  public function api_add_pbb($value='')
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
      array(
        'field' => 'nilai_kriteria[]',
        'label' => 'nilai_kriteria',
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
        $anilai     =$this->input->post('nilai_kriteria');

        if(!empty($aid)){
          for ($i=0; $i < count($aid); $i++) { 
            $id_peserta         =$aid[$i];
            $hasil              =$ahasil[$i];
            $nilai_kriteria     =$anilai[$i];
            $id_nilai           =$this->id_matriks();
            $id_kriteria        ='K004RHwS3n';
            $SQLinsert          =array(
                                      'id_nilai'      =>$id_nilai,
                                      'id_peserta'    =>$id_peserta,
                                      'id_kriteria'   =>$id_kriteria,
                                      'hasil'         =>$hasil,
                                      'nilai_kriteria'=>$nilai_kriteria,
                                    );
            $this->m_matriks->add($SQLinsert);
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
       if ($this->m_matriks->delete_semua_data()) {
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