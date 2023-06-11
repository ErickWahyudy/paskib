<?php

class M_moora extends CI_Model
{
    private $table1 = 'tb_kriteria';

    public function hitungMoora()
    {
        $alternatif = $this->db->get('alternatif')->result_array();
        $kriteria = $this->db->get($this->table1)->result_array();
        $bobotKriteria = array();
        
        foreach ($kriteria as $k) {
            $bobotKriteria[$k['id_kriteria']] = $k['bobot'];
        }

        $skorAlternatif = array();
        
        foreach ($alternatif as $alt) {
            $skor = array();
            
            foreach ($kriteria as $k) {
                $nilaiKriteria = $this->getNilaiKriteria($k['id_kriteria']);
                $skor[$k['id_kriteria']] = $nilaiKriteria / $k['max_nilai_kriteria'];
            }
            
            $skorAlternatif[$alt['id_alternatif']] = $skor;
        }

        $hasilMoora = array();
        
        foreach ($skorAlternatif as $idAlternatif => $skor) {
            $hasil = 0;
            
            foreach ($skor as $idKriteria => $nilai) {
                $hasil += $nilai * $bobotKriteria[$idKriteria];
            }
            
            $hasilMoora[$idAlternatif] = $hasil;
        }

        return $hasilMoora;
    }

    public function getNilaiKriteria($idKriteria)
    {
        // Lakukan operasi yang sesuai dengan perolehan nilai kriteria dari view
        return $idKriteria;
    }
}
