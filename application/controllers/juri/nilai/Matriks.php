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
	 if($this->session->userdata('juri') != TRUE){
     redirect(base_url(''));
     exit;
	};
   $this->load->model('m_pengguna');
   $this->load->model('m_kriteria');
   $this->load->model('m_matriks');
   $this->load->model('m_nilai_hasil');
   $this->load->model('m_pengaturan');
	}

    //view nilai
    public function index($id_pengguna='', $id_peserta='')
    {
      
      $peserta      = $this->m_matriks->view_peserta()->result_array();
      $nilai        = $this->m_matriks->view_nilai()->result_array();
      $kriteria     = $this->m_matriks->view_kriteria()->result_array();
      $view['data'] = $this->m_nilai_hasil->view()->result_array();
      
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

         // Normalisasi matriks kriteria (Xij / √∑Xij^2)
          $normalizedMatrix = [];
          for ($i = 0; $i < $numAlternatives; $i++) {
              $normalizedMatrix[$i] = [];
              for ($j = 0; $j < $numCriteria; $j++) {
                  $normalizedMatrix[$i][$j] = $matrix[$i][$j] / sqrt(array_sum(array_column($matrix, $j)));
              }
          }
       

        // optimasi nilai (Hasil Optimasi = ∑Wj * Xij) dari matriks normalisasi dan bobot kriteria
        $results = [];
        for ($i = 0; $i < $numAlternatives; $i++) {
            $results[$i] = 0;
            for ($j = 0; $j < $numCriteria; $j++) {
                $results[$i] += $normalizedWeights[$j] * $normalizedMatrix[$i][$j];
            }
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
      
                 
      $this->load->view('juri/nilai/total_nilai/hasil',$view);
    }
 

     //nilai kriteria tinggi bb
      public function NilaiKriteriaTinggiBB($tinggi_bb)
      {
          // Logika perhitungan nilai kriteria
          if ($tinggi_bb >= 165 && $tinggi_bb <= 171.9) {
              $nilai = 1;
          } elseif ($tinggi_bb >= 172 && $tinggi_bb <= 175.9) {
              $nilai = 2;
          } elseif ($tinggi_bb >= 176 && $tinggi_bb <= 190) {
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
          } elseif ($berat_bb >= 64.9 && $berat_bb <= 75) {
              $nilai = 2;
          } elseif ($berat_bb >= 74.9 && $berat_bb <= 90) {
              $nilai = 1;
          } else {
              $nilai = 0; // Nilai default jika berat badan tidak masuk ke dalam rentang yang ditentukan
          }

          return $nilai;
      }   

}