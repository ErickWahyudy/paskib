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
        $this->load->model('m_jasmani');
        $this->load->model('m_pengaturan');
    }

    public function index()
    {
      // Data alternatif
        $alternatives = array(
            array('nama' => 'Alternatif 1', 'k1' => 80, 'k2' => 90, 'k3' => 70),
            array('nama' => 'Alternatif 2', 'k1' => 70, 'k2' => 85, 'k3' => 80),
            array('nama' => 'Alternatif 3', 'k1' => 90, 'k2' => 70, 'k3' => 75),
        );
        
        // Bobot kriteria
        $weights = array(          

            $k1 = '40' / 100,
            $k2 = '30' / 100,
            $k3 = '10' / 100,

            // $K1 = 0.4,
            'k1' => $k1,
            'k2' => $k2,
            'k3' => $k3,
        );

        // Hitung nilai preferensi untuk setiap alternatif
        $scores = array();
        foreach ($alternatives as $alternative) {
            $score = 0;
            foreach ($alternative as $key => $value) {
                if ($key !== 'nama') {
                    $score += $value * $weights[$key];
                }
            }
            $alternative['nilai'] = $score;
            $scores[] = $alternative;
        }

        // Urutkan alternatif berdasarkan nilai akhir (nilai preferensi)
        usort($scores, function ($a, $b) {
            return $b['nilai'] - $a['nilai'];
        });

        // Tampilkan hasil pada view
        $data['result'] = $scores;
        $this->load->view('superadmin/nilai/moora/moora', $data);
    }

}
