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
}