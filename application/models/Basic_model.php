<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Basic_model extends CI_Model
{

    public function sl_hospcode($id='44'){

        $rs = $this->db
            ->where('provcode',$id)
            ->get('chospital')
            ->result();
        return $rs;
    }

    public function sl_group(){

        $rs = $this->db
            //->where('provcode',$id)
            ->get('co_workgroup')
            ->result();
        return $rs;
    }
    public function sl_employee_type(){

        $rs = $this->db
            //->where('provcode',$id)
            ->get('employee_type')
            ->result();
        return $rs;
    }

}