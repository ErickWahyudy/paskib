<?php 
/**
 * PHP for Codeigniter
 *
 * @package       CodeIgniter
 * @pengembang		Kassandra Production (https://kassandra.my.id)
 * @Author			@erikwahyudy
 * @version			3.0
 */

class login_m extends CI_model
{
	
 public function superadmin($nama='', $email='', $password='', $id_level='1')
 {
  return $this->db->query("SELECT * from tb_pengguna where (nama='$nama' OR email='$email') AND password='$password' AND id_level='$id_level' limit 1");
 }

 public function admin($nama='', $email='', $password='', $id_level='2')
 {
  return $this->db->query("SELECT * from tb_pengguna where (nama='$nama' OR email='$email') AND password='$password' AND id_level='$id_level' limit 1");
 }

 public function juri($nama='', $email='', $password='', $id_level='3')
 {
  return $this->db->query("SELECT * from tb_pengguna where (nama='$nama' OR email='$email') AND password='$password' AND id_level='$id_level' limit 1");
 }

 public function peserta($nama='', $tgl_lahir='', $level='peserta')
 {
  return $this->db->query("SELECT * from tb_peserta where nama_peserta='$nama' AND tgl_lahir='$tgl_lahir' AND level='$level' limit 1");
 }

}