<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Pengumuman extends CI_Controller
{

  public function index()
  {
    $data = [
      'content' => 'home/pengumuman/index'
    ];
    $this->load->view('home/layout/wrapper', $data);
  }
}

/* End of file Controllername.php */
