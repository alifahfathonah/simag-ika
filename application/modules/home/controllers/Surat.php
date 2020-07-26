<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Surat extends CI_Controller
{

  public function index()
  {
    $instansi = $this->Crud_model->listing('tbl_instansi');
    $data = [
      'instansi' => $instansi,
      'content' => 'home/surat/index'
    ];
    $this->load->view('home/layout/wrapper', $data);
  }

  function kirim()
  {
    $i = $this->input;
    $valid = $this->form_validation;
    $valid->set_rules('instansi_asal', 'Instansi Asal', 'required', ['required' => '%s tidak boleh kosong']);
    $valid->set_rules('kontak', 'Kontak', 'required', ['required' => '%s tidak boleh kosong']);


    if ($valid->run()) {
      if (!empty($_FILES['dokumen']['name'])) {
        $config['upload_path']   = './assets/uploads/surat/';
        $config['allowed_types'] = 'pdf';
        $config['max_size']      = '24000'; // KB 
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('dokumen')) {
          $data = [
            'error'     => $this->upload->display_errors(),
            'content' => 'home/surat/index'
          ];
          $this->load->view('home/layout/wrapper', $data, FALSE);
        } else {
          $upload_data = ['uploads' => $this->upload->data()];
          $data = [
            'id_instansi'   => $i->post('id_instansi'),
            'instansi_asal'   => $i->post('instansi_asal'),
            'kontak'   => $i->post('kontak'),
            'deskripsi'   => $i->post('deskripsi'),
            'dokumen'        => $config['upload_path'] . $upload_data['uploads']['file_name']
          ];
          $this->Crud_model->add('tbl_surat', $data);
          $this->session->set_flashdata('msg', 'Surat dikirim. Silakan tunggu  konfirmasi dihalaman pengumuman');
          redirect('home/surat');
        }
      }
    }
    $this->index();
  }
}