<?php 

/**
* 
*/
class M_parade extends CI_model
{

private $table1 = 'tb_parade';
private $table2 = 'tb_peserta';
private $table3 = 'tb_pengguna';

//dokter
public function view_nilai($id_peserta='')
{
  $this->db->select ('*');
  $this->db->from ($this->table3);
  $this->db->join ($this->table1, 'tb_parade.id_pengguna = tb_pengguna.id_pengguna');
  $this->db->join ($this->table2, 'tb_parade.id_peserta = tb_peserta.id_peserta');
  $this->db->where('tb_parade.id_peserta', $id_peserta);
  $this->db->where('tb_peserta.id_peserta', $id_peserta);
  $this->db->order_by('tb_pengguna.id_pengguna', '3', 'ASC');
  return $this->db->get();
}

public function view_juri($value='')
{
  $this->db->select('*');
  $this->db->from($this->table3);
  $this->db->where('tb_pengguna.id_level', '3');
  $this->db->order_by('keterangan', 'ASC');
  return $this->db->get();
}

public function view_peserta()
{
  $this->db->select('*');
  $this->db->from($this->table2);
  $this->db->order_by('nama_peserta', 'ASC');
  return $this->db->get();
}


//mengambil id dokter urut terakhir
public function id_urut($value='')
{ 
  $this->db->select_max('id_parade');
  $this->db->from ($this->table1);
}

public function add($SQLinsert){
  return $this -> db -> insert($this->table1, $SQLinsert);
}

public function update($id='',$SQLupdate){
  $this->db->where('id_parade', $id);
  return $this->db-> update($this->table1, $SQLupdate);
}

public function delete($id=''){
  $this->db->where('id_parade', $id);
  return $this->db-> delete($this->table1);
}

//nilai kriteria parade
public function NilaiKriteria($total)
{
  // Logika perhitungan nilai kriteria
  if ($total >= 77 && $total <= 90) {
  $nilai = 3;
   } elseif ($total >= 74 && $total <= 76) {
    $nilai = 2;
      } elseif ($total >= 70 && $total <= 73) {
      $nilai = 1;
        } else {
         $nilai = 0; // Nilai default jika berat badan tidak masuk ke dalam rentang yang ditentukan
          }

          return $nilai;
      }


}