<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calendar extends CI_Controller
{

    public function __construct() {
        Parent::__construct();
        $this->layout->setLayout('default_layout');
        $this->load->model("calendar_model");
    }

    public function index()
    {
        $this->layout->view("calendar/index.php", array());
    }
    public function outsite()
    {
        $this->layout->view("calendar/outsite_calendar.php", array());
    }

}

?>