<?php
date_default_timezone_set("Asia/Bangkok");
$datenow = time();
echo date('Y-m-d H:i:s', mktime(0,0,0, date('m'), date('d') + 3, date('Y')));
?>