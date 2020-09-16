<?php
define('LINE_API',"https://notify-api.line.me/api/notify");
$my_url = urlencode(LINE_API);
$result = file_get_contents($my_url);
$res = json_decode($result);
echo 'Teat Result : '.$res;
console_log($res);

?>