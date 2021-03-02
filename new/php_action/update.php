<?php 

require_once 'db_connect.php';

//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());

	$id = $_POST['member_id'];
	$name = $_POST['editName'];
	$address = $_POST['editAddress'];
	$email = $_POST['editEmail'];
	$contact = $_POST['editContact'];
	$username = $_POST['editUsername'];
	$password = $_POST['editPassword'];
	$rolecode = $_POST['editrolecode'];
	$active = $_POST['editActive'];

	$sql = "UPDATE system_users SET name = '$name', address = '$address', email = '$email', contact = '$contact', u_username = '$username', u_password = '$password', u_rolecode = '$rolecode', active = '$active' WHERE id = $id";
	$query = $connect->query($sql);

	if($query === TRUE) {			
		$validator['success'] = true;
		$validator['messages'] = "Successfully Added";		
	} else {		
		$validator['success'] = false;
		$validator['messages'] = "Error while adding the member information";
	}

	// close the database connection
	$connect->close();

	echo json_encode($validator);

}