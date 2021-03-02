<?php

include("connection.php");

$switchid = trim($_POST["switchid"]);




$sql = "SELECT DISTINCT `mod_modulegroupcode` FROM `module` WHERE `rr_status` = 'yes'";

$count = mysqli_num_rows( mysqli_query($con, $sql) );
if ($count > 0 ) {
$query = mysqli_query($con, $sql);
?>

<select name="modulecode" id="modulecode">
	<option value="">Please Select</option>
	<?php while ($rs = mysqli_fetch_array($query, MYSQLI_ASSOC)) { ?>
	<option value="<?php echo $rs["mod_modulegroupcode"]; ?>"><?php echo $rs["mod_modulegroupcode"]; ?></option>
	<?php } ?>
</select>

<?php 
	}

?>
