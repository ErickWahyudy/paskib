<?php 

/**
* 
*/
class M_nilai_hasil extends CI_model
{

private $table1 = 'tb_nilai_hasil';
private $table2 = 'tb_peserta';
private $table3 = 'tb_pengguna';
private $table4 = 'tb_kriteria';

//dokter
public function view_nilai($id_peserta='')
{
  $this->db->select ('*');
  $this->db->from ($this->table4);
  $this->db->join ($this->table1, 'tb_nilai_hasil.id_kriteria = tb_kriteria.id_kriteria');
  $this->db->join ($this->table2, 'tb_nilai_hasil.id_peserta = tb_peserta.id_peserta');
  $this->db->where('tb_nilai_hasil.id_peserta', $id_peserta);
  $this->db->where('tb_peserta.id_peserta', $id_peserta);
  $this->db->order_by('tb_nilai_hasil.hasil', 'ASC');
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
  $this->db->from($this->table4);
  $this->db->order_by('id_kriteria', 'ASC');
  return $this->db->get();
}


//mengambil id urut terakhir
public function id_urut($value='')
{ 
  $this->db->select_max('id_nilai');
  $this->db->from ($this->table1);
}

public function add($SQLinsert){
  return $this -> db -> insert($this->table1, $SQLinsert);
}

public function update($id='',$SQLupdate){
  $this->db->where('id_nilai', $id);
  return $this->db-> update($this->table1, $SQLupdate);
}

public function delete_semua_data()
{
  $this->db->empty_table($this->table1);
}


}