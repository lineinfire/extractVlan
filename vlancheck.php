<?php
	require ('modified1.php');
	require ('show.php');
	//$switchlocation = trim( $_POST["switchlocation"]);
	// $vlanid = trim($_POST["vlanid"]);
	// $switchid = trim($_POST["switchid"]);
	// 
	$vlanid = $_GET['id'];
	// $switchid = "192.168.7.129";
	$switchid = $_GET['switchid'];
	$host = $switchid;

	//$switchid = $_POST['SwitchID'];
	//$host = $switchid;
	//$host = '192.168.7.222';
	
	$user = "admin";
	$pass = "ATI#123";
	$isAvailable = true;
	if ($switchid ="192.168.7.129" || $switchid = "192.168.7.222")
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
				if (($i % 2) == 0) unset ($array[$i]);		
				// $result = $array[$i];
				if (isset($array[$i])) {
					//echo "$array[$i]<br>";
				}
			}
		}

		$output = $vlanid;

		if (in_array($output, $array)) {
			$isAvailable = true;
			echo $output." if <BR>";
		}
		else
		{
			$isAvailable = false;
			echo $output." else <br>";
		}
	}
	else   
	{
		print "Here";			
	}
	echo json_encode(array('valid' => $isAvailable,));
?>
