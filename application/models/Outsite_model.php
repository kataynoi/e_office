<?php

defined('BASEPATH') OR exit('No direct script access allowed');


/**
 *

 */
class Outsite_model extends CI_Model
{
    var $table = "outsite_permit";
    var $select_column = array("id", "permit_start_date", "permit_end_date", "invit_subject", "invit_place", "invit_name");
    var $order_column = array("invit_start_date");


    public function read($id)
    {
        $rs = $this->db
            ->where('a.id', $id)
            ->get('outsite_permit a')
            ->row();
        return $rs;
    }

    public function get_outsite_user($id, $user_id)
    {
        $rs = $this->db
            ->where('a.id', $id)
            ->where('a.permit_user', $user_id)
            ->get('outsite_permit a')
            ->row_array();
        return $rs;
    }

    public function get_outsite_member($id)
    {
        $rs = $this->db
            ->select('a.user_id,b.name,b.position,b.driver')
            ->where('a.outsite_id', $id)
            ->join('mas_users b', 'a.user_id = b.id')
            ->order_by('order')
            ->get('outsite_member a')
            ->result_array();
        return $rs;
    }

    public function get_outsite_cars($id)
    {
        $rs = $this->db
            ->select('a.control_car,Concat(b.licente_plate,"(",b.name,")") as car_id,CONCAT(c.prename,c.name) as driver,c.user_mobile,a.control_car', false)
            ->where('outsite_id', $id)
            ->join('car b ', 'a.car_id=b.id', 'left')
            ->join('mas_users c ', 'a.driver = c.id', 'left')
            ->get('used_car a')
            ->result_array();
        return $rs;
    }

    public function get_invit_type($id)
    {
        $rs = $this->db
            ->where('id', $id)
            ->limit(1)
            ->get('invit_type')
            ->row();
        //echo $this->db->last_query();
        return $rs ? $rs->invit_type : NULL;
    }

    public function get_user($id)
    {
        $rs = $this->db
            ->where('id', $id)
            ->limit(1)
            ->get('mas_users')
            ->row();
        //echo $this->db->last_query();
        return $rs ? $rs->prename . $rs->name : NULL;
    }

    public function get_position($id)
    {
        $rs = $this->db
            ->where('id', $id)
            ->limit(1)
            ->get('mas_users')
            ->row();
        //echo $this->db->last_query();
        return $rs ? $rs->position : 'xxxx';
    }

    public function  get_outsite_type()
    {
        $rs = $this->db
            ->get('outsite_type')
            ->result();
        //echo $this->db->last_query();
        return $rs;
    }

    public function  getAll_invit_type()
    {
        $rs = $this->db
            ->get('invit_type')
            ->result();
        //echo $this->db->last_query();
        return $rs;
    }
    public function  get_claim_type()
    {
        $rs = $this->db
            ->get('claim_type')
            ->result();
        //echo $this->db->last_query();
        return $rs;
    }

    public function  getAll_travel_type()
    {
        $rs = $this->db
            ->get('travel_type')
            ->result();
        //echo $this->db->last_query();
        return $rs;
    }

    public function get_user_id($id)
    {
        $rs = $this->db
            ->where('id', $id)
            ->limit(1)
            ->get('mas_users')
            ->row();
        //echo $this->db->last_query();
        return $rs;
    }

    public function get_outsite_by_user($id)
    {
        $rs = $this->db
            ->where('permit_user', $id)
            ->get('outsite_permit')
            ->result();
        //echo $this->db->last_query();
        return $rs;
    }

    function make_query()
    {
        $user_id = $this->session->userdata('id');
        $this->db->select($this->select_column);
        $this->db->where('permit_user', $user_id);
        $this->db->from($this->table);
        if (isset($_POST["search"]["value"])) {
            $this->db->group_start();
            $this->db->like("invit_subject", $_POST["search"]["value"]);
            $this->db->or_like("invit_name", $_POST["search"]["value"]);
            $this->db->or_like("invit_place", $_POST["search"]["value"]);
            $this->db->group_end();
        }
        if (isset($_POST["order"])) {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('invit_start_date', 'DESC');
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

    public function save_outsite($data)
    {
        $this->db->trans_start();
        $rs = $this->db
            //->set('outsite_type',$data['outsite_type'])
            //->set('permit_number',$data['permit_number'])
            ->set('date_permit', to_mysql_date($data['date_permit']))
            ->set('invit_name', $data['invit_name'])
            ->set('invit_number', $data['invit_number'])
            ->set('invite', $data['invite'])
            ->set('detail_no_invit', $data['detail_no_invit'])
            ->set('invit_date', to_mysql_date($data['invit_date']))
            ->set('invit_subject', $data['invit_subject'])
            ->set('invit_type', $data['invit_type'])
            ->set('invit_start_date', to_mysql_date($data['invit_start_date']))
            ->set('invit_end_date', to_mysql_date($data['invit_end_date']))
            ->set('permit_start_date', to_mysql_date($data['permit_start_date']))
            ->set('permit_end_date', to_mysql_date($data['permit_end_date']))
            ->set('invit_place', $data['invit_place'])
            ->set('claim_type', $data['claim_type'])
            ->set('claim_cause', $data['claim_cause'])
            ->set('permit_user', $data['permit_user'])
            ->set('objective', $data['objective'])
            ->set('permit_group', $data['permit_group'])
            ->set('travel_type', $data['travel_type'])
            ->set('travel_cause', $data['travel_cause'])
            ->set('license_plate', $data['license_plate'])
            //->set('driver',$data['driver'])
            ->insert('outsite_permit');
        $lastid = $this->db->insert_id();
        $i = 1;
        foreach ($data['users'] as $u) {
            $this->db
                ->set('user_id', $u)
                ->set('outsite_id', $lastid)
                ->set('order', $i)
                ->insert('outsite_member');
            //echo $u;
            $i++;
        }
        if (isset($data['used_car'])) {
            foreach ($data['used_car'] as $u) {
                $this->db
                    ->set('outsite_id', $lastid)
                    ->set('control_car', $u)
                    ->insert('used_car');
            }
        }
        $this->db->trans_complete();
        return $rs;

    }

    public function update_outsite($data)
    {
        $this->db->trans_start();
        $rs = $this->db
            ->where('id', $data['id'])
            //->set('outsite_type',$data['outsite_type'])
            //->set('permit_number',$data['permit_number'])
            ->set('date_permit', to_mysql_date($data['date_permit']))
            ->set('invit_name', $data['invit_name'])
            ->set('invit_number', $data['invit_number'])
            ->set('invite', $data['invite'])
            ->set('detail_no_invit', $data['detail_no_invit'])
            ->set('invit_date', to_mysql_date($data['invit_date']))
            ->set('invit_subject', $data['invit_subject'])
            ->set('invit_type', $data['invit_type'])
            ->set('invit_start_date', to_mysql_date($data['invit_start_date']))
            ->set('invit_end_date', to_mysql_date($data['invit_end_date']))
            ->set('permit_start_date', to_mysql_date($data['permit_start_date']))
            ->set('permit_end_date', to_mysql_date($data['permit_end_date']))
            ->set('invit_place', $data['invit_place'])
            ->set('claim_type', $data['claim_type'])
            ->set('claim_cause', $data['claim_cause'])
            ->set('permit_user', $data['permit_user'])
            ->set('objective', $data['objective'])
            ->set('permit_group', $data['permit_group'])
            ->set('travel_type', $data['travel_type'])
            ->set('travel_cause', $data['travel_cause'])
            ->set('license_plate', $data['license_plate'])
            //->set('driver',$data['driver'])
            ->update('outsite_permit');
        $i = 1;
        $this->db
            ->where('outsite_id', $data['id'])
            ->delete('outsite_member');
        foreach ($data['users'] as $u) {
            $this->db
                ->set('user_id', $u)
                ->set('outsite_id', $data['id'])
                ->set('order', $i)
                ->insert('outsite_member');
            //echo $u;
            $i++;
        }

        $this->db
            ->where('outsite_id', $data['id'])
            ->delete('used_car');
        if (isset($data['used_car'])) {
            foreach ($data['used_car'] as $u) {
                $this->db
                    ->set('car_id', $u['car_id'])
                    ->set('outsite_id', $data['id'])
                    ->set('control_car', $u['control_car'])
                    ->set('driver', $u['driver'])
                    ->insert('used_car');
                //echo $u;
                $i++;
            }
        }

        $this->db->trans_complete();
        return $rs;
    }

    public function del_outsite($id, $user_id)
    {
        $rs = $this->db
            ->where('id', $id)
            ->where('permit_user', $user_id)
            ->delete('outsite_permit');
        return $rs;
    }

    public function get_permit_member($id)
    {
        $rs = $this->db
            ->select('a.user_id,b.prename, b.name,b.position')
            ->where('a.outsite_id', $id)
            ->join('mas_users b', 'a.user_id=b.id')
            ->order_by('order')
            ->get('outsite_member a')
            ->result();
        return $rs;
    }
    public function  get_claim_type_id($id)
    {
        $rs = $this->db
            ->where('id',$id)
            ->get('claim_type')
            ->row();
        return $rs?$rs->claim_type:'-';
    }
    public function  get_travel_name($id)
    {
        $rs = $this->db
            ->where('id',$id)
            ->get('travel_type')
            ->row();
        return $rs?(string)$rs->travel_type:'-';
    }

    public function get_book_number($user_id)
    {
        $rs = $this->db
            ->select('b.book_number')
            ->where('a.id', $user_id)
            ->join('co_workgroup b ', 'a.group = b.id')
            ->get('mas_users a')
            ->row();
        return $rs ? $rs->book_number : '-';

    }
}