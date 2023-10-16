<?php

class Calendar_Model extends CI_Model
{

public  function  get_ousite_calendar (){
    $rs = $this->db
    ->order_by('id')
    ->get('outsite_permit')
    ->result_array();
    return $rs;
    }
}


?>