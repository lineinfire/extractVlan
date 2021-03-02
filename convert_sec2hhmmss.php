<?php
	function hoursToSecods ($hour) { // $hour must be a string type: "HH:mm:ss"
		// echo $hour;
	    $parse = array();
	    if (!preg_match ('#^(?<hours>[\d]{2}):(?<mins>[\d]{2}):(?<secs>[\d]{2})$#',$hour,$parse)) {
	         // Throw error, exception, etc
	         throw new RuntimeException ("Hour Format not valid");
	    }

	         return (int) $parse['hours'] * 3600 + (int) $parse['mins'] * 60 + (int) $parse['secs'];

	}

	$hour = date("H:i:s");
	echo $hour."<br>";

	$mos = round(hoursToSecods($hour));
	$hr = sprintf("%02d", floor($mos / 3600));
	$min = sprintf("%02d", floor(($mos - ($hr*3600)) / 60));
	$sec = sprintf("%02d", floor($mos % 60));
	echo $hr.':'.$min.':'.$sec;
?>