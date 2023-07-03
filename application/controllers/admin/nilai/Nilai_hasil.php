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
	 if($this->session->userdata('admin') != TRUE){
     redirect(base_url(''));
     exit;
	};
   $this->load->model('m_pengguna');
   $this->load->model('m_peserta');
   $this->load->model('m_kriteria');
   $this->load->model('m_matriks');
   $this->load->model('m_nilai_hasil');
	}

    //view nilai
    public function index($value='')
    {
      if (isset($_POST['cari'])) {
        $tahun = $this->input->post('tahun');
    
      $peserta      = $this->m_matriks->view_peserta()->result_array();
      $nilai        = $this->m_matriks->view_nilai()->result_array();
      $kriteria     = $this->m_matriks->view_kriteria()->result_array();
      $view['data'] = $this->m_nilai_hasil->view($tahun)->result_array();
      
        //Perhitungan Moora
        $criteria = $this->m_kriteria->view()->result_array();
        $criteria = array_column($criteria, 'kriteria'); // Menggunakan kolom kriteria sebagai kriteria
        $weights = $this->m_kriteria->view()->result_array();
        $weights = array_column($weights, 'bobot'); // Menggunakan kolom bobot sebagai bobot
        
        
        // Data matriks nilai
        $matrix = [];
        foreach ($peserta as $p) {
            $nilai = $this->m_matriks->view_nilai($p['id_peserta'], $tahun); // Misalnya, mengambil data nilai dari model
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

         // Normalisasi matriks kriteria (Xij / √∑Xij^2)
        $normalizedMatrix = [];
        for ($j = 0; $j < $numCriteria; $j++) {
            $sumSquared = 0; // Variable to store the sum of squared values for the current column
            
            // Calculate the sum of squared values for the current column
            for ($i = 0; $i < $numAlternatives; $i++) {
                $sumSquared += pow($matrix[$i][$j], 2);
            }
            
            // Normalize the values in the current column
            for ($i = 0; $i < $numAlternatives; $i++) {
                $normalizedMatrix[$i][$j] = $matrix[$i][$j] / sqrt($sumSquared);
            }
        }
      

        // Menghitung nilai optimasi
        $results = [];
        for ($i = 0; $i < $numAlternatives; $i++) {
            $result = 0;
            $result += ($normalizedMatrix[$i][0] * $normalizedWeights[0]); // X1.1(max).w1
            $result += ($normalizedMatrix[$i][2] * $normalizedWeights[2]); // X1.3(max).w3
            $result += ($normalizedMatrix[$i][3] * $normalizedWeights[3]); // X1.4(max).w4
            $result += ($normalizedMatrix[$i][4] * $normalizedWeights[4]); // X1.5(max).w5
            $result -= ($normalizedMatrix[$i][1] * $normalizedWeights[1]); // X1.2(min).w2
            $results[$i] = $result;
        }
        
      // Tampilkan hasil moora ke view
      $view['peserta'] = $peserta;
      $view['criteria'] = $criteria;
      $view['weights'] = $weights;
      $view['matrix'] = $matrix;
      $view['normalizedMatrix'] = $normalizedMatrix;
      $view['alternatives'] = array_column($peserta, 'nama_peserta'); // Menggunakan kolom nama_peserta sebagai alternatif
      $view['results'] = $results; // Hasil perhitungan metode Moora
      }
 
      //view
      $view['judul']                ='Data Hasil Nilai';
      $view['judul2']               ='Data Alternatif';
      $view['nama_peserta']         =$peserta;
      $view['view_kriteria']        =$kriteria;
      $view['nilai_peserta']        =$nilai;
      $view['depan']                =FALSE;
      $view['tahun']                =$tahun;
                 
      $this->load->view('admin/nilai/total_nilai/nilai_hasil',$view);
    }else{
      $view['judul']                ='Data Hasil Nilai';
      $view['judul2']               ='Data Alternatif';
      $view['depan']                =TRUE;

      $this->load->view('admin/nilai/total_nilai/nilai_hasil',$view);
    }
  }

      //nilai kriteria tinggi bb
      public function NilaiKriteriaTinggiBB($tinggi_bb)
      {
        // Logika perhitungan nilai kriteria
        if ($tinggi_bb >= 165 && $tinggi_bb <= 171) {
          $nilai = 1;
        } elseif ($tinggi_bb >= 172 && $tinggi_bb <= 175) {
          $nilai = 2;
        } elseif ($tinggi_bb >= 176 && $tinggi_bb <= 180) {
          $nilai = 3;
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
      array(
        'field' => 'tahun[]',
        'label' => 'tahun',
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
        $atahun     =$this->input->post('tahun');

        if(!empty($aid)){
          for ($i=0; $i < count($aid); $i++) { 
            $id_peserta       =$aid[$i];
            $hasil            =$ahasil[$i];
            $tahun            =$atahun[$i];
            $id_nilai         =$this->id_nilai();
            $SQLinsert        =array(
                                    'id_nilai'    =>$id_nilai,
                                    'id_peserta'    =>$id_peserta,
                                    'hasil'         =>$hasil,
                                    'tahun'         =>$tahun,
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