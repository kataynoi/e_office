<?php

defined('BASEPATH') OR exit('No direct script access allowed');


/**
 *

 */
class Admin_employee_model extends CI_Model
{
    var $table = "employee";
    var $order_column = Array('id','name','cid','sex','position','hospcode','employee_type','group','email','user_mobile','date_in','date_out','address','active','driver','order',);

    function make_query()
    {
        $this->db->from($this->table);
        if (isset($_POST["search"]["value"])) {
            $this->db->group_start();
            $this->db->like("name", $_POST["search"]["value"]);$this->db->or_like("position", $_POST["search"]["value"]);
            $this->db->group_end();

        }

        if (isset($_POST["order"])) {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('', '');
        }
    }

    function make_datatables()
    {
        $this->make_query();
        if ($_POST["length"] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    function get_filtered_data()
    {
        $this->make_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    function get_all_data()
    {
        $this->db->select("*");
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }


    /* End Datatable*/
    public function del_admin_employee($id)
        {
        $rs = $this->db
            ->where('id', $id)
            ->delete('employee');
        return $rs;
        }

        public function get_employee_type(){
                        $rs = $this->db
                        ->get("employee_type")
                        ->result();
                        return $rs;}    public function get_employee_type_name($id)
                {
                    $rs = $this->db
                        ->where("id",$id)
                        ->get("employee_type")
                        ->row();
                    return $rs?$rs->name:"";
                }public function get_co_workgroup(){
                        $rs = $this->db
                        ->get("co_workgroup")
                        ->result();
                        return $rs;}    public function get_group_name($id)
                {
                    $rs = $this->db
                        ->where("id",$id)
                        ->get("co_workgroup")
                        ->row();
                    return $rs?$rs->name:"";
                }

    public function save_admin_employee($data)
            {

                $rs = $this->db
                    ->set("id", $data["id"])
                    ->set("prename", $data["prename"])
                    ->set("name", $data["name"])
                    ->set("cid", $data["cid"])
                    ->set("sex", $data["sex"])
                    ->set("position", $data["position"])
                    ->set("hospcode", $data["hospcode"])
                    ->set("employee_type", $data["employee_type"])
                    ->set("group", $data["group"])
                    ->set("email", $data["email"])
                    ->set("user_mobile", $data["user_mobile"])
                    ->set("date_in", $data["date_in"])
                    ->set("date_out", $data["date_out"])
                    ->set("address", $data["address"])
                    ->set("active", $data["active"])
                    ->set("driver", $data["driver"])
                    ->set("order", $data["order"])
                    ->insert('employeex');

                return $this->db->insert_id();

            }
    public function update_admin_employee($data)
            {
                $rs = $this->db
                    ->set("id", $data["id"])->set("prename", $data["prename"])->set("name", $data["name"])->set("cid", $data["cid"])->set("sex", $data["sex"])->set("position", $data["position"])->set("hospcode", $data["hospcode"])->set("employee_type", $data["employee_type"])->set("group", $data["group"])->set("email", $data["email"])->set("user_mobile", $data["user_mobile"])->set("date_in", $data["date_in"])->set("date_out", $data["date_out"])->set("address", $data["address"])->set("active", $data["active"])->set("driver", $data["driver"])->set("order", $data["order"])->where("id",$data["id"])
                    ->update('employee');

                return $rs;

            }
    public function get_admin_employee($id)
                {
                    $rs = $this->db
                        ->where('id',$id)
                        ->get("employee")
                        ->row();
                    return $rs;
                }
}