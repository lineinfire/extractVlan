<?php
	$userName = $_POST['userName'];
	$_xsrf = $_GET['_xsrf'];

	if ($_xsrf == $userName)
		echo json_encode(200);
	else
		echo json_encode(404);
?>