<?php

class Saker extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Saker_model');
    }

    public function index()
    {
        $data = [
            'title' => 'saker',
            'user' => $this->db->get_where('user', ['email' =>
            $this->session->userdata('email')])->row_array(),
            'get_saker' => $this->Saker_model->getSaker(),
        ];

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/saker/index', $data);
        $this->load->view('templates/user_footer');
    }
}
