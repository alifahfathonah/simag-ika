<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in_admin();
    }


    public function index()
    {
        $id_user = $this->session->userdata('id_user');
        $user = $this->Crud_model->listingOne('tbl_user', 'id_user', $id_user);

        $data = [
            'title'     => 'Dashboard',
            'user'      => $user,
            'peserta'      => $this->Crud_model->listing('tbl_user'),
            'instansi'      => $this->Crud_model->listing('tbl_instansi'),
            'admin'      => $this->Crud_model->listing('tbl_user'),
            'content'   => 'admin/dashboard/index'
        ];

        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }
}

/* End of file Dashboard.php */
