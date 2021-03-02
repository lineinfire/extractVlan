<html>
<head>
	<title>Insert</title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">

	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>

</head>
<body>

<label>Voucher </label>

<select>
	<?php
	$db_handle = pg_connect("host=202.166.207.28 port=5432 dbname=corporate user=nobody");
 $query = "SELECT * FROM tblhotspotsvoucher order by id"; // where usedtime > 0";   
 $result = pg_exec($db_handle, $query);   
 while ($row = pg_fetch_array($result)) 
 { 

 	echo '<option>'; echo $row["name"];echo '</option>';

 } 




 ?>
</select>

</body>
</html>