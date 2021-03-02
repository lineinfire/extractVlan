<?php
	// $ipAddress = '';
	function pingAddress($ip) {
	    $pingresult = exec("ping -n 2 $ip", $outcome, $status);
	    // $pingresult = exec("arp -a", $outcome, $status);
	    if ($status == 0) {
	        $status = "alive";
	    } else {
	        $status = "dead";
	    }
	    // echo "The IP address, $ip is  ".$status;
	    return $status;
	}
?>