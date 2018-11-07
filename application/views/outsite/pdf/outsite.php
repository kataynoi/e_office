<?php
/**
 * Created by PhpStorm.
 * User: Spider
 * Date: 7/19/2018
 * Time: 11:47 AM

echo to_thai_date_full($out_site->date_permit);
$txt='7890';
echo to_thai_number($txt);
echo "<br>".to_thai_number_with_comma($txt);
*/
$perline=6.2;
$startline=54.3;
$line[]= array();

for($i=0; $i<=50; $i++){
    $line[$i]=$startline+($perline*$i);
    echo $line[$i]."<br>";
}