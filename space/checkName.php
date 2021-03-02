<?php
	$name = $_GET['name'];

	// if (ctype_upper($name))
	$array = preg_split('#([A-Z][^A-Z]*)#', $name, null, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
	// print_r($array);

	$count = count($array);
	// echo $count;

	for ($i =0; $i< $count; $i++) {
		echo $array[$i];
		if ($i == $count)
			exit;
		else 
			echo " ";
	}
?>