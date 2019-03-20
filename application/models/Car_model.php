<?php

defined('BASEPATH') OR exit('No direct script access allowed');


/**
 *

 */
class Car_model extends CI_Model
{
    var $table = "used_car a";
    var $select_column = array("e.id as outsite_id","e.permit_user","e.objective","e.invit_place","e.permit_start_date","e.permit_end_date","a.id", "a.outsite_id", "a.car_id", "a.driver", "a.control_car", "a.approve", "a.cause",'b.licente_plate,concat(c.prename,c.name) as driver_name,concat(d.prename,d.name) as control_car_name','b.licente_plate as car_name');
    var $order_column = array("invit_start_date");



    function make_query()
    {
        $user_id = $this->session->userdata('id');
        $this->db->select($this->select_column);
        //$this->db->where('permit_user', $user_id);
        $this->db->join('car b ', 'a.car_id = b.id','left');
        $this->db->join('mas_users c ', 'a.driver = c.id','left');
        $this->db->join('mas_users d ', 'a.control_car = d.id','left');
        $this->db->join('outsite_permit e ', 'a.outsite_id = e.id');
        $this->db->from($this->table);
        if (isset($_POST["search"]["value"])) {
            $this->db->group_start();
            $this->db->like("b.licente_plate", $_POST["search"]["value"]);
            $this->db->like("c.name", $_POST["search"]["value"]);
            $this->db->or_like("objective", $_POST["search"]["value"]);
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

    /* End Datatable*/

   public function get_car_list(){
       $rs = $this->db
           ->select('a.*,CONCAT(b.prename,b.name) as driver_name')
           ->join('mas_users b' , 'a.default_driver=b.id','left')
           ->get('car a')
           ->result();
       return $rs;
   }
    public function get_driver_list(){
       $rs = $this->db
           ->select('a.user_id,b.id,CONCAT(b.prename,b.name) as driver_name,b.user_mobile,b.position')
           ->join('mas_users b' , 'a.user_id=b.id','left')
           ->get('driver a')
           ->result();
       return $rs;
   }

    public function get_used_car()
    {
        $rs = $this->db
            ->select('b.licente_plate,concat(c.prename,c.name) as driver,concat(d.prename,d.name) as control_car',false)
            ->join('car b ', 'a.car_id = b.id','left')
            ->join('mas_users c ', 'a.driver = c.id','left')
            ->join('mas_users d ', 'a.control_car = d.id','left')
            ->get('used_car a')
            ->result();
        return $rs ;

    }
    public function get_used_car_id($id){
        $rs = $this->db
            ->where('id',$id)
            ->get('used_car')
            ->result();
        return $rs;
    }

    public function update_used_car($data)
    {
        $this->db->trans_start();
        $rs = $this->db
            ->where('id',$data['id'])
            ->set('car_id',$data['car_id'])
            ->set('driver',$data['driver'])
            ->set('approve',$data['approve'])
            ->set('cause', $data['cause'])
            ->update('used_car');

        if($data['approve']=='1' && $data['driver'] !='' ) {
            $this->db
                ->where('outsite_id',$data['outsite_id'])
                ->where('note','driver')
                ->delete('outsite_member');
            $sql = "INSERT IGNORE INTO `outsite_member` (`user_id`, `outsite_id`, `order`,`note`) VALUES (".$data['driver'].", ".$data['outsite_id'].", 99,'driver')";
            $this->db->query($sql);
        }
        $this->db->trans_complete();
        return $rs;
    }
}