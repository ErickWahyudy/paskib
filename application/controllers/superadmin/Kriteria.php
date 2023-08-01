<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Kriteria extends CI_controller
{
	function __construct()
	{
	 parent:: __construct();
     $this->load->helper('url');
      // needed ???
      $this->load->database();
      $this->load->library('session');
      $this->load->library('form_validation');
      
	 // error_reporting(0);
	 if($this->session->userdata('superadmin') != TRUE){
     redirect(base_url(''));
     exit;
	};
   $this->load->model('m_kriteria');
	}

    //kriteria
    public function index($value='')
    {
     $view = array('judul'     =>'Data kriteria',
                   'data'      =>$this->m_kriteria->view()->result_array(),
                  );

      $this->load->view('superadmin/kriteria/form',$view);
    }


      //API edit kriteria
      public function api_edit($id='', $SQLupdate='')
      {
        $rules = array(
          array(
            'field' => 'kriteria',
            'label' => 'Nama kriteria',
            'rules' => 'required',
            'errors' => array(
                'required' => 'Nama kriteria tidak boleh kosong',
            ),
          ),
          array(
            'field' => 'bobot',
            'label' => 'Botot nilai',
            'rules' => 'required',
            'errors' => array(
                'required' => 'Bobot nilai tidak boleh kosong',
            ),
          ),
        );
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == FALSE) {
          $response = [
            'status' => false,
            'message' => 'Tidak ada data'
          ];
        } else {
          $SQLupdate = [
            'kriteria'           => $this->input->post('kriteria'),
            'bobot'              => $this->input->post('bobot'),
            'nama_nilai1'        => $this->input->post('nama_nilai1'),
            'nama_nilai2'        => $this->input->post('nama_nilai2'),
            'nama_nilai3'        => $this->input->post('nama_nilai3'),
            'nama_nilai4'        => $this->input->post('nama_nilai4'),
            'nama_nilai5'        => $this->input->post('nama_nilai5')
          ];
          if ($this->m_kriteria->update($id, $SQLupdate)) {
            $response = [
              'status' => true,
              'message' => 'Berhasil mengubah data'
            ];
          } else {
            $response = [
              'status' => false,
              'message' => 'Gagal mengubah data'
            ];
          }
        }
        $this->output
          ->set_content_type('application/json')
          ->set_output(json_encode($response));
      }
	
}