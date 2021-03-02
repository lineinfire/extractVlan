<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<title>Administration</title>

	<!--=== CSS ===-->

	<!-- Bootstrap -->
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

	<!-- Theme -->
	<link href="assets/css/main.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/icons.css" rel="stylesheet" type="text/css" />

	<!-- Login -->
	<link href="css/login.css" rel="stylesheet" type="text/css" />

	<link rel="stylesheet" href="assets/css/fontawesome/font-awesome.min.css">
	<!--[if IE 7]>
		<link rel="stylesheet" href="assets/css/fontawesome/font-awesome-ie7.min.css">
	<![endif]-->

	<!--[if IE 8]>
		<link href="assets/css/ie8.css" rel="stylesheet" type="text/css" />
	<![endif]-->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>

	<!--=== JavaScript ===-->

	<script type="text/javascript" src="assets/js/libs/jquery-1.10.2.min.js"></script>

	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/js/libs/lodash.compat.min.js"></script>

	<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
		<script src="assets/js/libs/html5shiv.js"></script>
	<![endif]-->

	<!-- Beautiful Checkboxes -->
	<script type="text/javascript" src="plugins/uniform/jquery.uniform.min.js"></script>

	<!-- Form Validation -->
	<script type="text/javascript" src="plugins/validation/jquery.validate.min.js"></script>

	<!-- Slim Progress Bars -->
	<script type="text/javascript" src="plugins/nprogress/nprogress.js"></script>

	<!-- App -->
	<script type="text/javascript" src="assets/js/login.js"></script>
	<script src="loadingoverlay.min.js"></script>
        <script src="loadingoverlay_progress.min.js"></script>
	<script>
	$(document).ready(function(){
		"use strict";

		Login.init(); // Init login JavaScript
	});
	</script>
</head>

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
	
	
	<!-- /Footer -->
 
</body>
</html>

<script>



$('document').ready(function()
{ 
     /* validation */
	 $("#login-form").validate({
      rules:
	  {
			newvlan: {
			required: true,
			},
			ipaddress: {
            required: true,
			switchip: {
            required: true,
			},
			
            
            },
	   },
       messages:
	   {
            password:{
                      required: "Please enter your password"
                     },
            switchip: "Please enter your username",
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* login submit */
	   function submitForm()
	   {		
			var data = $("#login-form").serialize();
				
			$.ajax({
				
			type : 'POST',
			url  : 'login_process.php',
			data : data,
			beforeSend: function()
			{	
				$.LoadingOverlay("show");
				$("#btn-login").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; sending ...');
				$.LoadingOverlay("hide");
				$("#error").fadeOut();
				
				
			},
			success :  function(response)
			   {						
					if(response=="ok"){
						$.LoadingOverlay("hide");
					      var progress2 = new LoadingOverlayProgress({
                            bar     : {
                                "background"    : "#62BB46",
								"image" : "loader.gif",
                                "top"           : "180px",
                                "height"        : "15px",
                                "border-radius" : "15px",
								
                            },
                            text    : {
                                "color"         : "#5BCBF5",
                                "font-family"   : "monospace",
                                "top"           : "25px",
								
                            }
                        });
                        $("#login-form").LoadingOverlay("show", {
                            custom  : progress2.Init()
                        });
                        // Simulate some other action:
                        var count2  = 0;
                        var iid2    = setInterval(function(){
                            if (count2 >= 100) {
                                clearInterval(iid2);
                                delete progress2;
                                $("#login-form").LoadingOverlay("hide");
                                return;
                            }
                            count2++;
                            progress2.Update(count2);
                        }, 50);
									
						
						setTimeout(' window.location.href = "home.php"; ',5000);
					}
					
					
					
					
					
					
					else{
									
						$("#error").fadeIn(600, function(){						
				$("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');
											$("#btn-login").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In');
									});
					}
			  }
			});
				return false;
		}
	   /* login submit */
});
</script>


 



