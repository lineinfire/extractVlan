<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>themelock.com - Chain Responsive Bootstrap3 Admin</title>
 <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href="css/style.default.css" rel="stylesheet">

      <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/css/bootstrapValidator.min.css">

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->
        <style type="text/css">
        .error
{
  color: red;
}
body.signin {
    background-color: #821717;
}
#loading {
    position: fixed;
    width: 100%;
    height: 100%;
    text-align: center;
    vertical-align: middle;
    z-index: 1000;
    top: 0;
    left: 0;
    background: rgba(0,0,0,0.6) url(assets/img/ajax-loader.gif) no-repeat center center;
    overflow: hidden;
}
.panel-signin .panel-body, .panel-signup .panel-body {
    padding: 40px;
    background: #ccc;
}
#msgdiv {
    margin-top: 20px;

}
.alert-primary {
    color: #1b5a1a;
    background-color: #ccc;
    border-color: #ffffff;
}
</style>
    </head>

    <body class="signin">
        
        
        <section>
            
            <div class="panel panel-signin">
                <div class="panel-body">
                    <div class="logo text-center">
                        <img src="images/logo-primary.png" alt="Chain Logo" >
                    </div>
                    <br />
                   
                    <p class="text-center">Please Proceed with Login</p>
                    
                    <div class="mb30"></div>
                    
                    <form id="login" method="post">

                        <div class="input-group mb15">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input type="text" class="form-control" placeholder="Username" id="username" name="username">
                        </div><!-- input-group -->
                        <div class="input-group mb15">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input type="password" class="form-control" placeholder="Password" id="password" name="password">
                        </div><!-- input-group -->
                        
                        <div class="clearfix">
                            <div class="pull-left">
                                <div class="ckbox ckbox-primary mt10">
                                    <input type="checkbox" id="rememberMe" value="1">
                                    <label for="rememberMe">Remember Me</label>
                                </div>
                            </div>
                            <div class="pull-right">
                                <button type="submit" class="btn btn-success" id="signin">Sign In <i class="fa fa-angle-right ml5"></i></button>
                            </div>
                        </div> 
                        <div id="msgdiv"></div>                     
                    </form>
                      <div id="loading" style="display: none;">
    </div>
                </div><!-- panel-body -->
             
            </div><!-- panel -->
            
        </section>


        <script src="js/jquery-1.11.1.min.js"></script>
        <script src="js/jquery-migrate-1.2.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/modernizr.min.js"></script>
        <script src="js/pace.min.js"></script>
        <script src="js/retina.min.js"></script>
        <script src="js/jquery.cookies.js"></script>
            
        <script src="js/custom.js"></script>
        
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.min.js"></script>


    </body>
</html>
 <script type="text/javascript">
      $( document ).ajaxStart(function() {
  $( "#loading" ).show();
      });
           $( document ).ajaxStop(function() {
  $( "#loading" ).hide();
      });
    </script>

<script type="text/javascript">
  $(document).ready(function(){
  $("#signin").click(function(){
$("#login").validate({
      rules:
    {
      username: {
      required: true,
       
      },
      password: {
            required: true,
           
            }
     },
       messages:
     {
            password:{
                      required: "please enter your password"
                     },
            username: "please enter your username",
       },
     submitHandler: submitForm  
       });  

     function submitForm()
     {    
      var data = $("#login").serialize();
        
      $.ajax({
        
      type : 'POST',
      url  : 'login_process.php',
      data : data,
 
  
      success :  function(response)
         {            
     
             if(response == "login success") {

             
            $('#msgdiv').html('<span class="alert alert-primary" role="alert">User Successfully Authenticated</span>');
              setTimeout(' window.location.href = "home.php"; ',1000);

          } else {
              $('#msgdiv').addClass('error').html(response);
              $( "#loading" ).hide();
          }




        }
      });
        return false;
    }
})
})






</script>
