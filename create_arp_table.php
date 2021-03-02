<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "ci_test";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	$i = 1;
	do {
		$sql = "INSERT INTO arp_table (id, ip) VALUES ('".$i."', '192.168.7.".$i."')";

		if ($conn->query($sql) === TRUE) {
		    echo "New record created successfully";
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
		$i++;
	} while ($i <=255);

	$conn->close();
?>