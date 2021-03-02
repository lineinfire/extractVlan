<?php
	$db_handle = pg_connect("host=192.168.7.1 port=5432 dbname=corporate user=nobody");
	if (!$db_handle)
	{
		die("Could not connect!");
	}
	 // $query = "SELECT table_name FROM information_schema.tables WHERE table_schema = 'public';"; // where usedtime > 0";   
	$query = "select crypt('password', 'f36564ae2bcdfcca9a60432e952de1aa') from tbldgdconf";
	 $result = pg_exec($db_handle, $query);
	 while ($row = pg_fetch_array($result))
	 {

	 	echo $row["table_name"];
	 	echo "<br>";
	 } 
?>