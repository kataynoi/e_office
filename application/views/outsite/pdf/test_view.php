<?php
/**
 * Created by PhpStorm.
 * User: Spider
 * Date: 06-Nov-18
 * Time: 5:45 AM
 */

//echo $outsite_member['1']['position'];
//print_r('xxx'.$outsite_member);
echo 'xxxx';


echo " Travel ".$out_site->travel_type_name;
if(!empty($member)){
    foreach($member as $m){
        echo $m->name;
    }
}

?>