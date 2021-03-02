<?php 

require_once 'db_connect.php';

//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());

	$name = $_POST['name'];
	$address = $_POST['address'];
	$email = $_POST['email'];
	$contact = $_POST['contact'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$rolecode = $_POST['rolecode'];
	$active = $_POST['active'];
		$file = rand(1000,100000)."-".$_FILES['file']['name'];
    $file_loc = $_FILES['file']['tmp_name'];
	$file_size = $_FILES['file']['size'];
	$file_type = $_FILES['file']['type'];
	$folder="uploads/";
	
	// new file size in KB
	$new_size = $file_size/1024;  
	// new file size in KB
	
	// make file name in lower case
	$new_file_name = strtolower($file);
	// make file name in lower case
	
	$final_file=str_replace(' ','-',$new_file_name);
	
	if(move_uploaded_file($file_loc,$folder.$final_file)) {

	$password_hash = password_hash($password, PASSWORD_BCRYPT, array('cost' => 10));

	$sql = "INSERT INTO system_users (name, address, email, contact, u_username, u_password, u_rolecode, active, file, type, size) VALUES ('$name', '$address', '$email', '$contact', '$username', '$password_hash', '$rolecode', '$active', '$final_file','$file_type','$new_size')";
	$query = $connect->query($sql);


	if($query === TRUE) {			
		$validator['success'] = true;
		$validator['messages'] = "Successfully Added";		
	} else {		
		$validator['success'] = false;
		$validator['messages'] = "Error while adding the member information";
	}
}
	// close the database connection
	$connect->close();

	echo json_encode($validator);

}

?>
