<?php
session_start();
require_once("dbconnect.php");
  @mysql_connect('localhost', 'root', '');
            mysql_select_db('multi-admin');
if (isset($_POST['switchid']) && isset($_POST['pageid']) && isset($_POST['select1']) && isset($_POST['select2']) && isset($_POST['select3']) && isset($_POST['select4'])){
        
        $switchid = strtoupper($_POST['switchid']);
		$modulecode = trim($_POST['modulecode']);
	  $pageid = strtoupper($_POST['pageid']);
	
	  $select1 = trim($_POST['select1']);
		$select2 = trim($_POST['select2']);
		$select3= trim($_POST['select3']);
		$select4 = trim($_POST['select4']);
		
	$query = "UPDATE `module` SET `rr_status` = 'no' WHERE `module`.`mod_modulegroupcode` = '$modulecode'";
    $query1 = "INSERT INTO `role_rights` (`rr_rolecode`, `rr_modulecode`, `rr_create`, `rr_edit`, `rr_delete`, `rr_view`) VALUES ('$switchid', '$pageid', '$select1', '$select2', '$select3', '$select4')";
       
		$result = mysql_query($query) or die(mysql_error());
        if($result){

        mysql_query($query1) or die(mysql_error());




            echo "Role Assigned Successfully";
      }else{
            echo "Role Registration Failed";
        }
    }
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
    
    ?>
