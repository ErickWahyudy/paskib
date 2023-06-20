<?php 

/**
* 
*/
class M_nilai_hasil extends CI_model
{

private $table1 = 'tb_nilai_hasil';
private $table2 = 'tb_peserta';

//nilai_hasil
public function view($value='')
{
  $this->db->select ('*');
  $this->db->from ($this->table1);
  $this->db->join ($this->table2, 'tb_nilai_hasil.id_peserta = tb_peserta.id_peserta');
  $this->db->order_by('hasil', 'DESC');
  return $this->db->get();
}

public function view_id($id='')
{
 return $this->db->select ('*')->from ($this->table1)->where ('id_nilai', $id)->get ();
}

//mengambil id nilai_hasil urut terakhir
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

/// get_by_nama
public function get_by_nama($nama, $tgl_lahir)
{
    $this->db->select('*');
    $this->db->from ($this->table1);
    $this->db->join ($this->table2, 'tb_nilai_hasil.id_peserta = tb_peserta.id_peserta');
    $this->db->order_by('hasil', 'DESC');
    return $this->db->get();
}

}