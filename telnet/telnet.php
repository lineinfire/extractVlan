<?php
	include('Net/SSH2.php');

	$ssh = new Net_SSH2('192.168.7.2');
	if (!$ssh->login('admin', 'sanjana#123')) {
	    exit('Login Failed');
	}

	// echo $ssh->exec('5');
	echo '<pre>';
	echo $ssh->read('username@username:~$');
	$ssh->write("5\n");
	echo $ssh->read('username@username:~$');
	$ssh->write("3\n");
	echo $ssh->read('username@username:~$');
	$ssh->exec("arp -a");
	echo '</pre>';
?>