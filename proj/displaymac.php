<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<!-- <link href="style.css" rel="stylesheet"/> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style type="text/css">
	progress[value]::-webkit-progress-value::before {
	  content: '80%';
	  position: absolute;
	  right: 0;
	  top: -125%;
	}
</style>
<!--<script type="text/javascript">-->
<!--    colors = new Array('green', 'white');-->
<!---->
<!--    function annoyingEffectOnDiv(tic, divId){-->
<!--        tic %= colors.length;-->
<!--        divVar = document.getElementsByClassName(divId);-->
<!--        divVar.style.background = colors[tic];-->
<!--        setTimeout("annoyingEffectOnDiv("+(tic+1)+", '"+divId+"')", 1000);-->
<!--    }-->
<!---->
<!--</script>-->
<?php

	function changeCss($value) {
		if ($value <=33)
	    	$class = "progress-bar-danger";
	    if ($value >66)
	    	$class = "progress-bar-success";
	    if ($value >33 && $value <=66)
	    	$class = "progress-bar-warning";
	    return $class;
	}

	include 'modified.php';
	// $host = "202.166.220.12";
	$host = "192.168.100.254";
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
	// print_r($out);
	echo '<table class="table">
	<thead>
		<tr>
		  	<th scope="col">Station Id</th>
		  	<th scope="col">IP Address</th>
		  	<th scope="col">Transmit CCQ</th>
		  	<th scope="col">Signal</th>
		  	<th scope="col">Upload</th>
		  	<th scope="col">Download</th>		   	
		   	<th scope="col">UP Time</th>
		   	<th scope="col">Status</th>
		</tr>
	</thead>';
?>
<!--<tbody onload="annoyingEffectOnDiv(2, 'online')">-->
<tbody>
	<?php
	for ($i=1; $i < count($out); $i=$i+38)
	{
		echo  '<tr>';
		$i++;
		$tdValude = $i;
		$p = $tdValude+2;
		$ccq = $tdValude+11;
		$sign = $tdValude+7;
		$rx = $tdValude+29;
		$tx = $tdValude+32;
		$utime = $tdValude+14;
		// echo $i;

	 	if (!empty($out[$tdValude])) {

	  		// echo $out[$tdValude];
	  		if (strpos($out[$tdValude], 'hostname'))
	  		{
	  			continue;
	  		}
	  		else
	  		{
	  		
			$trim = explode(' ', $out[$tdValude]);
			$bis =  array_filter($trim);
			$t = array_values($bis);

			$s = str_replace('"', '', $t[1]);
			$t = str_replace(',', '', $s);
			echo '<td>'; echo $t; echo '</td>';


			$ip = explode(' ', $out[$p]);
			$index =  array_filter($ip);
			$re = array_values($index);
			$qu = str_replace('"', '', $re[1]);
			$m = str_replace(',', '', $qu);

			echo '<td>'; echo $m; echo '</td>';

			$cc = explode(' ', $out[$ccq]);
			$ccq1 =  array_filter($cc);
			$rest = array_values($ccq1);
			$qus = str_replace('"', '', $rest[1]);
			$mq = str_replace(',', '', $qus);


			//  echo '<td>'; echo $mq."%"; echo '</td>';
			// echo '<td>
			// <div class="progress '. $class.'" style="margin-bottom: 0; width:'.$mq.'%;">
			// <div data-toggle="tooltip" data-placement="bottom" class="progress-bar" role="progressbar" aria-valuenow="40"
			//      aria-valuemin="0" aria-valuemax="100" style="width:'; echo $mq. '%" 
			//     &nbsp;'; echo $mq. '% Complete (success)
			// </div>
			// </div>'; echo $mq."%"; echo '</td>';
			// 
	
	?>
			<script type="text/javascript">
				// $( document ).ready(function() {
				//     var mq = <?=trim($mq)?>;
				//     console.log(mq);
				//     if (mq <=33)
				//     	$( "#progress<?=trim($mq)?>" ).addClass( "progress-bar-danger" );
				//     if (mq >66)
				//     	$( "#progress<?=trim($mq)?>" ).removeClass("progress-bar-warning").addClass( "progress-bar-success" );
				//     if (mq >33 && mq <=66)
				//     	$( "#progress<?=trim($mq)?>" ).addClass( "progress-bar-warning" );
				// });
			</script>
			<td>
				<div class='progress'>
				<div id="progress<?=trim($mq)?>" class='progress-bar progress-bar-striped active <?=changeCss(trim($mq))?>' role='progressbar' aria-valuenow='70' aria-valuemin='0' aria-valuemax='100' style='width:<?=trim($mq)?>%;'><?=trim($mq)?>%</div></div>
			</td>
	<?php
		$signal = explode(' ', $out[$sign]);
		$ccq2 =  array_filter($signal);
		$rest1 = array_values($ccq2);
		$qus1 = str_replace('"', '', $rest1[1]);
		$mq1 = str_replace(',', '', $qus1);

		echo '<td>'; echo $mq1."dbm"; echo '</td>';

		$rec = explode(' ', $out[$rx]);
		$re =  array_filter($rec);
		$receive = array_values($re);
		$rhs = str_replace('"', '', $receive[1]);
		$rh = str_replace(',', '', $rhs);

		$conv =  $rh/1000000;
		$m = round($conv, 2);

		echo '<td>'; echo $m.' '."MB"; echo '</td>';

		$trans= explode(' ', $out[$tx]);
		$re1 =  array_filter($trans);
		$receives = array_values($re1);
		$rhs1 = str_replace('"', '', $receives[1]);
		$rh2 = str_replace(',', '', $rhs1);


		$conv1 =  $rh2/1000000;
		$m1 = round($conv1, 2);

		echo '<td>'; echo $m1.' '."MB"; echo '</td>';

		$status= 'Online';

		$uptime = explode(' ', $out[$utime]);
		$ut =  array_filter($uptime);
		$upst = array_values($ut);
		$strr = str_replace('"', '', $upst[1]);
		$mos = str_replace(',', '', $strr);


		$mos = round($mos);
		// echo $t1;
		//13:34:53
		$hr = sprintf("%02d", floor($mos / 3600));
		$min = sprintf("%02d", floor(($mos - ($hr*3600)) / 60));
		$sec = sprintf("%02d", floor($mos % 60));
		//echo $hr.':'.$min.':'.$sec;


		echo '<td>'; echo $hr; echo ':'.$min.':'.$sec.'</td>';


		echo '<td>'; echo $status; echo '</td>';
		//echo '<td class="online">'; echo $status; echo '</td>';

		}
	}}
	echo "</tbody></table>";
?>
