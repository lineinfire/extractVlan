<?php
	$mysqli = new mysqli(  "localhost", "root", "", "multi-admin" );
	// $ivalue=1;
	
	$res = $mysqli->multi_query( "CALL delete_module('PURCHASES',@out_value);SELECT @out_value" );
	if( $res ) 
	{
		$results = 0;
		do 
		{
			if ($result = $mysqli->store_result()) 
			{
				printf( "<b>Result #%u</b>:<br/>", ++$results );
				while( $row = $result->fetch_row() ) 
				{
					foreach( $row as $cell )
						echo $cell, "&nbsp;";
				}
				
				$result->close();
	
				if($mysqli->more_results())
					echo "<br/>";
			}
		} while( $mysqli->next_result() );
	}
	$mysqli->close();
?>