<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.0/bootstrap-table.min.css" rel="stylesheet"/>

<?php
	/*
	$string = array('"88:C9:D0:EE:CA:D9"','"88:C9:D0:EE:CA:D9"');
	
	$stringTrim = ltrim(rtrim((string)$string[0],'"'),'"');
	
	// $stringTrim = str_replace('"', '', $string[0]);

	print $stringTrim;
	*/

	function build_table($array){
	    // start table
	    $html = '<table>';
	    // header row
	   /*
	    $html .= '<tr>';
	    foreach($array[0] as $key=>$value){
	            $html .= '<th>' . htmlspecialchars($key) . '</th>';
	        }
	    $html .= '</tr>';
		*/
	    // if (is_array($array))
	    // 	echo "This is an array!";
	    
	    // data rows
	    foreach( $array as $key=>$value){
	        $html .= '<tr>';
	        foreach($value as $key2=>$value2){
	            $html .= '<td>' . htmlspecialchars($value2) . '</td>';
	        }
	        $html .= '</tr>';
	    }

	    // finish table and return it

	    $html .= '</table>';
	    return $html;
	}

	function uptime($seconds) {
	  	$t = round($seconds);
	  	return sprintf('%02d:%02d:%02d', ($t/3600),($t/60%60), $t%60);
	}

	include 'modified.php';
	
	$host = "202.166.207.28";
	$name = "ubnt";
	$pass = "authentication";
	
	$t = new TELNET();
	
	$t->Connect($host, $name, $pass);
	$t->LogIn();

	//$t->GetOutputOf("ubnt");
	//$t->GetOutputOf("bghimire#123");
	$out = $t->GetOutputOf("ubnt");
	$out = $t->GetOutputOf("authentication");
	$out = $t->GetOutputOf("wstalist");
	$out = array_filter($out);
	// $size = sizeof($out);

	// $out = Array
	// 			(
	// 			    [0] => [
	// 			    [1] =>         {
	// 			    [2] =>                 "mac": "88:C9:D0:EE:CA:D9",
	// 			    [3] =>                 "name": "",
	// 			    [4] =>                 "lastip": "192.168.1.195",
	// 			    [5] =>                 "associd": 1,
	// 			    [6] =>                 "aprepeater": 0,
	// 			    [7] =>                 "tx": 72.222,
	// 			    [8] =>                 "rx": 72.222,
	// 			    [9] =>                 "signal": -48,
	// 			    [10] =>                 "rssi": 48,
	// 			    [11] =>                 "chainrssi": [ 39 , 47 , 0 ],
	// 			    [12] =>                 "rx_chainmask": 3,
	// 		    	[13] =>                 "ccq": 99,
	// 			    [14] =>                 "idle": 1,
	// 			    [15] =>                 "tx_latency": 1,
	// 			    [16] =>                 "uptime": 6995,
	// 			    [17] =>                 "ack": 33,
	// 			    [18] =>                 "distance": 1732,
	// 			    [19] =>                 "txpower": 23,
	// 			    [20] =>                 "noisefloor": -91,
	// 			    [21] =>                 "airmax": {
	// 			    [22] =>                         "priority": 0,
	// 			    [23] =>                         "quality": 0,
	// 			    [24] =>                         "beam": -1,
	// 			    [25] =>                         "signal": 0,
	// 			    [26] =>                         "capacity": 0
	// 			    [27] =>                 },
	// 			    [28] =>                 "stats": {
	// 			    [29] =>                         "rx_data": 1143,
	// 			    [30] =>                         "rx_bytes": 252482,
	// 			    [31] =>                         "rx_pps": 0,
	// 			    [32] =>                         "tx_data": 1030,
	// 			    [33] =>                         "tx_bytes": 346234,
	// 			    [34] =>                         "tx_pps": 0
	// 			    [35] =>                 },
	// 			    [36] =>                 "rates": [ "MCS0", "MCS1", "MCS2", "MCS3", "MCS4", "MCS5", "MCS6", "MCS7" ],
	// 			    [37] =>                 "signals": [ 0, 0, 0, 0, 0, 0, 0, 0 ]
	// 			    [38] =>         },
	// 			    [39] =>         {
	// 			    [40] =>                 "mac": "D0:59:E4:B4:2A:06",
	// 			    [41] =>                 "name": "",
	// 			    [42] =>                 "lastip": "192.168.1.177",
	// 			    [43] =>                 "associd": 2,
	// 			    [44] =>                 "aprepeater": 0,
	// 			    [45] =>                 "tx": 72.222,
	// 			    [46] =>                 "rx": 52.0,
	// 			    [47] =>                 "signal": -51,
	// 			    [48] =>                 "rssi": 45,
	// 			    [49] =>                 "chainrssi": [ 41 , 41 , 0 ],
	// 			    [50] =>                 "rx_chainmask": 3,
	// 			    [51] =>                 "ccq": 98,
	// 			    [52] =>                 "idle": 4,
	// 			    [53] =>                 "tx_latency": 1,
	// 			    [54] =>                 "uptime": 6986,
	// 			    [55] =>                 "ack": 26,
	// 			    [56] =>                 "distance": 630,
	// 			    [57] =>                 "txpower": 23,
	// 			    [58] =>                 "noisefloor": -91,
	// 			    [59] =>                 "airmax": {
	// 			    [60] =>                         "priority": 0,
	// 			    [61] =>                         "quality": 0,
	// 			    [62] =>                         "beam": -1,
	// 			    [63] =>                         "signal": 0,
	// 			    [64] =>                         "capacity": 0
	// 			    [65] =>                 },
	// 			    [66] =>                 "stats": {
	// 			    [67] =>                         "rx_data": 5861,
	// 			    [68] =>                         "rx_bytes": 581516,
	// 			    [69] =>                         "rx_pps": 0,
	// 			    [70] =>                         "tx_data": 5687,
	// 			    [71] =>                         "tx_bytes": 5759921,
	// 			    [72] =>                         "tx_pps": 0
	// 			    [73] =>                 },
	// 			    [74] =>                 "rates": [ "MCS0", "MCS1", "MCS2", "MCS3", "MCS4", "MCS5", "MCS6", "MCS7" ],
	// 			    [75] =>                 "signals": [ 0, 0, 0, 0, 0, 0, 0, 0 ]
	// 			    [76] =>         },
	// 			    [77] =>         {
	// 			    [78] =>                 "mac": "EC:1F:72:18:14:AA",
	// 			    [79] =>                 "name": "",
	// 			    [80] =>                 "lastip": "192.168.1.147",
	// 			    [81] =>                 "associd": 3,
	// 			    [82] =>                 "aprepeater": 0,
	// 			    [83] =>                 "tx": 144.444,
	// 			    [84] =>                 "rx": 78.0,
	// 			    [85] =>                 "signal": -44,
	// 			    [86] =>                 "rssi": 52,
	// 			    [87] =>                 "chainrssi": [ 51 , 45 , 0 ],
	// 			    [88] =>                 "rx_chainmask": 3,
	// 			    [89] =>                 "ccq": 97,
	// 			    [90] =>                 "idle": 1,
	// 			    [91] =>                 "tx_latency": 2,
	// 			    [92] =>                 "uptime": 2225,
	// 			    [93] =>                 "ack": 24,
	// 			    [94] =>                 "distance": 315,
	// 			    [95] =>                 "txpower": 23,
	// 			    [96] =>                 "noisefloor": -91,
	// 			    [97] =>                 "airmax": {
	// 			    [98] =>                         "priority": 0,
	// 			    [99] =>                         "quality": 0,
	// 			    [100] =>                         "beam": -1,
	// 			    [101] =>                         "signal": 0,
	// 			    [102] =>                         "capacity": 0
	// 			    [103] =>                 },
	// 			    [104] =>                 "stats": {
	// 			    [105] =>                         "rx_data": 834,
	// 			    [106] =>                         "rx_bytes": 196548,
	// 			    [107] =>                         "rx_pps": 1,
	// 			    [108] =>                         "tx_data": 747,
	// 			    [109] =>                         "tx_bytes": 305859,
	// 			    [110] =>                         "tx_pps": 1
	// 			    [111] =>                 },
	// 			    [112] =>                 "rates": [ "MCS0", "MCS1", "MCS2", "MCS3", "MCS4", "MCS5", "MCS6", "MCS7", "MCS8", "MCS9", "CS10", "MCS11", "MCS12", "MCS13", "MCS14", "MCS15" ],
	// 			    [113] =>                 "signals": [ 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, -46, 0, 0, -44 ]
	// 			    [114] =>         }
	// 			    [115] => ]
	// 			);
	
	// echo "<pre>";
	// print_r($out);	
	// echo "</pre>";
	// exit;

	echo '<table data-toggle="table" data-url="test.php?type=owner&sort=mac&direction=asc&per_page=100&page=1" data-sort-name="stargazers_count" data-sort-order="desc">';
	echo "<thead><tr><th data-field='mac' data-sortable='true'>MAC</th><th data-field='lastip' data-sortable='true'>Last IP</th><th data-field='signal' data-sortable='true'>Signal Strength</th><th data-field='ccq' data-sortable='true'>CCQ</th><th data-field='uptime' data-sortable='true'>UP Time</th><th data-field='data' data-sortable='true'>Data Transmitted (Rx/Tx)</th></tr></thead><tbody>";
	
	for ($i=1; $i < count($out); $i=$i+38)
	{
	    $i++;
	    echo "<tr>";
	    $tdValude = $i;

	    // echo ltrim(str_replace('",','',$out[$i]),'"mac": "')."==";
	    if (count($out) >= $i)
	    	$mac = ltrim(str_replace('",','',$out[$i]),'"mac": "');
	    else
			echo "Value Greater";	
	    $mac = preg_replace('/\s+/', '', $mac);

	    // echo count($out);
	    // echo $mac;
	    // exit;
	    // 
	    // echo strcmp($mac,"78:8A:20:16:06:07")."===";

	    // echo $tdValude."-";

	    if ( strcmp($mac,"78:8A:20:16:06:07") == 0)
		{
			// echo "Hello";
			// echo $i;
			$tdValude = $tdValude+71;


		    if (!empty($out[$tdValude])) {
		    	// echo "<td>$out[$tdValude]</td>";
		    	
		    	echo "<td>".ltrim(str_replace('",','',$out[$tdValude]),'"mac": "')."</td>";
		    	$newTdValue = $tdValude+2;
		    	// echo "<td>$out[$newTdValue]</td>";
		    	echo "<td>".ltrim(str_replace('",','',$out[$newTdValue]),'"lastip": "')."</td>";
		    	$signal = $newTdValue+5;
		    	// echo "<td>$out[$signal]</td>";
		    	echo "<td>".ltrim(str_replace(',','',$out[$signal]),'"signal": "')." dB</td>";
		    	$ccq = $signal+4;
		    	// echo "<td>$out[$ccq]</td>";
		    	echo "<td>".ltrim(str_replace(',','',$out[$ccq]),'"ccq": "')." %</td>";
		    	$uptime = $ccq+3;
		    	$new_uptime = $ccq + 3;
		    	// echo "<td>$out[$uptime]</td>";
		    	$uptime = ltrim(str_replace(',','',$out[$uptime]),'"uptime": "');
		    	echo "<td>".uptime($uptime)."</td>";
		    	
		    	$rdata = $new_uptime+15;
		    	$rxdata = ltrim(str_replace(',','',$out[$rdata]),'"rx_bytes": "');
		    	$rxdata = round($rxdata/(1024*1024),2);

		    	$tdata = $rdata+3;
		    	// echo "<td>$out[$uptime]</td>";
		    	$txdata = ltrim(str_replace(',','',$out[$tdata]),'"tx_bytes": "');
				$txdata = round($txdata/(1024*1024),2);	    	
		    	echo "<td>".$rxdata." MB/ $txdata MB</td>";
		    }
		}
		else
		{ 
			$tdValude = $tdValude+71;
			// echo $tdValude."==";
			if (!empty($out[$tdValude])) {
		    	// echo "<td>$out[$tdValude]</td>";
		    	echo "<td>".ltrim(str_replace('",','',$out[$tdValude]),'"mac": "')."</td>";
		    	$newTdValue = $tdValude+2;
		    	// echo "<td>$out[$newTdValue]</td>";
		    	echo "<td>".ltrim(str_replace('",','',$out[$newTdValue]),'"lastip": "')."</td>";
		    	$signal = $newTdValue+5;
		    	// echo "<td>$out[$signal]</td>";
		    	echo "<td>".ltrim(str_replace(',','',$out[$signal]),'"signal": "')." dB</td>";
		    	$ccq = $signal+4;
		    	// echo "<td>$out[$ccq]</td>";
		    	echo "<td>".ltrim(str_replace(',','',$out[$ccq]),'"ccq": "')." %</td>";
		    	$uptime = $ccq+3;
		    	$new_uptime = $ccq + 3;
		    	// echo "<td>$out[$uptime]</td>";
		    	$uptime = ltrim(str_replace(',','',$out[$uptime]),'"uptime": "');
		    	echo "<td>".uptime($uptime)."</td>";
		    	
		    	$rdata = $new_uptime+15;
		    	$rxdata = ltrim(str_replace(',','',$out[$rdata]),'"rx_bytes": "');
		    	$rxdata = round($rxdata/(1024*1024),2);

		    	$tdata = $rdata+3;
		    	// echo "<td>$out[$uptime]</td>";
		    	$txdata = ltrim(str_replace(',','',$out[$tdata]),'"tx_bytes": "');
				$txdata = round($txdata/(1024*1024),2);	    	
		    	echo "<td>".$rxdata." MB/ $txdata MB</td>";
		    }
		}
	    echo "</tr>";
	}

	echo "</tbody></table>"; 
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.0/bootstrap-table.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
	  	$('#example').DataTable();
	});
</script>