<?php
	function OpenCon()
	{
		$dbhost = "localhost";
	 	$dbuser = "root";
	 	$dbpass = "";
	 	$db = "prabhu_network";

	 	$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$db);

	 	if (mysqli_connect_errno())
		{
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}

		return $conn;
	 }
	 
	function CloseCon($conn)
	{
		$conn -> close();
	}	   
?>