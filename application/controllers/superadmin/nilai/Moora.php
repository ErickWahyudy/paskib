<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Moora extends CI_Controller
{
    public function __construct()
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
        $this->load->model('m_peserta');
        $this->load->model('m_nilai_hasil');
        $this->load->model('m_pengaturan');
    }


    public function index() {
        $peserta = $this->m_peserta->view()->result_array();
        $nilai        = $this->m_nilai_hasil->view_nilai()->result_array();
        
        $criteria = $this->m_kriteria->view()->result_array();
        $criteria = array_column($criteria, 'kriteria'); // Menggunakan kolom kriteria sebagai kriteria
        $weights = $this->m_kriteria->view()->result_array();
        $weights = array_column($weights, 'bobot'); // Menggunakan kolom bobot sebagai bobot

        // Data matriks nilai
        $matrix = [];
        foreach ($peserta as $p) {
            $nilai = $this->m_nilai_hasil->view_nilai($p['id_peserta']); // Misalnya, mengambil data nilai dari model
            $tinggi_bb = $p['tinggi_bb'];
            $berat_bb =  $p['berat_bb'];

            $nilai_kriteria = [];
            $nilai_kriteria[] = $tinggi_bb;
            $nilai_kriteria[] = $berat_bb;

            foreach ($nilai->result_array() as $n) {
                $nilai_kriteria[] = $n['nilai_kriteria'];
            }

            

            $matrix[] = $nilai_kriteria;
        }

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

        // Tampilkan hasil ke view
        $view['peserta'] = $peserta;
        $view['criteria'] = $criteria;
        $view['weights'] = $weights;
        $view['matrix'] = $matrix;
        $view['alternatives'] = array_column($peserta, 'nama_peserta'); // Menggunakan kolom nama_peserta sebagai alternatif
        $view['results'] = $results; // Hasil perhitungan metode Moora

        $this->load->view('superadmin/nilai/moora/moora', $view);
    
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
}
