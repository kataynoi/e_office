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
        $this->load->model('Basic_model', 'basic');
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
        $data['outsite'] = $this->outsite->get_outsite_user($id);
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
            if(check_role(4,$this->session->userdata('id'))){
                $row->lock == '1'? $lock ='<button class="btn" data-btn="lock" data-id="' . $row->id . '" data-lock="1"><i class="fa fa-lock" style="color:orange" ></i></button>':$lock='<button class="btn" data-btn="lock" data-id="' . $row->id . '" data-lock="0"><i class="fa fa-unlock " style="color:green" ></i></button>';
            }else{
                $row->lock == '1'? $lock ='<i class="fa fa-lock" style="color:orange" title="หากต้องการปลดล๊อคเพื่อแก้ไขกรุณาติดต่อ Admin" ></i>':$lock='<i class="fa fa-unlock " style="color:green" id="lock" data-lock="0" title="That&apos;s what this widget is"></i>';
            }

            $disable_delete = "";
            if($row->permit_start_date < date('Y-m-d')||$row->permit_user!=$this->user_id){
                $disable_delete = "disabled";
            }

            $row->permit_user==$this->user_id?$txt_edit='Edit .':$txt_edit='View';
            $row->permit_user==$this->user_id?$txt_color='btn-warning':$txt_color='btn-success';
            $sub_array = array();
            $sub_array[] = $lock." ".to_thai_date_short($row->permit_start_date) . " - " . to_thai_date_short($row->permit_end_date);
            $sub_array[] = $row->invit_subject;
            $sub_array[] = $row->invit_place;
            $sub_array[] = $this->basic->get_user_name($row->permit_user);
            $sub_array[] = '<div class="btn-group" role="group">'.
                            '<a href="'.site_url('outsite/add_outsite_permit/').$row->id.'" class="btn '.$txt_color.' btn-sm" data-id="' . $row->id . '" class="btn btn-warning btn-xs">'.$txt_edit.'</a>'.
                            '<button data-btn="btn_del" '.$disable_delete.' class="btn btn-danger btn-sm" data-id="' . $row->id . '" >Delete</button>'.
                            '<a href="'.site_url('#').$row->id.'" class="btn btn-info btn-sm" data-id="' . $row->id . '" class="btn btn-info btn-xs">เบิกเงิน</a>';
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

    public function set_lock(){
        $id = $this->input->post('id');
        $val = $this->input->post('val');
        if(check_role(4,$this->user_id)){
            $rs=$this->outsite->set_lock($id,$val);
            if($rs){
                $json = '{"success": true}';
            }else{
                $json = '{"success": false}';
            }
        }else{
            $json = '{"success": false}';
        }

        render_json($json);
    }
    public function  claim($id = 0){
        if ($id != 0) {
            $data['action'] = 'update';
        } else {
            $data['action'] = 'insert';
        }
        $data['outsite_member'] = $this->outsite->get_outsite_member($id);
        $data['cars'] =$this->outsite->get_outsite_cars($id);
        $data['outsite'] = $this->outsite->get_outsite_user($id);
        $data['outsite_type'] = $this->outsite->get_outsite_type();
        $data['invit_type'] = $this->outsite->getAll_invit_type();
        $data['claim_type'] = $this->outsite->get_claim_type();
        $data['travel_type'] = $this->outsite->getAll_travel_type();
        $data['user'] = $this->outsite->get_user_id($this->user_id);
        $this->layout->view('claim/claimform_view',$data);
    }
}