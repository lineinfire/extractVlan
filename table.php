<table>
<?php
	$array = "78:8A:20:16:06:07 192.168.11.100 -15 98 0 3C:FA:43:B8:7C:A9 192.168.11.112 -42 99 0 3C:FA:43:B8:7D:B7 192.168.11.199 -49 99 0 94:65:2D:CD:E1:91 192.168.11.164 -46 99 0 00:F4:6F:96:01:F9 192.168.11.34 -51 96 0 48:FC:B6:17:7F:4E 192.168.11.237 -66 99 0 E8:50:8B:63:5D:2E 192.168.11.155 -55 99 0 84:11:9E:3D:69:E0 192.168.11.225 -56 99 0 2C:AE:2B:85:9D:91 192.168.11.200 -88 73 0 FC:19:10:05:F0:82 192.168.11.109 -50 99 0 18:F0:E4:EB:A6:CA 192.168.11.59 -42 99 0 D0:FF:98:9B:C7:D6 192.168.11.160 -53 99 0 18:3A:2D:AB:64:10 192.168.11.55 -56 99 0 DC:74:A8:34:32:B5 192.168.11.105 -57 99 0 1C:23:2C:41:25:01 192.168.11.206 -80 98 0 80:ED:2C:1D:43:DE 192.168.11.210 -59 100 0";
	$arrayBroken = explode(" ",$array);


	// print_r($arrayBroken);
	echo "<tr>";

	for ($i=1; $i < count($arrayBroken); $i++)
	{
		
		// echo ($arrayBroken[$i]);

		echo "<td width='20%'>".$arrayBroken[$i-1]."</td>";

		if ($i%5 == 0)
			echo "</tr>";
	}
?>
</table>