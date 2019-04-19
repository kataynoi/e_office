<?php

defined('BASEPATH') OR exit('No direct script access allowed');


/**
 *

 */
class Sign_model extends CI_Model
{

    public function get_sign($data){
        $month = $data['year'].'-'.$data['month'];
        $workgroup = $data['workgroup'];
        $sql = "SELECT
                        a.user_id,CONCAT(b.prename,b.`name`) as `name`
                        ,GROUP_CONCAT(date_work) as date_work
                        ,GROUP_CONCAT(sign_in) as sign_in
                        ,GROUP_CONCAT(sign_out) as sign_out
                        ,GROUP_CONCAT(c.s_type) as sign_type
                        FROM (SELECT * FROM sign_work WHERE DATE_FORMAT(date_work,'%Y-%m') = '".$month."' ORDER BY date_work) a
                        LEFT JOIN mas_users b ON a.user_id = b.id
                        LEFT JOIN sign_type c ON a.sign_type = c.id
                        WHERE b.`group`='".$workgroup."'
                        GROUP BY a.user_id";
        $rs=$this->db->query($sql)->result();
        return $rs;

    }
}