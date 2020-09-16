<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Outsite_claim extends CI_Controller {

    /**
     * Index Page for this controller.
     */
    public function __construct()
    {
        parent::__construct();
        $this->layout->setLayout('default_layout');
        $this->load->model('Outsite_model', 'outsite');


    }
    public  function  index($id){
        $data="";
        $this->layout->view('claim/claimform_view',$data);
    }

}