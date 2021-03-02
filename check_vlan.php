<?php
	$vlanid = 23;
	
	$isAvailable = true;
	
	$out = '
---- -------------------------------- --------- -------------------------------
1    default                          active
5    VLAN0005                         active
9    VLAN0009                         active
10   VLAN0010                         active
11   VLAN0011                         active
13   VLAN0013                         active
15   VLAN0015                         active
25   VLAN0025                         active

---- ----- ---------- ----- ------ ------ -------- ---- -------- ------ ------

Primary Secondary Type              Ports
------- --------- ----------------- ------------------------------------------';

	$out = trim($out);
	// print $out."<BR>";
	


	// $string = preg_replace("/(\r?\n){2,}/", "\n\n", $out);
	// $string = preg_replace("/[^0-9 ]/", '', $out);

	// print $string."<br>";
	//$array = explode(' ', $out);
	// $array = str_split($out);
	// print_r($array);
		
	$needle = 'VLAN';
	if (preg_match('/\b(' . preg_quote($needle, '/') . '\w+)/', $out,$match)) {
	    echo $match[1];
	}

	// $count = count($matches);
	// // print $count;
	
	// for ($i=0; $i<$count; $i++)
	// {
	// 	if ($matches[$i] == '')
	// 		continue;
	// 	else
	// 	{
	// 		echo "$matches[$i]<br>";
	// 	}
	// }
?>
