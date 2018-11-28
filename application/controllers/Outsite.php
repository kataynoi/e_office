<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Outsite extends CI_Controller
{
    public $user_id;

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

    public function index()
    {

        $data['outsite_permit'] = $this->outsite->get_outsite_by_user($this->user_id);
        $this->layout->view('outsite/index', $data);
    }

    public function  add_outsite_permit($id = 0)
    {
        if ($id != 0) {
            $data['action'] = 'update';
        } else {
            $data['action'] = 'insert';
        }
        $data['outsite_member'] = $this->outsite->get_outsite_member($id);
        $data['cars'] =$this->outsite->get_outsite_cars($id);
        $data['outsite'] = $this->outsite->get_outsite_user($id,$this->user_id);
        $data['outsite_type'] = $this->outsite->get_outsite_type();
        $data['invit_type'] = $this->outsite->getAll_invit_type();
        $data['claim_type'] = $this->outsite->get_claim_type();
        $data['travel_type'] = $this->outsite->getAll_travel_type();
        $data['user'] = $this->outsite->get_user_id($this->user_id);
        $this->layout->view('outsite/add_outsite_permit', $data);
    }

    function fetch_outsite()
    {
        $fetch_data = $this->outsite->make_datatables();
        $data = array();
        foreach ($fetch_data as $row) {
            $sub_array = array();
            $sub_array[] = to_thai_date_short($row->permit_start_date) . " - " . to_thai_date_short($row->permit_end_date);
            $sub_array[] = $row->invit_subject;
            $sub_array[] = $row->invit_place;
            $sub_array[] = $row->invit_name;
            $sub_array[] = '<div class="btn-group" role="group"><a href="'.site_url('outsite/add_outsite_permit/').$row->id.'" class="btn btn-warning btn-sm" data-id="' . $row->id . '" class="btn btn-warning btn-xs"><i class="far fa-edit "></i> Edit</a>'.
            '<button data-btn="btn_del" class="btn btn-danger btn-sm" data-id="' . $row->id . '" class="btn btn-danger btn-xs"><i class="far fa-trash-alt "></i> Delete</button></div>';
            $data[] = $sub_array;
        }
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $this->outsite->get_all_data(),
            "recordsFiltered" => $this->outsite->get_filtered_data(),
            "data" => $data
        );
        echo json_encode($output);
    }

    public function  save_outsite(){
        $data = $this->input->post('items');
        $action=$this->input->post('action');
        if($data['action']=='insert'){
            $rs=$this->outsite->save_outsite($data);
        }else if($data['action']=='update'){
            $rs=$this->outsite->update_outsite($data);
        }
        if($rs){
            $json = '{"success": true}';
        }else{
            $json = '{"success": false}';
        }

        render_json($json);
    }
    public function del_outsite(){
        $id = $this->input->post('id');

        $rs=$this->outsite->del_outsite($id,$this->user_id);
        if($rs){
            $json = '{"success": true}';
        }else{
            $json = '{"success": false}';
        }

        render_json($json);
    }
}