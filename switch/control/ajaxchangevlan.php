<?php
include ("modified.php");
include ("PHPTelnet.php");
$switchid = $_POST["switchid"];
$portid = $_POST["portid"];
$vlanid = $_POST["vlanid"];

	
	$server = $switchid;
    $user ='admin';
    $pass = 'ATI#123';

    $telnet = new PHPCiscoTelnet();
    $result = $telnet->Connect($server, $user, $pass);
	$telnet->enable('ATI#123');
                
	 $telnet->DoCommand("configure terminal");
	
    
	
	if (isset($_POST['portid']) || isset($_POST['vlanid'])) {
		
		

	    	
        	// print $portNumber."--";
        	// exit;
        	
         $telnet->DoCommand("int FastEthernet0/".$portid);
		  $telnet->DoCommand("switchport mode access");
		 $command = "switchport access vlan ". $vlanid;
		 $access = $telnet->DoCommand($command);
		 
		 
    if ($access == 0) {
		
		
		echo "Process Failed";
	}
		else {
			
			
		echo "ok";
		$telnet->Disconnect();	
			
		}
		
			
        	
        	
			
        	
        	// print $checkStatus."-->";
        	
	    
	

			
	}
?>