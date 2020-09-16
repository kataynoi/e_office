<?php

defined('BASEPATH') OR exit('No direct script access allowed');


/**
 *

 */
class Admin_user_model extends CI_Model
{
    var $table = "users a";
    var $order_column = Array('id','username','user_type','active',);

    function make_query()
    {
        $this->db->select('a.id,CONCAT(b.prename,b.name) as name,a.username,c.name as user_type,a.active')
            ->join('employee as b','a.id = b.id')
            ->join('cuser_type as c','a.user_type = c.id')
            ->from($this->table);
        if (isset($_POST["search"]["value"])) {
            $this->db->group_start();
            $this->db->like("username", $_POST["search"]["value"]);
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
    public function del_admin_user($id)
        {
        $rs = $this->db
            ->where('id', $id)
            ->delete('users');
        return $rs;
        }

        public function get_cuser_type(){
                        $rs = $this->db
                        ->get("cuser_type")
                        ->result();
                        return $rs;}    public function get_user_type_name($id)
                {
                    $rs = $this->db
                        ->where("id",$id)
                        ->get("cuser_type")
                        ->row();
                    return $rs?$rs->name:"";
                }

    public function save_admin_user($data)
            {

                $rs = $this->db
                    ->set("id", $data["id"])->set("username", $data["username"])
                    ->set("password", $data["password"])
                    ->set("user_type", $data["user_type"])->set("active", $data["active"])
                    ->insert('users');

                return $this->db->insert_id();

            }
    public function update_admin_user($data)
            {
                $rs = $this->db
                    ->set("id", $data["id"])->set("username", $data["username"])->set("password", $data["password"])->set("user_type", $data["user_type"])->set("active", $data["active"])->where("id",$data["id"])
                    ->update('users');

                return $rs;

            }
    public function get_admin_user($id)
                {
                    $rs = $this->db
                        ->where('id',$id)
                        ->get("users")
                        ->row();
                    return $rs;
                }
}