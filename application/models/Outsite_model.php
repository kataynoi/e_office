<?php

defined('BASEPATH') OR exit('No direct script access allowed');


/**
 *

 */
class Outsite_model extends CI_Model
{
    var $table = "outsite_permit";
    var $select_column = array("id", "permit_start_date", "permit_end_date", "invit_subject", "invit_place", "permit_user","lock");
    var $order_column = array("invit_start_date");


    public function read($id)
    {
        $rs = $this->db
            ->where('a.id', $id)
            ->get('outsite_permit a')
            ->row();
        return $rs;
    }

    public function get_outsite_user($id)
    {
        $rs = $this->db
            ->where('a.id', $id)
            //->where('a.permit_user', $user_id)
            ->get('outsite_permit a')
            ->row_array();
        return $rs;
    }

    public function get_outsite_member($id)
    {
        $rs = $this->db
            ->select('a.user_id,b.name,b.position,b.driver')
            ->where('a.outsite_id', $id)
            ->join('employee b', 'a.user_id = b.id')
            ->order_by('a.order')
            ->get('outsite_member a')
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
            ->get('employee')
            ->row();
        //echo $this->db->last_query();
        return $rs ? $rs->prename . $rs->name : NULL;
    }

    public function get_position($id)
    {
        $rs = $this->db
            ->where('id', $id)
            ->limit(1)
            ->get('employee')
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
            ->get('employee')
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
        $sql="SELECT id from outsite_permit a WHERE permit_user ='$user_id' UNION SELECT outsite_id as id FROM outsite_member WHERE user_id ='$user_id'";
       // $outsite_id = $this->db->query($sql)->result();
        $this->db->select($this->select_column);
        //$this->db->where('permit_user', $user_id);
        $this->db->where_in('id',$sql,false);
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
            $this->db->order_by('permit_start_date', 'DESC');
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


    /*getAll Outsite*/

    function make_query_all()
    {

        $this->db->select($this->select_column);
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
            $this->db->order_by('permit_start_date', 'DESC');
        }
    }

    function make_datatables_all()
    {
        $this->make_query_all();
        if ($_POST["length"] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    function get_filtered_data_all()
    {
        $this->make_query_all();
        $query = $this->db->get();
        return $query->num_rows();
    }

    function get_all_data_all()
    {
        $this->db->select("*");
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    /*End getAll Outsite*/

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
            $sql = "INSERT IGNORE INTO outsite_member(`user_id`,`outsite_id`,`order`) VALUES($u,$lastid,$i)";
            $this->db->query($sql);
            $i++;
        }
        if (isset($data['used_car'])) {
            foreach ($data['used_car'] as $u) {
                $this->db
                    ->set('outsite_id', $lastid)
                    ->set('car_id', $u['car_id'])
                    ->set('driver', $u['driver'])
                    ->set('control_car', $u['control_car'])
                    ->set('approve', $u['approve'])
                    ->set('cause', $u['cause'])
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
            ->set('expand','NULL',false)
            //->set('driver',$data['driver'])
            ->update('outsite_permit');
        $i = 1;

        // Delete Member
        $this->db->where('outsite_id', $data['id'])->delete('outsite_member');
        $this->db
            ->set('sign_type','NULL',false)
            ->set('permit_id','NULL',false)
            ->set('note','NULL',false)
            ->where('permit_id', $data['id'])
            ->update('sign_work');
        $lastid = $data['id'];
        foreach ($data['users'] as $u) {
            $sql = "INSERT IGNORE INTO outsite_member(`user_id`,`outsite_id`,`order`) VALUES($u,$lastid,$i)";
            $this->db->query($sql);
            $i++;
        }
        $this->db
            ->where('outsite_id', $data['id'])
            ->delete('used_car');
        if (isset($data['used_car'])) {
            foreach ($data['used_car'] as $u) {
                $this->db
                    ->set('outsite_id', $data['id'])
                    ->set('car_id', $u['car_id'])
                    ->set('driver', $u['driver'])
                    ->set('control_car', $u['control_car'])
                    ->set('approve', $u['approve'])
                    ->set('cause', $u['cause'])
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
        $this->db->trans_start();
        $rs = $this->db
            ->where('id', $id)
            ->where('permit_user', $user_id)
            ->delete('outsite_permit');
        $this->db
            ->where('outsite_id', $id)
            ->delete('used_car');
        $this->db->where('outsite_id', $id)->delete('outsite_member');
        $this->db->trans_complete();
        return $rs;
    }

    public function set_lock($id, $val)
    {
        $rs = $this->db
            ->set('lock',$val)
            ->where('id', $id)
            ->update('outsite_permit');
        return $rs;
    }

    public function get_permit_member($id)
    {
        $rs = $this->db
            ->select('a.user_id,b.prename, b.name,b.position')
            ->where('a.outsite_id', $id)
            ->join('employee b', 'a.user_id=b.id')
            ->order_by('a.order')
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
            ->get('employee a')
            ->row();
        return $rs ? $rs->book_number : '-';

    }
    public function get_group_name_user($user_id)
    {
        $rs = $this->db
            ->select('b.name')
            ->where('a.id', $user_id)
            ->join('co_workgroup b ', 'a.group = b.id')
            ->get('employee a')
            ->row();
        return $rs ? $rs->name : '-';

    }
    public function get_used_car($id)
    {
        $rs = $this->db
            ->select('b.licente_plate,concat(c.prename,c.name) as driver,concat(d.prename,d.name) as control_car',false)
            ->where('a.outsite_id', $id)
            ->join('car b ', 'a.car_id = b.id','left')
            ->join('employee c ', 'a.driver = c.id','left')
            ->join('employee d ', 'a.control_car = d.id','left')
            ->get('used_car a')
            ->result();
        return $rs ;

    }
    public function get_outsite_cars($id)
    {
        $rs = $this->db
            ->select('a.driver, a.outsite_id, a.control_car,Concat(b.licente_plate,"(",b.name,")") as car_name,a.car_id,CONCAT(c.prename,c.name) as driver_name,c.user_mobile,a.approve, a.cause', false)
            ->where('outsite_id', $id)
            ->join('car b ', 'a.car_id=b.id', 'left')
            ->join('employee c ', 'a.driver = c.id', 'left')
            ->get('used_car a')
            ->result_array();
        return $rs;
    }

}