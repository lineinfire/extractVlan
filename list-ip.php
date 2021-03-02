<?php
	$ip_to_exclude = "192.168.7.11";

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

	$sql = "SELECT * FROM arp_table WHERE NOT IP IN ('".$ip_to_exclude."')";
	// echo $sql;
	$result = $conn->query($sql);
	echo "<table width=100% cellpadding=5><tr>";
	if ($result->num_rows > 0) {
		$count = 1;
	    while($row = $result->fetch_assoc()) {
        	echo "<td>";
        	echo $row["ip"];
        	echo "</td>";
        	if ($count %12 == 0)
        		echo "</tr><tr>";
        	$count++;
    	}
	}
	// echo "</tr>";
	echo "</tr></table>";

	$conn->close();
?>