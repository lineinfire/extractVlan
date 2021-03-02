<?php
	include_once("sophos_credentials.php");	

	$ip = $_POST['ipaddress'];
	$name =  $_POST['name'];

	$apiURL = 'https://192.168.7.1:4444/webconsole/APIController?reqxml=%3CRequest%20APIVersion=%221702.1%22%3E%3CLogin%3E%3CUsername%3E'.USERNAME.'%3C/Username%3E%3CPassword%3E'.PASSWORD.'%3C/Password%3E%3C/Login%3E%3CSet%20operation=%22update%22%3E%3CIPHost%3E%3CName%3E'.str_replace(' ', '%20', $name).'%3C/Name%3E%3CIPFamily%3EIPv4%3C/IPFamily%3E%3CHostType%3EIP%3C/HostType%3E%3CIPAddress%3E'.$ip.'%3C/IPAddress%3E%3C/IPHost%3E%3C/Set%3E%3C/Request%3E';
	// echo $apiURL;
	
	$arrContextOptions=array(
    "ssl"=>array(
      "verify_peer"=>false,
      "verify_peer_name"=>false,
      ),
    );  

  	$response = file_get_contents($apiURL, false, stream_context_create($arrContextOptions));
  	$items = simplexml_load_string($response);
  	// echo $response;
  
	/********************************/
	/* This returns the Status Code */
	/********************************/
	$sxml = $items->xpath("//Status");
	echo $sxml[0]->attributes()->code;	
	/********************************/

	if (($sxml[0]->attributes()->code) == SUCCESS)
		header('Location: iphostdetails.php?success=true');
	else
		header('Location: iphostdetails.php?success');	
?>