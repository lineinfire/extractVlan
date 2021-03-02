<?php
	include 'connection.php';
	$conn = OpenCon();

	foreach ($_POST as $key => $val) 
	{
		$val = preg_replace("/^\r\n+/","",$val);
		$val = str_replace('\"','"',$val);
		$$key = str_replace("\'","'",$val);
	}
	if (isset($save)) {
		$insertEmployee = "CALL insertEmployeeDetails('$fullname','$address','$mobile','$email','$extension','$department','$computerIp','$computerMAC','$computerSwitch','$phoneIp','$phoneMAC','$phoneSwitch')";

		if ($conn->query($insertEmployee) === TRUE) {
			echo "New Employee created successfully.";
		} 
		else 
		{
    		echo "Employee Insert Error";
		}
	}
		
?>
<style>
	legend {
		font-weight: bold;
		font-size: 14px;
	}
</style>

<form method="post"> 
	<fieldset>
    <legend>Employee Details:</legend>

		<label id="first">Name:</label><br/>
		<input type="text" name="fullname"><br/>

		<label id="first">Address</label><br/>
		<input type="text" name="address"><br/>

		<label id="first">Email</label><br/>
		<input type="text" name="email"><br/>

		<label id="Mobile">Mobile</label><br/>
		<input type="text" name="mobile"><br/>

		<label id="extension">Extension</label><br/>
		<input type="text" name="extension" size=4><br/>

		<label id="department">Department</label><br/>
		<select name="department">
		<?php
			$deptSql = "select * from tbl_dept order by d_name asc";
			$result = $conn->query($deptSql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
		?>		
		  	<option value="<?=$row['d_id']?>"><?=$row['d_name']?></option>		
		<?php } } ?>
		</select>
	</fieldset>
	<br />
	<fieldset>
    <legend>Computer Details:</legend>

		<label id="first">Computer IP:</label><br/>
		<input type="text" name="computerIp"><br/>

		<label id="first">Computer MAC</label><br/>
		<input type="text" name="computerMAC"><br/>

		<label id="first">Computer Switch IP</label><br/>
		<select name="computerSwitch">
		<?php
			$switchSql = "select * from tbl_switch order by s_ip asc";
			$result = $conn->query($switchSql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
		?>		
		  	<option value="<?=$row['s_id']?>"><?=$row['s_ip']?></option>		
		<?php } } ?>
		</select>
	</fieldset>
	<br />

	<fieldset>
    <legend>Phone Details:</legend>

		<label id="first">Phone IP:</label><br/>
		<input type="text" name="phoneIp"><br/>

		<label id="first">Phone MAC</label><br/>
		<input type="text" name="phoneMAC"><br/>

		<label id="first">Phone Switch IP</label><br/>
		<select name="phoneSwitch">
		<?php
			$switchSql = "select * from tbl_switch order by s_ip asc";
			$result = $conn->query($switchSql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
		?>		
		  	<option value="<?=$row['s_id']?>"><?=$row['s_ip']?></option>		
		<?php } } ?>
		</select>
	</fieldset>
	<br />
	<button type="submit" name="save">save</button>
</form>
	
<?php
	CloseCon($conn);
?>