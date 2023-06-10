<?php 
/**
 * PHP for Codeigniter
 *
 * @package       CodeIgniter
 * @pengembang		Kassandra Production (https://kassandra.my.id)
 * @Author			@erikwahyudy
 * @version			3.0
 */

class M_nilai extends CI_model
{

private $table1 = 'tb_penilaian';
private $table2 = 'tb_kriteria';
private $table3 = 'tb_peserta';

//antrian
public function view()
{
  $this->db->select ('*');
  $this->db->from ($this->table1);
  $this->db->join ($this->table2, $this->table2.'.id_kriteria = '.$this->table1.'.id_kriteria');
  $this->db->join ($this->table3, $this->table3.'.id_peserta = '.$this->table1.'.id_peserta');
  $this->db->order_by ('id_penilaian', 'ASC');
  return $this->db->get ();
}

public function view_id($id='')
{
 return $this->db->select ('*')->from ($this->table1)->where ('id_penilaian', $id)->get ();
}

//mengambil id antrian urut terakhir
public function id_urut($value='')
{ 
  $this->db->select_max('id_penilaian');
  $this->db->from ($this->table1);
}



public function add($SQLinsert){
  return $this -> db -> insert($this->table1, $SQLinsert);
}

public function update($id='',$SQLupdate){
  $this->db->where('id_penilaian', $id);
  return $this->db-> update($this->table1, $SQLupdate);
}

public function delete($id=''){
  $this->db->where('id_penilaian', $id);
  return $this->db-> delete($this->table1);
}



}