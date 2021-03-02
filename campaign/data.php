<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "campaign";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT distinct(ip), count(*) as click FROM tbl_click group by ip order by ip";
$result = $conn->query($sql);

$id = 1;
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	$nsql = "select name from tbl_name where ip='$row[ip]'";
    	$nresult = $conn->query($nsql);
    	$nrow = $nresult->fetch_assoc();
        echo "id: " . $id. " - IP: " . $row["ip"]." - Name: " . $nrow["name"]." - Clicked: " . $row["click"]."<br>";
        $id++;
    }
} else {
    echo "0 results";
}
$conn->close();
?>