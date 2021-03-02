<?php

$con = mysqli_connect("localhost","root","","module");
$query = "SELECT * FROM `emp_info`";
$result = mysqli_query($con,$query);

$rows = array();
while($row=mysqli_fetch_array($result))
{
	$rows[] = $row;
}	

echo  json_encode($rows);
?>