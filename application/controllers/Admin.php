<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct() {
        Parent::__construct();
        $this->layout->setLayout('admin_layout');
        $this->load->model("mas_users_model",'mas_users');
    }

     public function index()
    {
        $data['title'] = 'User data';
        $this->layout->view("admin/userlist_view.php", $data);
    }
    public function users()
    {
        $data['title'] = 'User data';
        $this->layout->view("admin/userlist_view.php", $data);
    }
    function fetch_user(){
        $fetch_data = $this->mas_users->make_datatables();
        $data = array();
        foreach($fetch_data as $row)
        {
            $sub_array = array();
            $sub_array[] = $row->id;
            $sub_array[] = $row->name;
            $sub_array[] = $row->position;
            $sub_array[] = '<button type="button" name="update" id="'.$row->id.'" class="btn btn-warning btn-xs">Update</button>';
            $sub_array[] = '<button type="button" name="delete" id="'.$row->id.'" class="btn btn-danger btn-xs">Delete</button>';
            $data[] = $sub_array;
        }
        $output = array(
            "draw"                      =>     intval($_POST["draw"]),
            "recordsTotal"              =>      $this->mas_users->get_all_data(),
            "recordsFiltered"           =>     $this->mas_users->get_filtered_data(),
            "data"                      =>     $data
        );
        echo json_encode($output);
    }


}

?>