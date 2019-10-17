<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller
{
    public $user_id;

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata("online"))
            redirect(site_url('user/login'));
        $this->layout->setLayout('default_layout');
        $this->load->model('Employee_model', 'crud');
    }

    public function index()
    {
        $data[] = '';

        $this->layout->view('employee/index', $data);
    }


    function fetch_employee()
    {
        $fetch_data = $this->crud->make_datatables();
        $data = array();
        foreach ($fetch_data as $row) {


            $sub_array = array();
            //$sub_array[] = $row->id;
            $sub_array[] = $row->prename;
            $sub_array[] = $row->name;
           // $sub_array[] = $row->cid;
            //$sub_array[] = $row->sex;
            $sub_array[] = $row->position;
            //$sub_array[] = $row->hospcode;
            //$sub_array[] = $row->employee_type;
            $sub_array[] = $row->group;
           // $sub_array[] = $row->username;

            //$sub_array[] = $row->password;
            $sub_array[] = $row->user_mobile;
            //$sub_array[] = $row->email;
            //$sub_array[] = $row->date_in;
            $data[] = $sub_array;
        }
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $this->crud->get_all_data(),
            "recordsFiltered" => $this->crud->get_filtered_data(),
            "data" => $data
        );
        echo json_encode($output);
    }

    public function del_employee()
    {
        $id = $this->input->post('id');

        $rs = $this->crud->del_employee($id);
        if ($rs) {
            $json = '{"success": true}';
        } else {
            $json = '{"success": false}';
        }

        render_json($json);
    }

    public function  save_employee()
    {
        $data = $this->input->post('items');
        if ($data['action'] == 'insert') {
            $rs = $this->crud->save_employee($data);
            if ($rs) {
                $json = '{"success": true,"id":' . $rs . '}';
            } else {
                $json = '{"success": false}';
            }
        } else if ($data['action'] == 'update') {
            $rs = $this->crud->update_employee($data);
            if ($rs) {
                $json = '{"success": true}';
            } else {
                $json = '{"success": false}';
            }
        }

        render_json($json);
    }

    public function  get_employee()
    {
        $id = $this->input->post('id');
        $rs = $this->crud->get_employee($id);
        $rows = json_encode($rs);
        $json = '{"success": true, "rows": ' . $rows . '}';
        render_json($json);
    }
}