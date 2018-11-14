<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Outsitepdf extends CI_Controller {
    public  $user_id;
    /**
     * Index Page for this controller.
     */
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata("online"))
            redirect(site_url('user/login'));
        $this->layout->setLayout('default_layout');
        $this->load->model('Outsite_model', 'outsite');
        $this->user_id = $this->session->userdata('id');
    }
    public function index(){

        $data['outsite_permit']=$this->outsite->get_outsite_by_user($this->user_id);
        $this->layout->view('outsite/index',$data);
    }
    public function outsite($template,$id)
    {

        $rs = $this->outsite->read($id);
        // $rs['permit_date'] =to_thai_date($rs['permit_date']);
        $rs->invit_type=$this->outsite->get_invit_type($rs->invit_type);
        $data['out_site']=$rs;
        //$rs->permit_position=$this->outsite->get_position($rs->permit_user);
        $rs->permit_user=$this->outsite->get_user($rs->permit_user);
        $data['member']=$this->outsite->get_permit_member($rs->id);
        $data['book_number'] = $this->outsite->get_book_number($data['member'][0]->user_id);
        //console_log($data['member']);
        $this->load->view('outsite/pdf/'.$template,$data);
        //$this->load->view('outsite/pdf/test_view',$data);

    }

}