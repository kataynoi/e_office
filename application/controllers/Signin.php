<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata("online"))
            redirect(site_url('user/login'));
        $this->layout->setLayout('default_layout');
        $this->db = $this->load->database('default', true);
    }

    public function index()
    {
        $data['count_outsite'] = '';
        $this->layout->view('signin/index_view', $data);


    }
}
