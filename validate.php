<!-- <html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Validate IP Address</title>    
</head>
<body>
<form id="form1">
    <input id="ip" name="ip" type="text"  /> 
    <input id="Submit1" type="submit" value="submit" />
 </form>
 <script type="text/javascript"
    src="http://ajax.microsoft.com/ajax/jQuery/jquery-1.4.2.min.js">
    </script>
    <script type="text/javascript" src=
"http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.min.js">
    </script>
    <script type="text/javascript">
        $(function() {
            $.validator.addMethod('IP4Checker', function(value) {
            var ip = "^(?:(?:25[0-5]2[0-4][0-9][01]?[0-9][0-9]?)\.){3}" +
                "(?:25[0-5]2[0-4][0-9][01]?[0-9][0-9]?)$";
                return value.match(ip);
            }, 'Invalid IP address');

            $('#form1').validate({
                rules: {
                    ip: {
                        required: true,
                        IP4Checker: true
                    }
                }
            });

        });
    </script>
</body>
</html> -->
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="contact.css">
<div class="divs">
    <form id="login-form" method="post" action="login-process.php">
        <label for="fname">Switch Location *</label>
        <select placeholder="Switch IP" id="switchid" name="switchid">
            <option value='192.168.7.254' selected="">192.168.7.254</option>
        </select>
        <span id="error"></span>
        <div class="form-group">
            <label for="lname">Vlan ID *</label>
            <input type="text" id="vlanid" min="1" max="254" class="form-control" name="vlanid" value="15">
        </div>
        <div class="form-group">
            <label for="lname">IP Address *</label>
            <input type="text" id="ipaddress" name="ipaddress" class="form-control" value="192.168.1.1">
        </div>
        <div class="form-group">
            <label for="lname">Subnet Mask *</label>
            <input type="text"  maxlength="13" minlength="13" class="form-control" id="subnetmask" name="subnetmask" value="255.255.255.0">
        </div>
        <div class="form-group">
            <button type="submit" name="submitButton" class="btn btn-primary">Submit</button>
        </div>
    </form>
    <!-- /.content -->
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/js/bootstrapValidator.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#login-form').bootstrapValidator({
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
        }) .on('success.form.bv', function(e) {
            debugger;
            $("#login-form").trigger("reset");

            // Prevent form submission
            e.preventDefault();

            // Get the form instance
            var $form = $(e.target);

            // Get the BootstrapValidator instance
            var bv = $form.data('bootstrapValidator');

            jQuery.ajax({
                type: "POST",
                url: $form.attr("action"), 
                data: $form.serialize(), 
                success: function(data) {
                    console.log(data);
                }
            });
        });
    });
</script>