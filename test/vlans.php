<?php
require ('modified.php');
	require ('show.php');
if(isset($_POST['vlanid'])) {
	$vlanid = $_POST['vlanid'];
	$switchid = $_POST['switchid'];
	
	$host = '192.168.7.222';
	$user = "admin";
	$pass = "ATI#123";
	$isAvailable = true;
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
			echo $isAvailable = false;
		}
		else
		{
			$isAvailable=true;
		}
	
	
	echo json_encode(array(
    'valid' => $isAvailable,
));
	
	
	
}
























?>