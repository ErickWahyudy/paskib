<?php 

/**
* 
*/
class M_jasmani extends CI_model
{

private $table1 = 'tb_jasmani';
private $table2 = 'tb_peserta';
private $table3 = 'tb_pengguna';

//dokter
public function view_nilai($id_peserta='', $tahun='')
{
  $this->db->select ('*');
  $this->db->from ($this->table3);
  $this->db->join ($this->table1, 'tb_jasmani.id_pengguna = tb_pengguna.id_pengguna');
  $this->db->join ($this->table2, 'tb_jasmani.id_peserta = tb_peserta.id_peserta');
  $this->db->where('tb_jasmani.id_peserta', $id_peserta);
  $this->db->where('tb_peserta.id_peserta', $id_peserta);
  $this->db->where('tb_jasmani.tahun', $tahun);
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

public function view_peserta($tahun='')
{
  $this->db->select('*');
  $this->db->from($this->table2);
  $this->db->where('tb_peserta.tahun', $tahun);
  $this->db->order_by('nama_peserta', 'ASC');
  return $this->db->get();
}

//view
public function view($tahun='')
{
  $this->db->select ('*');
  $this->db->from ($this->table1);
  $this->db->where('tb_jasmani.tahun', $tahun);
  return $this->db->get();
}

//mengambil id dokter urut terakhir
public function id_urut($value='')
{ 
  $this->db->select_max('id_jasmani');
  $this->db->from ($this->table1);
}

public function add($SQLinsert){
  return $this -> db -> insert($this->table1, $SQLinsert);
}

public function update($id='',$SQLupdate){
  $this->db->where('id_jasmani', $id);
  return $this->db-> update($this->table1, $SQLupdate);
}

//delete id
public function delete($id=''){
  $this->db->where('id_jasmani', $id);
  return $this->db-> delete($this->table1);
}

//delete semua
public function delete_semua_data()
{
  $this->db->empty_table($this->table1);
}

 //untuk juri
 public function view_pesertaNilai($tahun='')
{
  $id = $this->session->userdata['id_pengguna'];
  $this->db->select('*');
  $this->db->from($this->table1);
  $this->db->join($this->table2, 'tb_jasmani.id_peserta = tb_peserta.id_peserta');
  $this->db->where('tb_jasmani.id_pengguna', $id);
  $this->db->where('tb_peserta.tahun', $tahun);
  $this->db->order_by('tb_peserta.nama_peserta', 'ASC');
  return $this->db->get();
}



}