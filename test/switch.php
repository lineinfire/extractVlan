<?php
	require ('modified.php');

	if (isset($_POST['switchid'])) $switchid = trim( $_POST["switchid"]); else echo "No Switch ID set";
	if (isset($_POST['vlanid'])) $vlanid = trim( $_POST["vlanid"]); else echo "No VLAN ID Set";

	// $isAvailable = true;
	$host = $switchid;
	$user = "admin";
	$pass = "ATI#123";
	
	switch ($switchid) {
		case "192.168.7.229": 
			// echo "Here"; 
			$telnet = new PHPTelnet();
			$telnet->Connect($host, $user, $pass);
			$telnet->enable("ATI#123");
			$telnet->DoCommand("show vlan", $out);

			$out = trim($out);
			$array = explode(' ', $out);
			$only_vlan = array();

			foreach ($array as $key => $value) {
				if (strpos($value, 'VLAN') !== false) 
				{
					$only_vlan[$key] = $value;
				}
			}
			array_unshift($only_vlan, "VLAN0001");

			$isAvailable = false;
			
			foreach($only_vlan as $key => $value)
			{
				$newValue = (int)substr($value, 4);
				// echo trim($newValue)."<br>";

				if (trim($newValue) == $vlanid) {
					// echo $isAvaliable = true;
					// echo "Success";
					$isAvailable = true;
					echo $isAvailable = "Found";
				}
			}			
			
			if ($isAvailable == false) {
				// echo $isAvailable = false;
				// echo "Failed";
				echo $isAvailable = "Not Found";
			}
			break;

		case "192.168.7.254":
			$pass1 = "bghimire";
			$telnet = new PHPTelnet();
			$telnet->Connect($host, $user, $pass1);
			$telnet->enable("ATI#123");
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
				echo $isAvaliable = false;
			}
			else
			{
				echo $isAvaliable = true;
			}
		break;

	case "192.168.7.222":
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
			echo $isAvaliable = false;
		}
		else
		{
			echo $isAvaliable = true;
		}
		break;

	case "192.168.7.129":
		$vlanid = trim( $_POST["vlanid"]);
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
			echo $isAvaliable = false;
		}
		else
		{
			echo $isAvaliable = true;
		}
		break;
	default:
		echo "";
	}
?>