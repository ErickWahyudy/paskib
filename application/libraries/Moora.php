<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Moora
{
    private $alternatives;
    private $weights;

    public function setData($alternatives, $weights)
    {
        $this->alternatives = $alternatives;
        $this->weights = $weights;
    }

    public function calculate()
    {
        // Hitung nilai preferensi untuk setiap alternatif
        $scores = array();
        foreach ($this->alternatives as $alternative) {
            $score = 0;
            foreach ($alternative as $key => $value) {
                if ($key !== 'nama') {
                    $score += $value * $this->weights[$key];
                }
            }
            $scores[] = $score;
        }

        // Urutkan alternatif berdasarkan nilai akhir (nilai preferensi)
        array_multisort($scores, SORT_DESC, $this->alternatives);

        return $this->alternatives;
    }
}
