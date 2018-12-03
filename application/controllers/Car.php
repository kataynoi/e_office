<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Car extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata("online"))
            redirect(site_url('user/login'));
        $this->load->model('Car_model', 'car');
        $this->load->model('User_model', 'user');
        $this->load->model('Outsite_model', 'outsite');
        $this->layout->setLayout('default_layout');
        $this->db = $this->load->database('default', true);
    }

    public function index()
    {
        $data['user'] = $this->db->get('mas_users')->result();

        $this->layout->view('welcome_message', $data);
    }
    public function cars()
    {
        $data['car'] = $this->car->get_car_list();
        $this->layout->view('car/cars_view', $data);

    }
    public function drivers()
    {
        $data['driver'] = $this->car->get_driver_list();
        $this->layout->view('car/drivers_view', $data);

    }
    public function calendar()
    {
        $data['driver'] = $this->car->get_driver_list();
        $this->layout->view('car/calendar_view', $data);

    }
    public function used_car($id)
    {

        $rs = $this->outsite->read($id);

        $rs->claim_type_name = $this->outsite->get_claim_type_id($rs->claim_type);
        $rs->travel_type_name = $this->outsite->get_travel_name($rs->travel_type);
        $rs->travel_cause = (string)$rs->travel_cause;
        $rs->invit_type=$this->outsite->get_invit_type($rs->invit_type);

        $data['out_site']=$rs;
        $data['member']=$this->outsite->get_permit_member($rs->id);
        $data['book_number'] = $this->outsite->get_book_number($data['member'][0]->user_id);
        $this->load->view('car/pdf/used_car_view',$data);

    }
}
