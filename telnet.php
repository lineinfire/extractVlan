<?php
	include('Net/SSH2.php');

	$ssh = new Net_SSH2('202.166.220.218');
	if (!$ssh->login('admin', 'sanjana#123')) {
	    exit('Login Failed');
	}

	echo $ssh->exec('5');
?>