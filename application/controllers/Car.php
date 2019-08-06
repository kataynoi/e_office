<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Car extends CI_Controller
{

    //public  $token = "SqTlGz2Hl6kNa45hsespDXvgw899jVnT2155p3qL7wl";
    public  $token = "11td8e4FDnxXdd6mtOru9RlCmR56r8g778duDN"; //ขอใช้รถจริง
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata("online"))
            redirect(site_url('user/login'));
        $this->load->model('Car_model', 'car');
        $this->load->model('User_model', 'user');
        $this->load->model('Basic_model', 'basic');
        $this->load->model('Outsite_model', 'outsite');
        $this->layout->setLayout('default_layout');
        $this->db = $this->load->database('default', true);
        $this->user_id = $this->session->userdata('id');
    }

    public function index()
    {
        $data['user'] = $this->db->get('mas_users')->result();

        $this->layout->view('welcome_message', $data);
    }
    public function cars()
    {
        $data['car'] = $this->car->get_car_list();
        $this->layout->view('car/cars_view', $data);

    }
    public function drivers()
    {
        $data['driver'] = $this->car->get_driver_list();
        $this->layout->view('car/drivers_view', $data);

    }
    public function calendar()
    {
        ///$data['cars'] = $this->car->sl_cars();
            $data['cars'] = $this->basic->sl_cars();
            $data['driver'] = $this->car->get_driver_list();
            $this->layout->view('car/calendar_view',$data);
    }
    public function used_car($id)
    {

        $rs = $this->outsite->read($id);

       // $rs->claim_type_name = $this->outsite->get_claim_type_id($rs->claim_type);
        //$rs->travel_type_name = $this->outsite->get_travel_name($rs->travel_type);
        //$rs->travel_cause = (string)$rs->travel_cause;
        //$rs->invit_type=$this->outsite->get_invit_type($rs->invit_type);

        $data['out_site']=$rs;
        $data['member']=$this->outsite->get_permit_member($rs->id);
        $data['book_number'] = $this->outsite->get_book_number($data['member'][0]->user_id);
        $data['group_name'] = $this->outsite->get_group_name_user($data['member'][0]->user_id);
        $data['car'] = $this->outsite->get_used_car($rs->id);
        $this->load->view('car/pdf/used_car_view',$data);
        //$this->load->view('outsite/pdf/test_view',$data);

    }
    public function approve_car(){
        ///$data['cars'] = $this->car->sl_cars();
        if(check_role('1',$this->user_id)){
            $data['cars'] = $this->basic->sl_cars();
            $data['driver'] = $this->car->get_driver_list();
            $this->layout->view('car/approve_car_view',$data);
        }else{
            $this->layout->view('errors/index.html');
        }

    }

    function fetch_used_car()
    {
        $fetch_data = $this->car->make_datatables();
        $data = array();
        foreach ($fetch_data as $row) {
/*            $disable_delete = "";
            if($row->permit_start_date < date('Y-m-d')||$row->permit_user!=$this->user_id){
                $disable_delete = "disabled";
            }*/
            if($row->approve==0){
                $btn_type='btn-warning';
                $btn_text='รออนุมัติ';
                $car_name = "";
            }elseif($row->approve==1){
                $btn_type='btn-success';
                $btn_text=' อนุมัติ .';
                $car_name = '<button type="button" class="btn btn-success">'.$row->car_name."</button><br>".$row->driver_name;
            }else if($row->approve==2){
                $btn_type='btn-danger';
                $btn_text='ไม่อนุมัติ';
                $car_name = "<span style='color: red'>".$row->cause."</span>";
            }

            $sub_array = array();
            $sub_array[] = '<div class="btn-group" role="group">'.
                '<button data-toggle="modal" data-cause="'.$row->cause.'" data-car="'.$row->car_id.'" data-driver="'.$row->driver.'" data-approve="'.$row->approve.'" data-target="#approveCarModal" data-btn="btn_approve" data-id="' . $row->id . '" data-outsite_id="' . $row->outsite_id . '" class="btn '.$btn_type.'"><i class="far fa-edit "></i>'.$btn_text.'</a></div>';
            $sub_array[] = to_thai_date_short($row->permit_start_date) . " - " . to_thai_date_short($row->permit_end_date);
            $sub_array[] = $row->objective."<br>".$row->invit_place." <span style='color:blue;'>[ผู้ควบคุมรถ:".$row->control_car_name."]</span>";
            $sub_array[] = get_user_name($row->permit_user);
            $sub_array[] = $car_name;
            $data[] = $sub_array;
        }
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $this->car->get_all_data(),
            "recordsFiltered" => $this->car->get_filtered_data(),
            "data" => $data
        );
        echo json_encode($output);
    }

    function fetch_calendar_car()
    {
        $fetch_data = $this->car->make_datatables();
        $data = array();
        foreach ($fetch_data as $row) {
            /*            $disable_delete = "";
                        if($row->permit_start_date < date('Y-m-d')||$row->permit_user!=$this->user_id){
                            $disable_delete = "disabled";
                        }*/
            if($row->approve==0){
                $btn_type='badge-warning';
                $btn_text='รออนุมัติ';
                $car_name = "";
            }elseif($row->approve==1){
                $btn_type=' badge-success';
                $btn_text=' อนุมัติ .';
                $car_name = '<button type="button" class="btn btn-success">'.$row->car_name."</button><br>".$row->driver_name;
            }else if($row->approve==2){
                $btn_type='badge-danger';
                $btn_text='ไม่อนุมัติ';
                $car_name = "<span style='color: red'>".$row->cause."</span>";
            }

            $sub_array = array();
            $sub_array[] = '<div class="" role="group">'.
                '<span  class="badge badge-big '.$btn_type.'"><i class="far fa-edit "></i>'.$btn_text.'</span></div>';
            $sub_array[] = to_thai_date_short($row->permit_start_date) . " - " . to_thai_date_short($row->permit_end_date);
            $sub_array[] = $row->objective."<br>".$row->invit_place;;
            $sub_array[] = $row->control_car_name;;
            $sub_array[] = $car_name;
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

    public  function  get_used_car(){
        $id = $this->input->post('id');
        $rs = $this->car->get_used_car_id($id);
        $rows = json_encode($rs);
        $json = '{"success": true, "rows": ' . $rows . '}';
        render_json($json);
    }

    public function  save_used_car(){
        $data = $this->input->post('items');
        $rs=$this->car->update_used_car($data);

        if($rs){
            $line_message= $this->get_line_message($data['id'],$data['approve']);
            $this->notify_message($line_message,$this->token);
            $json = '{"success": true}';
        }else{
            $json = '{"success": false}';
        }


        render_json($json);
    }
    public  function get_line_message($id,$approve){

        if($approve=='1'){
            $rs =$this->car->get_message_approve($id);
            $message = 'อนุมัติ -> รายการขอรถที่ '.$id.' ขอโดย '.$rs['control_car'].' ไปราชการที่ '.$rs['invit_place']//.' เพื่อ'.$rs['objective']
                .' ['.to_thai_date_short($rs['permit_start_date']).'-'.to_thai_date_short($rs['permit_end_date'])
                .'] ได้รับการอนุมัติ รถยนต์'.$rs['car_name'].'[ '.$rs['licente_plate'].'] พนักงานขับรถ . '.$rs['driver'].' Tel:'.$rs['user_mobile'];
        }else if($approve=='2'){
            $rs =$this->car->get_message_notapprove($id);
            $message = 'ไม่อนุมัติ->รายการขอรถที่ '.$id.' ขอโดย '.$rs['control_car'].' ไปราชการที่ '.$rs['invit_place']//.'เพื่อ '.$rs['objective']
                .'['.to_thai_date_short($rs['permit_start_date']).'-'.to_thai_date_short($rs['permit_end_date'])
                .'] ไม่ได้รับการอนุมัติ เนื่องจาก'.$rs['cause'];

        }
        return $message;
    }
    public  function notify_message($message,$token){
        $queryData = array('message' => $message);
        $queryData = http_build_query($queryData,'','&');
        $headerOptions = array(
            'http'=>array(
                'method'=>'POST',
                'header'=> "Content-Type: application/x-www-form-urlencoded\r\n"
                    ."Authorization: Bearer ".$token."\r\n"
                    ."Content-Length: ".strlen($queryData)."\r\n",
                'content' => $queryData
            ),
        );
        $context = stream_context_create($headerOptions);
        $result = file_get_contents(LINE_API,FALSE,$context);
        $res = json_decode($result);
        return $res;
    }
}
