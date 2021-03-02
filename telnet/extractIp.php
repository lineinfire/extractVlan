<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
<style>
	em {
		color: red;
	}

	#searchInput {
		background-repeat: no-repeat;
		width: 100%;
		font-size: 16px;
		padding: 12px 20px 12px 40px;
		border: 1px solid #ddd;
		margin-bottom: 12px;
		margin-top: 12px;
		margin-right: 12px;
	}
	table {
		width: 90%;
		margin: 0 auto;
	}
</style>
<?php

	include("news.php");
	$server = "192.168.7.2";
	$user = "admin";
	$pass = trim("sanjana#123");
	$telnet = new TELNET();
	$telnet->Connect($server,$user,$pass);
	$telnet->LogIn();
	$telnet->GetOutputOf("sanjana#123");
	$telnet->GetOutputOf("5");
	$telnet->GetOutputOf("3");
	$p1 = $telnet->GetOutputOf("arp -a");
	$count = 1;

	echo '<div style="float:right"><input type="text" id="searchInput" onkeyup="myFunction()" placeholder="Search"></div>';
	echo '<table id="arpTable" class="table table-hover table-striped"><tr><th>S.No.</th><th>IP Address</th><th>MAC Address</th><th>Port</th></tr>';
	foreach ($p1 as $string) {
		$forMac = $string;
		preg_match("/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/", $string, $matches);
		if (!empty($matches[0])) {

			$ip = $matches[0];

			// echo $forMac;
			
			$str = $string;
			// echo $str;
			preg_match_all("/\b[[:xdigit:]]{2}:[[:xdigit:]]{2}:[[:xdigit:]]{2}:[[:xdigit:]]{2}:[[:xdigit:]]{2}:[[:xdigit:]]{2}\b/su", $str, $macMatch);

			$mac = (!empty($macMatch[0][0])) ? $macMatch[0][0] : '<em>Not Found<em>';
			
			// echo $mac;

			$vlan = substr($str, strpos($str, 'Port')+4);
			// echo $vlan;
			echo '<tr>
					<td>'.$count.'</td>
    				<td>'.$ip.'</td>
    				<td>'.$mac.'</td>
    				<td>'.$vlan.'</td>
  				</tr>';
			//echo "String value is : ".$string."<br>";
			// echo "IP Address : ".$ip."<br>";
			// echo "MAC Address : ".$mac."<br>";
			// echo "VLAN Address : ".$vlan."<br>";
			// echo "-----------------------------<br>";
  			$count++;
		}
	}
	echo '</table>';
?>
<script>
	function myFunction() {
	  var input, filter, table, tr, td, i, txtValue;
	  input = document.getElementById("searchInput");
	  filter = input.value.toUpperCase();
	  table = document.getElementById("arpTable");
	  tr = table.getElementsByTagName("tr");

	  // Loop through all table rows, and hide those who don't match the search query
	  for (i = 0; i < tr.length; i++) {
	    td = tr[i].getElementsByTagName("td")[1];
	    if (td) {
	      txtValue = td.textContent || td.innerText;
	      if (txtValue.toUpperCase().indexOf(filter) > -1) {
	        tr[i].style.display = "";
	      } else {
	        tr[i].style.display = "none";
	      }
	    }
	  }
	}
</script>