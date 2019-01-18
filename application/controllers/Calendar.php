<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calendar extends CI_Controller
{

    public function __construct() {
        Parent::__construct();
        $this->layout->setLayout('default_layout');
        $this->load->model("calendar_model",'calendar');
    }

    public function index()
    {
        $this->layout->view("calendar/index.php", array());
    }
    public function outsite($month='2018-10')
    {

        $data['outsite_calendar'] = $this->calendar->get_ousite_calendar($month);
        $this->layout->view("calendar/outsite_calendar.php", $data);
    }

}

?>