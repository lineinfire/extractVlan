<?php
require ('modified.php');

//$switchlocation = trim( $_POST["switchlocation"]);
$vlanid = trim( $_POST["vlanid"]);
$switchid = trim( $_POST["switchlocation"]);
$host = $switchid;

	
	
	
	//$switchid = $_POST['SwitchID'];
	//$host = $switchid;
	//$host = '192.168.7.222';
	
	$user = "admin";
	$pass = "ATI#123";
	$isAvailable = true;
	if ($switchid = "192.168.7.222" || $switchid ="192.168.7.129")
	{
		$telnet = new PHPTelnet();
		$telnet->Connect($host, $user, $pass);
		$telnet->DoCommand("show vlan", $out);
		$out = trim($out);
		// print $out."<BR>";
		$string = preg_replace("/[^0-9 ]/", '', $out);
		// print $string."<br>";
		$array = explode(' ', $string);
		//print_r($array);
		$count = count($array);
		// print $count;
		
		for ($i=0; $i<$count; $i++)
		{
			if ($array[$i] == '')
				continue;
			else
			{
				// echo "$array[$i]<br>";
			}
		}

		$output = $vlanid;

		if (in_array($output, $array)) {
			echo $isAvaliable = true;
		}
		else
		{
			echo $isAvaliable = false;
		}
	}
	else   
	{
		
		$vlanid = trim( $_POST["vlanid"]);
$switchid = trim( $_POST["switchlocation"]);
$host = $switchid;

	
	
	
	//$switchid = $_POST['SwitchID'];
	//$host = $switchid;
	//$host = '192.168.7.222';
	
	$user = "admin";
	$pass = "ATI#123";
	$isAvailable = true;
		
	$telnet = new PHPTelnet();
		$telnet->Connect($host, $user, $pass);
		$telnet->enable("ATI#123");
		$telnet->DoCommand("show vlan", $out);
		echo $out = trim($out);
		// print $out."<BR>";
		$string = preg_replace("/[^0-9 ]/", '', $out);
		// print $string."<br>";
		$array = explode(' ', $string);
		//print_r($array);
		$count = count($array);
		// print $count;
		
		for ($i=0; $i<$count; $i++)
		{
			if ($array[$i] == '')
				continue;
			else
			{
				// echo "$array[$i]<br>";
			}
		}

		$output = $vlanid;

		if (in_array($output, $array)) {
			echo $isAvaliable = true;
		}
		else
		{
			echo $isAvaliable = false;
		}
	}	
		
		
		
		
		
		
		
		
		
		
		
		
		
		
			
	
	
	echo json_encode(array('valid' => $isAvailable));

?>
