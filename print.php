<?php
	function printHello($a) {
		// echo "Hello ".$a;
		// 
		$a = "I changed the text here!";
		outputToScreen($a); 
	}

	function outputToScreen($newText) {
		echo $newText;
	}

	$a = "Bishal Sir!!!";

	// printHello($a);


	$stringArray = array ("Mary","had","a","little","Lamb");
	print_r ($stringArray);
	$newString = "";

	for ($i=0; $i < sizeof($stringArray);$i++)
	{
		$newString .= " ".$stringArray[$i];
	}
	echo $newString;
?>