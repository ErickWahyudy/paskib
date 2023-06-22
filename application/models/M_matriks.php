<?php 

/**
* 
*/
class M_matriks extends CI_model
{

private $table1 = 'tb_matriks';
private $table2 = 'tb_peserta';
private $table3 = 'tb_kriteria';

//dokter
public function view_nilai($id_peserta='')
{
  $this->db->select ('*');
  $this->db->from ($this->table3);
  $this->db->join ($this->table1, 'tb_matriks.id_kriteria = tb_kriteria.id_kriteria');
  $this->db->join ($this->table2, 'tb_matriks.id_peserta = tb_peserta.id_peserta');
  $this->db->where('tb_matriks.id_peserta', $id_peserta);
  return $this->db->get();
}

public function view_nilaihasil()
{
  $this->db->select('*');
  $this->db->from($this->table1);
  return $this->db->get();
}


public function view_peserta()
{
  $this->db->select('*');
  $this->db->from($this->table2);
  $this->db->order_by('nama_peserta', 'ASC');
  return $this->db->get();
}

public function view_kriteria($value='')
{
  $this->db->select('*');
  $this->db->from($this->table3);
  $this->db->order_by('id_kriteria', 'ASC');
  return $this->db->get();
}


//mengambil id urut terakhir
public function id_urut($value='')
{ 
  $this->db->select_max('id_matriks');
  $this->db->from ($this->table1);
}

public function add($SQLinsert){
  return $this -> db -> insert($this->table1, $SQLinsert);
}

public function update($id='',$SQLupdate){
  $this->db->where('id_matriks', $id);
  return $this->db-> update($this->table1, $SQLupdate);
}

public function delete_semua_data()
{
  $this->db->empty_table($this->table1);
}


}