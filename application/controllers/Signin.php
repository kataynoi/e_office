<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata("online"))
            redirect(site_url('user/login'));
        $this->layout->setLayout('default_layout');
        $this->load->model('Sign_model', 'sign');
        $this->db = $this->load->database('default', true);
    }

    public function index()
    {
        $data['sign'] = '';
        $data['sign_type'] = $this->db->get('sign_type')->result();
        $data['sl_group'] = $this->db->get('co_workgroup')->result();

        $this->layout->view('signin/index_view', $data);


    }
    public function get_sign(){
        $data = $this->input->post('items');

         $rs=$this->sign->get_sign($data);

        if($rs){
            $rows = json_encode($rs);
            $json = '{"success": true, "rows": ' . $rows . '}';
        }else{
            $json = '{"success": false}';
        }

        render_json($json);
    }

}
