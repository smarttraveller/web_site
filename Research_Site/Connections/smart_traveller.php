<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_smart_traveller = "localhost";
$database_smart_traveller = "smarttra_tables";
$username_smart_traveller = "root";
$password_smart_traveller = "";
$smart_traveller = mysql_pconnect($hostname_smart_traveller, $username_smart_traveller, $password_smart_traveller) or trigger_error(mysql_error(),E_USER_ERROR); 
?>