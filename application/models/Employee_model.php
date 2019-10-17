<?php

defined('BASEPATH') OR exit('No direct script access allowed');


/**
 *

 */
class Employee_model extends CI_Model
{
    var $table = "mas_users as a";
    var $order_column = Array('prename', 'name', 'position', 'group', 'user_mobile');

    function make_query()
    {
        $this->db
            ->select('a.prename, a.name, a.position, b.name as group, a.user_mobile')
            ->where('a.active','1')
            ->join('co_workgroup as b','a.group = b.id')
            ->order_by('a.order')
            ->from($this->table);
        if (isset($_POST["search"]["value"])) {
            $this->db->group_start();
            $this->db->like("a.name", $_POST["search"]["value"]);
            $this->db->or_like("position", $_POST["search"]["value"]);
            $this->db->or_like("b.name", $_POST["search"]["value"]);
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




}