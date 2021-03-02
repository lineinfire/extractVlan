<?php

include("connection.php");

$switchid = trim($_POST["switchid"]);




$sql = "SELECT `rr_modulecode` FROM `role_rights` WHERE `rr_rolecode` = '$switchid'";

$count = mysqli_num_rows( mysqli_query($con, $sql) );
if ($count > 0 ) {
$query = mysqli_query($con, $sql);
?>

<select name="modulecode" id="modulecode">
	<option value="">Please Select</option>
	<?php while ($rs = mysqli_fetch_array($query, MYSQLI_ASSOC)) { ?>
	<option value="<?php echo $rs["rr_modulecode"]; ?>"><?php echo $rs["rr_modulecode"]; ?></option>
	<?php } ?>
</select>

<?php 
	}

?>
