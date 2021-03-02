<?php

	session_start();
	//require_once("config.php");
require_once("dbconnect.php");

	
		//$user_name = $_POST['user_name'];
			//$u_userid = '';
		// $name = trim($_POST['name']);
		//$address = trim($_POST['address']);
	  //  $email = trim($_POST['email']);
	//	$contact= trim($_POST['contact']);
	   //$username = trim($_POST['username']);
		//$password = trim($_POST['password']);
		//$userrole= trim($_POST['userrole']);

 
      //  $query = "INSERT INTO `user` (`u_userid`, `name`, `address`, `email`, `contact`, `u_username`, `u_password`, `u_rolecode`) VALUES ('$u_userid', '$name', '$address', '$email', '$contact', '$username', '$password', '$userrole')";
       // $result = mysqli_query($connection, $query);
      //  if($result){
        //    $smsg = "User Created Successfully.";
        //}else{
            //$fmsg ="User Registration Failed";
        //}
		
		
		
	@mysql_connect('localhost', 'root', '');
            mysql_select_db('multi-admin');
		
if (isset($_POST['modulegroupcode']) && isset($_POST['modulegroupname']) && isset($_POST['modulecode']) && isset($_POST['modulename']) && isset($_POST['modulegrouporder']) && isset($_POST['moduleorder']) && isset($_POST['modulepagename']) && isset($_POST['status'])){
        
		
		
		
		
		
		$modulegroupcode = strtoupper($_POST['modulegroupcode']);
		$modulegroupname = trim($_POST['modulegroupname']);
	  $modulecode = strtoupper($_POST['modulecode']);
	$modulename = trim($_POST['modulename']);
	  $modulegrouporder = trim($_POST['modulegrouporder']);
		$moduleorder = trim($_POST['moduleorder']);
		$modulepagename= trim($_POST['modulepagename']);
		$status = trim($_POST['status']);
		
	
        $query = "INSERT INTO `module` (`mod_modulegroupcode`, `mod_modulegroupname`, `mod_modulecode`, `mod_modulename`, `mod_modulegrouporder`, `mod_moduleorder`, `mod_modulepagename`, `Status`, `rr_status`) VALUES ('$modulegroupcode', '$modulegroupname', '$modulecode', '$modulename', '$modulegrouporder', '$moduleorder', '$modulepagename', '$status', 'yes')";
       
		$result = mysql_query($query) or die(mysql_error());
        if($result){
            echo "Successful";
        }else{
            echo "Module Registration Failed";
        }
    }
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
    
    ?>
