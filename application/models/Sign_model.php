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
         $sql = "SELECT * FROM (SELECT
                        a.user_id,CONCAT(b.prename,b.`name`) as `name`

                        ,GROUP_CONCAT(CONCAT(DATE_FORMAT(date_work,'%d'),'|',sign_in,'|',sign_out,'|',c.s_type)) as date_work1
                        ,b.order as member_order
                        FROM (SELECT * FROM sign_work WHERE DATE_FORMAT(date_work,'%Y-%m') = '".$month."' ORDER BY date_work ASC) a
                        LEFT JOIN employee b ON a.user_id = b.id
                        LEFT JOIN sign_type c ON a.sign_type = c.id
                        WHERE b.`group`='".$workgroup."'
                        GROUP BY a.user_id) a ORDER BY a.member_order";
        $rs=$this->db->query($sql)->result();

        /*$rs= $this->db
            ->select('a.id, a.prename, a.name, a.position')
            ->where('a.group',$workgroup)
            ->where('a.movedate','0000-00-00 00:00:00')
            ->get('mas_users a')
            ->result();*/
        return $rs;

    }
}