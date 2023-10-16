
<p>
<?php
$no=1;
foreach ($users as $r){
 echo "INSERT IGNORE INTO `outsite_member` VALUES (NULL, 7941 , $r->id , $no, NULL);<br>";
 $no++;
}
?>
