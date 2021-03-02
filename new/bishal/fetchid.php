<div class="form-group col-md-6">
              <div class="input-group right-inner-addon">
                <div class="input-group-addon">
                  <span class="glyphicon glyphicon-cog"></span>
                </div>
<select id="statusid" name="statusid" class="form-control"> 
             

<?php

include("connection.php");
$pageid= trim(mysqli_real_escape_string ($con,$_POST["pageid"]));
 
$sql = "SELECT `Status` FROM `module` WHERE `mod_modulename` = '$pageid'";
$count = mysqli_num_rows( mysqli_query($con, $sql) );
if ($count > 0 ) {
$query = mysqli_query($con, $sql);
?>


	
	<?php while ($rs = mysqli_fetch_array($query, MYSQLI_ASSOC)) { ?>
<option selected="true" disabled="disabled" value="<?php echo $rs["Status"]; ?>"><?php echo $rs["Status"]; ?></option>
	<?php } ?>
</select>

<?php 
	}

?>