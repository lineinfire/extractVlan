<?php

include("connection.php");

 $modulecode = trim($_POST["modulecode"]);




$sql = "SELECT `mod_modulecode` FROM `module` WHERE `mod_modulegroupcode` = '$modulecode'";

$count = mysqli_num_rows( mysqli_query($con, $sql) );
if ($count > 0 ) {
$query = mysqli_query($con, $sql);
?>

<select name="pageid" id="pageid">
	<option value="">Please Select</option>
	<?php while ($rs = mysqli_fetch_array($query, MYSQLI_ASSOC)) { ?>
	<option value="<?php echo $rs["mod_modulecode"]; ?>"><?php echo $rs["mod_modulecode"]; ?></option>
	<?php } ?>
</select>

<?php 
	}

?>

