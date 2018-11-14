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
}
