<!DOCTYPE html>
<html lang="en">
<head>
<style type="text/css">
	
small.help-block {
    display: block;
    margin-top: 5px;
    margin-bottom: 10px;
    color: #e40d0d;
    display: block;
}


</style>


	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Administration :: Sign in</title>
	
	<link rel="icon" sizes="192x192" href="img/touch-icon.png" /> 
	<link rel="apple-touch-icon" href="img/touch-icon-iphone.png" /> 
	<link rel="apple-touch-icon" sizes="76x76" href="img/touch-icon-ipad.png" /> 
	<link rel="apple-touch-icon" sizes="120x120" href="img/touch-icon-iphone-retina.png" />
	<link rel="apple-touch-icon" sizes="152x152" href="img/touch-icon-ipad-retina.png" />
	
	<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico" />

	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/main.min.css">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	
</head>
<body>
	<div id="loading">
		<div class="loader loader-light loader-large"></div>
	</div>

	
				<div id="small.help-block"> </div>
				
					<div>
					<form id="register-form" method="post">
					<div class="col-md-4  col-md-offset-4">
					<small class="help-block" data-bv-validator="notEmpty" data-bv-for="username" data-bv-result="INVALID" style="">Username is required *</small>
						<article class="widget widget__login">

							<header class="widget__header one-btn">
								<div class="widget__title">
									<div class="main-logo"></div> Admin Access.
								</div>
								<div class="widget__config">
									<a href="#" onclick="window.location.href = 'login.php'"><i class="pe-7s-help1"></i></a>
								</div>
							</header>

							<div class="widget__content">
								<input type="text" placeholder="Username" id="username" name="username">

								<input type="password" placeholder="Password" id="password" name="password">
								<button type="submit" id="submit"  >Sign in</button>
							</div>
							<div class="login__remember text-center">
								<input type="checkbox" class="custom-checkbox" id="cc1" checked>
								<label for="cc1"></label>
								Remember me
							</div>
						</article><!-- /widget -->
					</div>
				</div>
</form>


	 
	<script type="text/javascript" src="js/main.js"></script>
	
</body>
</html>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.min.js"></script>
<script src ="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/js/bootstrapValidator.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script type="text/javascript">

$(document).ready(function() {
$('#register-form').bootstrapValidator({
      
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'fa fa-refresh fa-spin'
            },
            fields: {
                 modulegroupcode: {
                
                validators: {
          notEmpty: {
                            message: 'Module Group Code is required'
                        },
                        regexp: {
                            regexp: '[A-Z]+',
                            message: 'The value is not a valid module group code'
                            
                        },

                }
            },
			
			
			
			   username: {
                
                validators: {
          notEmpty: {
                            message: 'Username is required *'
                        },
    
                }
            },


             password: {
                
                validators: {
          notEmpty: {
                            message: 'Module Name is required *'
                        },
    
                }
            },
			
			
			
			
			
			
			
			
			
			
			
			
			
			
              
        modulecode: {
                
                validators: {
          notEmpty: {
                            message: 'Module Code is required'
                        },
    
                }
            },
        







 modulegrouporder: {
                
                validators: {
          notEmpty: {
                            message: 'Module Group  order is required *'
                        },
    
                }
            },




 moduleorder: {
                
                validators: {
          notEmpty: {
                            message: 'Module order is required *'
                        },
    
                }
            },






 password: {
                
                validators: {
          notEmpty: {
                            message: 'Module Page Name is required *'
                        },
    
                }
            },



 status: {
                
                validators: {
          notEmpty: {
                            message: 'Activation Status is required *'
                        },
    
                }
            },












        /*
      email: {
                
                validators: {
				notEmpty: {
				message: 'The email ID required'
                        },
						  stringLength: {
								min: 10,
								max: 200,
								message:'Please enter the vlaue between 10 to 200'
							},

                remote: {
              
              message: 'The email ID already exists..',
              url: 'emailcheck.php',
              type: 'POST',
              async: true,
              
                 
              
              
                
          
            },
    
                }
            },
			*/
			
      
      
            }
        }) .on('success.form.bv', function(e) {
           
      
           

            // Prevent form submission
            e.preventDefault();

            // Get the form instance
            var $form = $(e.target);

            // Get the BootstrapValidator instance
            var bv = $form.data('bootstrapValidator');
			
            jQuery.ajax({
                type: "POST",
                url: 'login-process.php', 
                data: $("#register-form").serialize(), 
                timeout: 7000,
				beforeSend: function()
			{	
				
				
				
				setTimeout(
				function() 
				{
				$("#btn-login").html('</span> <img src="ajax-loader.gif" /> &nbsp; Connected to the database ...');
				
				}, 1000)
				
				setTimeout(
				function() 
				{
				$("#btn-login").html('</span> <img src="ajax-loader.gif" /> &nbsp; Creating the user ...');
				
				}, 2000);
				
				
			
			
			
			
				setTimeout(
				function() 
				{
					
				$("#btn-login").html('<img src="ajax-loader.gif" /> &nbsp; Updating the database...');
			
				
				}, 3000);
				
				$("#btn-login").html('<img src="ajax-loader.gif" /> &nbsp; Connecting to the database ...');
				
			},
        
        
        
        
          success: function(response){
        
		
                if(response == "Successful"){
                setTimeout(function() {


                  response="Module creation was Successful";
				  
                  $("#btn-login").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Create User');
                  $("#error").html('<div class="alert alert-success"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');



                }, 6000);




                                }
                
                else if(response == "User Registration Failed")
				{
					console.log(response);
					                setTimeout(function() {


                  
                  $("#btn-login").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Create User');
                  $("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');



                }, 6000);

                                }
    
    
    
    
    
    
    
    
    
    
    
    
        // put on console what server sent back...
    }
            });
        });
    });

</script>





<script type="text/javascript">
	
$(document).ready(function(){

$('#submit').click(function(){

("#loading").fadeout();






});




});


</script>



