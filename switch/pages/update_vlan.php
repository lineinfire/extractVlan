<?php

//UPDATE `emp_info` SET `vlanid` = '20' WHERE `emp_info`.`Id` = 28;
//include ("control/modified.php");
//include ("control/PHPTelnet.php");
$servername = "localhost";
$username = "root";
$password = "";
$id = $_POST['id'];
$switchcode = $_POST['switchcode'];
$portid = $_POST['portid'];
$newvlan = $_POST['newvlan'];
try {
    $conn = new PDO("mysql:host=$servername;dbname=module", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }


$stmt = $conn->Query("UPDATE `emp_info` SET `vlanid` = '$newvlan' WHERE `emp_info`.`Id` = '$id'");

if($stmt) {


	//echo 'Update Successful';
include ("../control/modified.php");
//include ("control/PHPTelnet.php");

switch ($switchcode) {
    case '192.168.7.129':
        	$server = '192.168.7.129';
    $user ='cisco';
    $pass = 'sanjana#123';

  $telnet = new PHPTelnet();
    $telnet->Connect($server, $user, $pass);
	//$telnet->enable('ATI#123');
                
	 $telnet->DoCommand("configure terminal",$out);
	
	$telnet->DoCommand("int GigabitEthernet".$portid,$out);
		  $telnet->DoCommand("switchport mode access",$out);
		 //$command = "switchport access vlan ". $newvlan,;
		 $access = $telnet->DoCommand("switchport access vlan ". $newvlan,$out);
		 
		 
    if ($access == 0) {
		
		
		echo "Process Failed";
	}
		else {
			
			
		echo "Update Successful";
		$telnet->Disconnect();	
			
		}

        break;
    case '192.168.7.229':
        	$server = '192.168.7.229';
    $user ='cisco';
    $pass = 'sanjana#123';

  $telnet = new PHPTelnet();
    $telnet->Connect($server, $user, $pass);
	//$telnet->enable('ATI#123');
                
	 $telnet->DoCommand("configure terminal",$out);
	
	$telnet->DoCommand("int GigabitEthernet".$portid,$out);
		  $telnet->DoCommand("switchport mode access",$out);
		 //$command = "switchport access vlan ". $newvlan,;
		 $access = $telnet->DoCommand("switchport access vlan ". $newvlan,$out);
		 
		 
    if ($access == 0) {
		
		
		echo "Process Failed";
	}
		else {
			
			
		echo "Update Successful";
		$telnet->Disconnect();	
			
		}

        break;
    case '192.168.7.230':
        	$server = '192.168.7.230';
    $user ='cisco';
    $pass = 'sanjana#123';

  $telnet = new PHPTelnet();
    $telnet->Connect($server, $user, $pass);
	//$telnet->enable('ATI#123');
                
	 $telnet->DoCommand("configure terminal",$out);
	
	$telnet->DoCommand("int FastEthernet".$portid,$out);
		  $telnet->DoCommand("switchport mode access",$out);
		 //$command = "switchport access vlan ". $newvlan,;
		 $telnet->DoCommand("switchport access vlan ". $newvlan,$out);
		 $telnet->DoCommand("do write",$out);
		$access= $telnet->DoCommand("y",$out);

		 
    if ($access == 0) {
		
		
		echo "Process Failed";
	}
		else {
			
			
		echo "Update Successful";
		$telnet->Disconnect();	
			
		}

        break;
    case '192.168.7.231':
    	$server = '192.168.7.231';
    $user ='bghimire';
    $pass = 'bghimire';

  $telnet = new PHPTelnet();
    $telnet->Connect($server, $user, $pass);
	$telnet->enable('bghimire');
                
	 $telnet->DoCommand("configure terminal",$out);
	
	$telnet->DoCommand("int FastEthernet0/".$portid,$out);
		  $telnet->DoCommand("switchport mode access",$out);
		 //$command = "switchport access vlan ". $newvlan,;
		 $telnet->DoCommand("switchport access vlan ". $newvlan,$out);
		 $access = $telnet->DoCommand("do wr",$out);
		 
    if ($access == 0) {
		
		
		echo "Process Failed";
	}
		else {
			
			
		echo "Update Successful";
		$telnet->Disconnect();	
			
		}
		break;
		  case '192.168.7.254':
    	$server = '192.168.7.254';
    $user ='bghimire';
    $pass = 'bghimire';

  $telnet = new PHPTelnet();
    $telnet->Connect($server, $user, $pass);
	$telnet->enable('ATI#123456789');
                
	 $telnet->DoCommand("configure terminal",$out);
	
	$telnet->DoCommand("int FastEthernet0/".$portid,$out);
		  $telnet->DoCommand("switchport mode access",$out);
		 //$command = "switchport access vlan ". $newvlan,;
		 $telnet->DoCommand("switchport access vlan ". $newvlan,$out);
		 $access = $telnet->DoCommand("do wr",$out);
		 
    if ($access == 0) {
		
		
		echo "Process Failed";
	}
		else {
			
			
		echo "Update Successful";
		$telnet->Disconnect();	
			
		}

    default:
        
}

 	
}
?>