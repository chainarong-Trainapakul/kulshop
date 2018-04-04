<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_connection = "localhost";
$database_connection = "kaset3";
$username_connection = "kulkul";
$password_connection = "12345678";
$connection = mysql_pconnect($hostname_connection, $username_connection, $password_connection) or trigger_error(mysql_error(),E_USER_ERROR); 
?>