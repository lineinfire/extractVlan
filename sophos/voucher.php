<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css" rel="stylesheet"/>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
<style>
	#customers {
	    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	    border-collapse: collapse;
	    width: 100%;
	    font-size: 12px;    
	}

	#customers td, #customers th {
	    border: 1px solid #ddd;
	    padding: 8px;
	}

	#customers tr:nth-child(even){background-color: #ececec;}

	#customers tr:hover {background-color: #ddd;}

	#customers th {
	    padding-top: 12px;
	    padding-bottom: 12px;
	    text-align: left;
	    background-color: #ed1b24;
	    color: white;
	}
</style>
<?php
	$db_handle = pg_connect("host=192.168.7.2 port=5432 dbname=corporate user=nobody");
	$query = "SELECT * FROM tblvoucher order by id"; // where usedtime > 0";   
	$result = pg_exec($db_handle, $query);   
	// echo "Number of rows: " . pg_numrows($result);   


	$i = 0;
	echo '<html><body><table width="100%"" id="customers" class="table table-striped table-hover table-condensed"><thead><tr>';
	while ($i < pg_num_fields($result))
	{
		$fieldName = pg_field_name($result, $i);
		echo '<th>' . $fieldName . '</th>';
		$i = $i + 1;
	}
	echo '<th>QR Code</th>';
	echo '</tr></thead>';
	$i = 0;

	echo '<tbody>';
	while ($row = pg_fetch_row($result)) 
	{
		echo '<tr>';
		$count = count($row);
		$y = 0;
		while ($y < $count)
		{
			$c_row = current($row);
			// echo $c_row."==";

			if ($y == 1)
			{
				$hquery = "select * from tblhotspot where id='$c_row'";
				$hresult = pg_exec($db_handle, $hquery);
				$hrow = pg_fetch_row($hresult);

				echo '<td>'.$hrow[1].'</td>';
				next($row);
				$y = $y + 1;
			}
			else if ($y == 2)
			{
				$vquery = "select name from config.tblhotspotsvoucher where id=$row[2]";
				// echo $vquery;
				$vresult = pg_exec($db_handle, $vquery);
				$vrow = pg_fetch_row($vresult);

				echo '<td>'.$vrow[0].'</td>';
				next($row);
				$y = $y + 1;
			}
			else
			{
				echo '<td>' . $c_row . '</td>';
				next($row);
				$y = $y + 1;
			}
		}
		echo '<td cellpadding="10px">';?>
		<img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=http%3A%2F%2F192.168.254.1:4501%2Findex.cgi?code=<?=$row[3]?>" title="Scan to Connect" />
		<?php echo '</td>';
		echo '</tr>';
		$i = $i + 1;
	}

	echo '</tbody></table></body>';
?>
<script type="text/javascript">
$(document).ready(function() {
    $('.table').DataTable();
} );
</script>
<?php
	echo '</html>';
	pg_freeresult($result);  
	pg_close($db_handle);
?>