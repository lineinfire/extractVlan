<body class="login">
	<!-- Logo -->
	<div class="logo">
	
		<strong>Adminis</strong>tration
	</div>
	<!-- /Logo -->

	<!-- Login Box -->
	<div class="box">
		<div class="content">
		<form id="login-form" method="post"/>
			<!-- Login Formular -->
			<form class="form-vertical login-form" method="post">
				<!-- Title -->
				<h3 class="form-title">Change Vlan</h3>

				<!-- Error Message -->
				<span id="error" style="display: none;"></span>
					
					
				

				<!-- Input Fields -->
				  <div class="form-group col-md-12">
				  <div style="width:500px; margin: 0 auto; padding:6.5px;">
				  
       <select class="form-control" placeholder="Switch IP" name="switchip" id="switchip"> <option value="" selected>Switch IP</option><?php

mysql_connect('localhost', 'root', '');
mysql_select_db('dbregistration');

$sql = "SELECT ipaddress FROM ipaddress";
$result = mysql_query($sql);


while ($row = mysql_fetch_array($result)) {
    echo "<option value='" . $row['ipaddress'] . "'>" . $row['ipaddress'] . "</option>";
}
echo "</select>";

?></select>
      </div>
				<div class="form-group col-md-12">
				<div style="width:500px; margin: 0 auto; padding:6.5px;">
					<!--<label for="password">Password:</label>-->
					<div class="input-icon">
						
						<input type="text" name="newvlan" class="form-control" placeholder="New Vlan" data-rule-required="true" data-msg-required="Please enter your new vlan." />
					</div>
				</div>
				<div class="form-group col-md-12">
				<div style="width:500px; margin: 0 auto; padding:6.5px;">
					<!--<label for="password">Password:</label>-->
					<div class="input-icon">
						
						<input type="text" name="ipaddress" class="form-control" placeholder="IP Address" data-rule-required="true" data-msg-required="Please enter your IP Address." />
					</div>
				</div>
				
				
				<div class="form-group col-md-12">
				<div style="width:500px; margin: 0 auto; padding:6.5px;">
					<!--<label for="password">Password:</label>-->
					<div class="input-icon">
						
						<input type="text" name="subnet" class="form-control" placeholder="Subnet Mask" data-rule-required="true" data-msg-required="Please enter your subnet mask." />
					</div>
				</div>
				
				
				</div>
				
				
				
				<!-- /Input Fields -->

				<!-- Form Actions -->
				<div class="form-actions">
				<div class="form-group col-md-12">
				<div style="width:500px; margin: 0 auto; padding:6.5px;">
					<button type="submit" id="btn-login" name="btn-login" class="submit btn btn-primary pull-left">
						Submit Query <i class="icon-angle-right"></i>
					</button>
				</div>
			</form>
			<!-- /Login Formular -->

			<!-- Register Formular (hidden by default) -->
			
			<!-- /Register Formular -->
		</div> <!-- /.content -->

		<!-- Forgot Password Form -->
		
		<!-- /Forgot Password Form -->
	</div>
	<!-- /Login Box -->

	<!-- Single-Sign-On (SSO) -->

	<!-- /Single-Sign-On (SSO) -->

	<!-- Footer -->
	
	