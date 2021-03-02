<?php
	include("qr/qrlib.php");

	function generateRandomString($length = 8) {
		$characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}

		$rand = rand(0,99);
		$rand = str_pad($rand, 2, '0', STR_PAD_LEFT);
		// $string = generateRandomString();
		$randomString .= $rand;
		return $randomString;
	}

	$numOfKeys = isset($_GET['no'])?$_GET['no']:1;
	for ($i = 0; $i < $numOfKeys; $i++) {
		$pwd = generateRandomString();

		// $param = $_GET['no']; // remember to sanitize that - it is user input! 
	    /*   
	    ob_start("callback"); 
	     
	    // here DB request or some processing 
	    $codeText = 'http://192.168.254.1:4501/index.cgi?code='.$pwd; 
	     
	    // end of processing here 
	    $debugLog = ob_get_contents(); 
	    ob_end_clean(); 
	     
	    // outputs image directly into browser, as PNG stream 
	    QRcode::png($codeText);
	    */
?>
	<?=$pwd?><br><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=http%3A%2F%2F192.168.254.1:4501%2Findex.cgi?code=<?=$pwd?>" title="Scan to Connect" />
<?php

	}
?>