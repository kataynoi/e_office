<?php

defined('BASEPATH') OR exit('No direct script access allowed');


/**
 *

 */
class Car_model extends CI_Model
{

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
           ->select('b.id,CONCAT(b.prename,b.name) as driver_name,b.user_mobile,b.position')
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
}