<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_user extends CI_Controller
{
    public $user_id;
    public function __construct()
    {
        parent::__construct();

                if($this->session->userdata("user_type") != 1)
                    redirect(site_url("user/login"));
                $this->layout->setLeft("layout/left_admin");
                $this->layout->setLayout("admin_layout");
        $this->load->model('Admin_user_model', 'crud');
    }

    public function index()
    {
        $data[] = '';
        $data["cuser_type"] = $this->crud->get_cuser_type();
        $this->layout->view('admin_user/index', $data);
    }


    function fetch_admin_user()
    {
        $fetch_data = $this->crud->make_datatables();
        $data = array();
        foreach ($fetch_data as $row) {


            $sub_array = array();
                $sub_array[] = $row->id;
                $sub_array[] = $row->username;
                $sub_array[] = $row->name;
                $sub_array[] = $row->user_type;
                //$sub_array[] = $row->active;
                if($row->active=='1'){$active="checked";}else{$active="";}
                $sub_array[] = '<label class="switch"><input type="checkbox" '.$active.'><span class="slider round"></span></label>';
                $sub_array[] = '<div class="btn-group pull-right" role="group" >
                <button class="btn btn-outline btn-success" data-btn="btn_view" data-id="' . $row->id . '"><i class="fa fa-eye"></i></button>
                <button class="btn btn-outline btn-warning" data-btn="btn_edit" data-id="' . $row->id . '"><i class="fa fa-edit"></i></button>
                <button class="btn btn-outline btn-danger" data-btn="btn_del" data-id="' . $row->id . '"><i class="fa fa-trash"></i></button></div>';
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

    public function del_admin_user(){
        $id = $this->input->post('id');

        $rs=$this->crud->del_admin_user($id);
        if($rs){
            $json = '{"success": true}';
        }else{
            $json = '{"success": false}';
        }

        render_json($json);
    }

    public function  save_admin_user()
    {
            $data = $this->input->post('items');
            if($data['action']=='insert'){
                $rs=$this->crud->save_admin_user($data);
                if($rs){
                    $json = '{"success": true,"id":'.$rs.'}';
                  }else{
                    $json = '{"success": false}';
                  }
            }else if($data['action']=='update'){
                $rs=$this->crud->update_admin_user($data);
                    if($rs){
                        $json = '{"success": true}';
                    }else{
                        $json = '{"success": false}';
                    }
            }

            render_json($json);
        }

    public function  get_admin_user()
    {
                $id = $this->input->post('id');
                $rs = $this->crud->get_admin_user($id);
                $rows = json_encode($rs);
                $json = '{"success": true, "rows": ' . $rows . '}';
                render_json($json);
    }
}