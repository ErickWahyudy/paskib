<?php 
/**
 * PHP for Codeigniter
 *
 * @package       CodeIgniter
 * @pengembang		Kassandra Production (https://kassandra.my.id)
 * @Author			@erikwahyudy
 * @version			3.0
 */

class M_peserta extends CI_model
{
    private $table1 = 'tb_peserta';

//peserta	
public function view($tahun='')
{
    //join table peserta dan periode
    $this->db->select('*');
    $this->db->from($this->table1);
    $this->db->where('tahun', $tahun);
    $this->db->order_by('nama_peserta');
    return $this->db->get();
}

public function view_id($id='')
{
 return $this->db->select ('*')->from ($this->table1)->where ('id_peserta', $id)->get ();
}

//mengambil id peserta urut terakhir
public function id_urut($value='')
{ 
  $this->db->select_max('id_peserta');
  $this->db->from ($this->table1);
}

public function add($SQLinsert){
  return $this -> db -> insert($this->table1, $SQLinsert);
}

public function update($id='',$SQLupdate){
  $this->db->where('id_peserta', $id);
  return $this->db-> update($this->table1, $SQLupdate);
}

//delete 2 table
public function delete($id=''){
  $this->db->where('id_peserta', $id);
  return $this->db-> delete($this->table1);
}


//untuk page peserta
public function view_id_peserta($id='')
{
  //join table peserta dan periode di peserta
  $id = $this->session->userdata['id_peserta'];
  $this->db->select('*');
  $this->db->from($this->table1);
  $this->db->where('id_peserta', $id);
  $this->db->order_by('id_peserta');
  return $this->db->get();
}



}
