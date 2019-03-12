<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller
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

        $data['count_outsite'] = $this->db->from('outsite_permit')->count_all_results();
        $data['count_usecar'] = $this->db->from('used_car')->count_all_results();
        $data['count_approve_car'] = $this->db->from('used_car')->where('approve','1')->count_all_results();
        $data['count_users'] = $this->db->from('mas_users')->count_all_results();
        $data['outsite_today'] = $this->db->select('id,permit_user,objective,invit_place,permit_start_date,permit_end_date')
            ->where("DATE_FORMAT(NOW(),'%Y-%m-%d') = permit_start_date")
            ->get('outsite_permit')->result();
        //$data['user'] = $this->db->get('mas_users')->result();
        $this->layout->view('dashboard/index_view', $data);


    }
}
