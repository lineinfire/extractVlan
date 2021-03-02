<?php
$dbhost = 'localhost';
$dbusername = 'root';
$dbpassword = '';
$db = 'module';

$link = mysql_connect($dbhost,$dbusername,$dbpassword);
mysql_select_db($db, $link) or die (mysql_error());



?>