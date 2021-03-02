<?php
include('../dbconnection.php');
mysql_select_db('module');
if(isset($_POST)) {
$emp_name = $_POST['emp_name'];
 $emp_address = $_POST['emp_address'];
 $email = $_POST['email'];
 $emp_mobile = $_POST['emp_mobile'];
 $emp_extension =  $_POST['emp_extension'];
 $department = $_POST['department'];
 $supervisor = $_POST['supervisor'];
 $switchcode = $_POST['switchcode'];
 $emp_port = $_POST['emp_port'];
 $emp_ip = $_POST['emp_ip'];
 $ipphone = $_POST['phoneip'];
 $emp_vlanid = $_POST['emp_vlanid'];
 $emp_mac = $_POST['emp_mac'];
 //$panelid = $_POST['panelid'];
 $query = "INSERT INTO `emp_info` (`name`, `address`, `email`, `mobile`, `extno`, `department`, `supervisor`, `switchcode`, `portid`, `ipaddress`,`phoneip`, `vlanid`, `macaddress`) VALUES ('$emp_name', '$emp_address', '$email', '$emp_mobile', '$emp_extension', '$department', ' $supervisor', '$switchcode', '$emp_port', '$emp_ip', '$ipphone', '$emp_vlanid', '$emp_mac')";

$result = mysql_query($query) or die(mysql_error());
if($result) {
	echo "Connection succes";
} else {

	echo "Insertion failed";
}

}














?>