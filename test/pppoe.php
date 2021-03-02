<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="contact.css">

<div class="divs">
<form id="login-form" method="post" action="login-process.php">
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
    <input type="text" id="vlanid" min="1" max="254" class="form-control" name="vlanid">
	</div>
	<div class="form-group">
	<label for="lname">IP Address *</label>
    <input type="text" id="ipaddress" name="ipaddress" class="form-control">
	</div>
	<div class="form-group">
	<label for="lname">Subnet Mask *</label>
    <input type="text"  maxlength="13" minlength="13" class="form-control" id="subnetmask" name="subnetmask">
	</div>

    <div class="form-group">
       
        
    
  
    <input type="submit" value="Submit" name="submit" id="submit">
	</div>

  </form>

  
   
   
   
   
   
   
   
   
    <!-- /.content -->
  </div>
  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/js/bootstrapValidator.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#login-form')
        .bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                ipaddress: {
                    message: 'The username is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The IP Address is required and can\'t be empty'
                        },
                        stringLength: {
                            min: 6,
                            max: 30,
                            message: 'The username must be more than 6 and less than 30 characters long'
                        },
                        /*remote: {
                            url: 'remote.php',
                            message: 'The username is not available'
                        },*/
                        regexp: {
                            regexp: /^[a-zA-Z0-9_\.]+$/,
                            message: 'The username can only consist of alphabetical, number, dot and underscore'
                        }
                    }
                },
                email: {
                    validators: {
                        notEmpty: {
                            message: 'The email address is required and can\'t be empty'
                        },
                        emailAddress: {
                            message: 'The input is not a valid email address'
                        }
                    }
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: 'The password is required and can\'t be empty'
                        }
                    }
                }
            }
        })
        .on('success.form.bv', function(e) {
            // Prevent form submission
            e.preventDefault();
            // Get the form instance
            var $form = $(e.target);
            // Get the BootstrapValidator instance
            var bv = $form.data('bootstrapValidator');
            // Use Ajax to submit form data
            $.post($form.attr('action'), $form.serialize(), function(result) {
                console.log(result);
            }, 'json');
        });
});
</script>