
<style>
#error {
	
	color:#dd4b39;
	font-size:11px;
}

.validBorder {
    border-color: #e6e7e8;
    border-width:1px;
    border-style: solid;
}

.invalidBorder {
    border-color: #da1f27;
    border-width:1px;
    border-style: solid;
}




</style>

<link rel="stylesheet" href="contact.css">

<form id="login-form" method="post">
	
    <label for="fname">Switch Location *</label>
    <select placeholder="Switch IP" id="switchid" name="switchid"> <option  value="" selected>Please Select Switch IP</option><?php

mysql_connect('localhost', 'root', '');
mysql_select_db('dbregistration');

$sql = "SELECT ipaddress FROM ipaddress";
$result = mysql_query($sql);


while ($row = mysql_fetch_array($result)) {
    echo "<option value='" . $row['ipaddress'] . "'>" . $row['ipaddress'] . "</option>";
}
echo "</select>";

?></select>
<span id="error"></span>
	<div class="form-group">
    <label for="lname">Vlan ID *</label>
    <input type="text" id="vlanid" class="form-control" name="vlanid" ><span id="user-availability-status"></span> 
	<p><img src="LoaderIcon.gif" id="loaderIcon" style="display:none" /></p>
	</div>
	<div class="form-group">
	<label for="lname">IP Address *</label>
    <input type="text" id="ipaddress" name="ipaddress" class="form-control" data-fv-ip="true" data-fv-ip-message="Please enter a valid IP address" data-fv-notempty="true" data-fv-notempty-message="Please enter the valid IP Address">
	</div>
	<div class="form-group">
	<label for="lname">Subnet Mask *</label>
    <input type="text"  maxlength="13" minlength="13" class="form-control" id="subnetmask" name="subnetmask" data-fv-notempty="true" data-fv-notempty-message="Please enter the valid Subnet Mask">
	</div>

   
        
    
  
    <input type="submit" value="Submit" name="submit" id="submit">
	</div>

  </form>
  <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.min.js"></script>
<script="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/js/bootstrapValidator.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
  
  <script>
            $(document).ready(function(){

                $("#switchid").change(function(){
					

                    var mobile = $("#switchid").val().trim();

					

                    if(mobile != ''){

                        $("#uname_response").show();

                        $.ajax({
                            url: 'validity/mobile-check.php',
                            type: 'post',
                            data: {mobile:mobile},
                            success: function(response){

                                if(response > 0){
									
								$("#uname_response").animate({ top: "-=30px", width: "100%" }, 1000);
                                    $("#uname_response").html('<h4 ><span class="label label-info" type="notify" ID="filter">Mobile number exists in database</span></h4>');

                                 $('#uname_response').delay(1000).fadeOut('slow');

								e.preventDefault();


                                }else{
                                    $("#uname_response").animate({ top: "-=30px", width: "100%" }, 1000);
                                    
$("#uname_response").html('<h4 ><span class="label label-success" ID="filter">Validation successful</span></h4>');

                                }

                            }
                        });
                    }else{
                        $("#uname_response").hide();
                    }

                });

            });
				
			
        </script>