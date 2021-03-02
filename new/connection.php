<?php
$mysql_db_hostname = "localhost";
$mysql_db_user = "prashant_bishnu";
$mysql_db_password = "bghimire#123";
$mysql_db_database = "prashant_multi-admin";

$con = @mysqli_connect($mysql_db_hostname, $mysql_db_user, $mysql_db_password,
    $mysql_db_database);
if (!$con) {
    trigger_error('Could not connect to MySQL: ' . mysqli_connect_error());
}
?>