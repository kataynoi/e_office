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

        $stat_m = (current_year()-1)."-10";
        $end_m = (current_year())."-09";
        $data['count_outsite'] = $this->db
            ->where("DATE_FORMAT(permit_start_date,'%Y-%m')  BETWEEN '".$stat_m."' AND '".$end_m."'")
            ->from('outsite_permit')
            ->count_all_results();
        $data['count_usecar'] = $this->db
            ->where("DATE_FORMAT(b.permit_start_date,'%Y-%m')  BETWEEN '".$stat_m."' AND '".$end_m."'")
            ->join('outsite_permit b','a.outsite_id=b.id')
            ->from('used_car a')->count_all_results();
        $data['count_approve_car'] = $this->db
            ->where("DATE_FORMAT(b.permit_start_date,'%Y-%m')  BETWEEN '".$stat_m."' AND '".$end_m."'")
            ->join('outsite_permit b','a.outsite_id=b.id')
            ->from('used_car a')->where('a.approve','1')
            ->count_all_results();
        $data['count_users'] = $this->db
            ->where('active','1')
            ->from('employee')
            ->count_all_results();
        $data['outsite_today'] = $this->db->select('id,permit_user,objective,invit_place,permit_start_date,permit_end_date')
            ->where("DATE_FORMAT(NOW(),'%Y-%m-%d') = permit_start_date")
            ->get('outsite_permit')->result();
        //$data['user'] = $this->db->get('mas_users')->result();
        $this->layout->view('dashboard/index_view', $data);


    }
}
