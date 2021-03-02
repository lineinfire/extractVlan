<?php
session_start();
require_once("dbconnect.php");
  @mysql_connect('localhost', 'root', '');
            mysql_select_db('multi-admin');
if (isset($_POST['switchid']) && isset($_POST['modulecode']) && isset($_POST['select1']) && isset($_POST['select2']) && isset($_POST['select3']) && isset($_POST['select4'])){
        
       $switchid = strtoupper($_POST['switchid']);
		$modulecode = trim($_POST['modulecode']);
	 
	
	  $select1 = trim($_POST['select1']);
		 $select2 = trim($_POST['select2']);
		 $select3= trim($_POST['select3']);
		 $select4 = trim($_POST['select4']);
		
	$query = "UPDATE `role_rights` SET `rr_create` = '$select1', `rr_edit` = '$select4', `rr_delete` = '$select2', `rr_view` = '$select3' WHERE `role_rights`.`rr_rolecode` = '$switchid' AND `role_rights`.`rr_modulecode` = '$modulecode'";
    
       
		$result = mysql_query($query) or die(mysql_error());
        if($result){

        echo "Role Updated Successfully";
      }

      else{
            echo "Role Update Process Failed";
        }
    }
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
    
    ?>
