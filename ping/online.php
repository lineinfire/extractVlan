<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Covered+By+Your+Grace|Open+Sans+Condensed:300" rel="stylesheet">
<style type="text/css">
	.online {
		background-color: green;
		max-height: 60px;
		max-width: 90px;
	}
	.offline {
		background-color: red;
		max-height: 60px;
		max-width: 90px;
	}
	body{
		padding-left: 10px;
		overflow: hidden;
		margin: 0;
		font-family: 'Open Sans Condensed', sans-serif;
	}
</style>
<?php
	include_once("test.php");

	set_time_limit (120);

	// $ip = array("192.168.7.11", "192.168.7.130", "192.168.7.220", "192.168.7.221", "192.168.7.68", "192.168.5.101", "192.168.7.222", "192.168.7.255", "192.168.7.229", "192.168.7.254", "192.168.7.3", "192.168.7.1");
	$ip = array("192.168.7.11", "192.168.7.68");


	$iplength = count($ip);

	print '<div class="row" style="border-right: 1px solid gray;">';
	for($x = 0; $x < $iplength; $x++) {
	    // echo $ip[$x];
	    // echo "<br>";
	    $status = pingAddress($ip[$x]);

	    print '<div class="col-md-2">';
		if ($status == "alive")
			print "<img src='computer_user-512.png' class='online' />";
		else
			print "<img src='computer_user-512.png' class='offline' />";
		// print "<br />". $ip[$x];
		print "<br /><strong>". gethostbyaddr($ip[$x]);
		print "</strong></div>";
	}
	print "</div>";

	// echo gethostbyaddr("192.168.7.130");
?>