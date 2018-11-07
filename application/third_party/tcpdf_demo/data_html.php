<?php
session_start();
header("Content-type:text/html; charset=UTF-8");                
header("Cache-Control: no-store, no-cache, must-revalidate");               
header("Cache-Control: post-check=0, pre-check=0", false);    
include("dbconnect.php");
?>
<style>
td{
        border:1px dashed #CCC;  
}
</style>

    <table cellspacing="0" cellpadding="1" border="0" style="width:1100px;">  
    	<tr>
        <td width="50" align="center" bgcolor="#F2F2F2">#</td>
        <td bgcolor="#F2F2F2">&nbsp;Topic</td>
        </tr>
<?php
        $i=1;
        $sql="SELECT * FROM  province_th WHERE 1 LIMIT 50 ";
		$result = $mysqli->query($sql);
    	if($result && $result->num_rows>0){ 
			while($row = $result->fetch_assoc()){
?>  
  <tr>
    <td align="center"><?=$i?></td>
    <td >&nbsp;<?=$row['province_name']?></td>
  </tr>
<?php $i++; }} ?>     
    </table>