<?php

defined('BASEPATH') OR exit('No direct script access allowed');



/**

 *

 */

class User_model extends CI_Model

{

    public function get_search_user($txt_search){
        $rs = $this->db
            ->like('name',$txt_search)
            ->get('employee')
            ->result();
        return $rs ;

    }
    public function do_auth($username, $password)
    {
        $rs = $this->db
            ->select('a.id,c.prename,c.name,c.position,c.hospcode,b.hosname,a.user_type')
            ->where('a.username', $username)
            ->where('a.password', "PASSWORD('$password')", false)
            ->join('employee c','a.id = c.id')
            ->join('chospital b','c.hospcode = b.hoscode')
            ->get('users a')
            ->row_array();
        //echo $this->db->last_query();
        return $rs;
    }
    public function get_userprofile($id){
        $rs = $this->db
            ->where('id',$id)
            ->get('employee')
            ->row_array();
        return $rs;
    }
    public function save_user($data)
    {
        $rs = $this->db
            ->set('prename',$data['prename'])
            ->set('name',$data['name'])
            ->set('cid',$data['cid'])
            ->set('username', $data['username'])
            ->set('hospcode', $data['hospcode'])
            ->set('group', $data['group'])
            ->set('employee_type', $data['employee_type'])
            ->set('email', $data['email'])
            ->set('position', $data['position'])
            ->set('user_mobile', $data['user_mobile'])
            ->insert('employee');
        return $rs;
    }
    public function update_user($data)
    {
        $rs = $this->db
            ->where('id',$data['id'])
            ->set('prename',$data['prename'])
            ->set('name',$data['name'])
            ->set('cid',$data['cid'])
            ->set('hospcode', $data['hospcode'])
            ->set('group', $data['group'])
            ->set('employee_type', $data['employee_type'])
            ->set('email', $data['email'])
            ->set('position', $data['position'])
            ->set('user_mobile', $data['user_mobile'])
            ->update('employee');
        return $rs;
    }
    public function update_password($data)
    {
        $rs = $this->db
            ->where('id',$data['id'])
            ->set('password', "PASSWORD('".$data['password']."')", false)
          //  ->set('username', $data['username'])
            ->update('employee');
        return $rs;
    }
    public function get_member_name($id){
        $rs = $this->db
            ->where('id',$id)
            ->get('employee')
            ->result();
        return $rs? $rs->prename.$rs->name:'-';
    }

}