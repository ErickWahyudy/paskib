<?php 

/**
* 
*/
class M_kriteria extends CI_model
{

private $table = 'tb_kriteria';

//dokter
public function view($value='')
{
  $this->db->select ('*');
  $this->db->from ($this->table);
  return $this->db->get();
}

public function view_id($id='')
{
 return $this->db->select ('*')->from ($this->table)->where ('id_kriteria', $id)->get ();
}

//mengambil id dokter urut terakhir
public function id_urut($value='')
{ 
  $this->db->select_max('id_kriteria');
  $this->db->from ($this->table);
}

public function add($SQLinsert){
  return $this -> db -> insert($this->table, $SQLinsert);
}

public function update($id='',$SQLupdate){
  $this->db->where('id_kriteria', $id);
  return $this->db-> update($this->table, $SQLupdate);
}

public function delete($id=''){
  $this->db->where('id_kriteria', $id);
  return $this->db-> delete($this->table);
}


//nilai kriteria tinggi bb
public function NilaiKriteriaTinggiBB($tinggi_bb)
{
    // Logika perhitungan nilai kriteria
    if ($tinggi_bb >= 165 && $tinggi_bb <= 172) {
        $nilai = 3;
    } elseif ($tinggi_bb >= 172 && $tinggi_bb <= 176) {
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
    } elseif ($berat_bb >= 65 && $berat_bb <= 75) {
        $nilai = 2;
    } elseif ($berat_bb >= 75 && $berat_bb <= 90) {
        $nilai = 1;
    } else {
        $nilai = 0; // Nilai default jika berat badan tidak masuk ke dalam rentang yang ditentukan
    }

    return $nilai;
}


public function NilaiKriteriaJasmani($total)
    {
        // Logika perhitungan nilai kriteria
        if ($total >= 77 && $total <= 90) {
            $nilai = 3;
        } elseif ($total >= 71 && $total <= 77) {
            $nilai = 2;
        } elseif ($total >= 65 && $total <= 71) {
            $nilai = 1;
        } else {
            $nilai = 0; // Nilai default jika berat badan tidak masuk ke dalam rentang yang ditentukan
        }

        return $nilai;
    }

//nilai kriteria parade
public function NilaiKriteriaParade($total)
{
  // Logika perhitungan nilai kriteria
  if ($total >= 77 && $total <= 90) {
  $nilai = 3;
   } elseif ($total >= 74 && $total <= 77) {
    $nilai = 2;
      } elseif ($total >= 70 && $total <= 74) {
      $nilai = 1;
        } else {
         $nilai = 0; // Nilai default jika berat badan tidak masuk ke dalam rentang yang ditentukan
          }

          return $nilai;
      }

//nilai kriteria pbb
public function NilaiKriteriaPBB($total)
{
    // Logika perhitungan nilai kriteria
    if ($total >= 77 && $total <= 90) {
        $nilai = 3;
    } elseif ($total >= 74 && $total <= 77) {
        $nilai = 2;
    } elseif ($total >= 70 && $total <= 74) {
        $nilai = 1;
    } else {
        $nilai = 0; // Nilai default jika berat badan tidak masuk ke dalam rentang yang ditentukan
    }

    return $nilai;
}


}