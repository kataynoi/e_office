<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Outsite_claim_pdf extends CI_Controller {
    public  $user_id;
    /**
     * Index Page for this controller.
     */
    public function __construct()
    {
        parent::__construct();
        $this->layout->setLayout('default_layout');
        $this->load->model('Outsite_model', 'outsite');
        $this->user_id = $this->session->userdata('id');


    }
    public function index(){

        $data['outsite_permit']=$this->outsite->get_outsite_by_user($this->user_id);
        $this->layout->view('outsite/index',$data);
    }
    public function outsite_claim($template,$id)
    {

        $rs = $this->outsite->read($id);
        // $rs['permit_date'] =to_thai_date($rs['permit_date']);
        $rs->invit_type=$this->outsite->get_invit_type($rs->invit_type);
        $rs->permit_position=$this->outsite->get_position($rs->permit_user);
        $rs->permit_user=$this->outsite->get_user($rs->permit_user);

        $data['out_site']=$rs;

        $this->load->view('outsite/pdf/'.$template,$data);
        //$this->load->view('outsite/pdf/outsite',$data);

    }
    public function outsite2($id)
    {

        $rs = $this->outsite->read($id);
        // $rs['permit_date'] =to_thai_date($rs['permit_date']);
        $rs->invit_type=$this->outsite->get_invit_type($rs->invit_type);
        $rs->permit_position=$this->outsite->get_position($rs->permit_user);
        $rs->permit_user=$this->outsite->get_user($rs->permit_user);

        $data['out_site']=$rs;

        $this->load->view('outsite/pdf/outsite2_pdf',$data);
        //$this->load->view('outsite/pdf/outsite',$data);

    }
}