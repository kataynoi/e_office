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
    public function outsite()
    {

        $rs = $this->calendar->get_ousite_calendar();
        foreach ($rs as $r){
            $event[] = array(
                'id' => $r['id'],
                'title' => $r['objective'],
                'start' => $r['permit_start_date'],
                'end' => $r['permit_end_date'],
            );
        }
        $data['event'] = $event;
        $this->layout->view("calendar/outsite_calendar.php", $data);
    }

}

?>