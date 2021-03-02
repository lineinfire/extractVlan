<?php

require_once("config.php");
if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
    // not logged in send to login page
    redirect("index.php");
}

// set page title
$title = "Dashboard";

// if the rights are not set then add them in the current session
if (!isset($_SESSION["access"])) {

    try {

        $sql = "SELECT mod_modulegroupcode, mod_modulegroupname FROM module "
                . " WHERE 1 GROUP BY `mod_modulegroupcode` "
                . " ORDER BY `mod_modulegrouporder` ASC, `mod_moduleorder` ASC  ";


        $stmt = $DB->prepare($sql);
        $stmt->execute();
        $commonModules = $stmt->fetchAll();

        $sql = "SELECT mod_modulegroupcode, mod_modulegroupname, mod_modulepagename,  mod_modulecode, mod_modulename FROM module "
                . " WHERE 1 "
                . " ORDER BY `mod_modulegrouporder` ASC, `mod_moduleorder` ASC  ";

        $stmt = $DB->prepare($sql);
        $stmt->execute();
        $allModules = $stmt->fetchAll();

        $sql = "SELECT rr_modulecode, rr_create,  rr_edit, rr_delete, rr_view FROM role_rights "
                . " WHERE  rr_rolecode = :rc "
                . " ORDER BY `rr_modulecode` ASC  ";

        $stmt = $DB->prepare($sql);
        $stmt->bindValue(":rc", $_SESSION["rolecode"]);
        
        
        $stmt->execute();
        $userRights = $stmt->fetchAll();

        $_SESSION["access"] = set_rights($allModules, $userRights, $commonModules);

    } catch (Exception $ex) {

        echo $ex->getMessage();
    }
}

$stmt = $DB->prepare("SELECT * FROM system_users WHERE u_userid=:uid");
$stmt->execute(array(":uid"=>$_SESSION['user_id']));
$row=$stmt->fetch(PDO::FETCH_ASSOC);



?>


<?php
    require 'database.php';
 
    $u_userid = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: edit_user.php");
    }
     
    if ( !empty($_POST)) {
        // keep track validation errors
        $nameError = null;
        $emailError = null;
        $u_usernameError = null;
        $u_passwordError = null;
         
        // keep track post values
        $name = $_POST['name'];
        $email = $_POST['email'];
        $u_username = $_POST['u_username'];
         $u_password = $_POST['u_password'];
         
        // validate input
        $valid = true;
        if (empty($name)) {
            $nameError = 'Please enter Name';
            $valid = false;
        }
         
        if (empty($email)) {
            $emailError = 'Please enter Email Address';
            $valid = false;
        } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
            $emailError = 'Please enter a valid Email Address';
            $valid = false;
        }
         
        if (empty($u_username)) {
            $u_usernameError = 'Please enter username';
            $valid = false;
        }
        if (empty($u_password)) {
            $u_passwordError = 'Please enter password';
            $valid = false;
        }
         
        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE system_users  set name = ?, email = ?, u_username =?, u_password = ? WHERE u_userid = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($name,$email,$username,$password,$id));
            Database::disconnect();
            header("Location: html.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM system_users where u_userid = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $name = $data['name'];
        $email = $data['email'];
        $u_username = $data['u_username'];
        $u_password = $data['u_password'];
        Database::disconnect();
    }
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    
    <link rel="icon" sizes="192x192" href="img/touch-icon.png" /> 
    <link rel="apple-touch-icon" href="img/touch-icon-iphone.png" /> 
    <link rel="apple-touch-icon" sizes="76x76" href="img/touch-icon-ipad.png" /> 
    <link rel="apple-touch-icon" sizes="120x120" href="img/touch-icon-iphone-retina.png" />
    <link rel="apple-touch-icon" sizes="152x152" href="img/touch-icon-ipad-retina.png" />
    
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico" />

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/main.min.css">
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
    <div id="loading">
        <div class="loader loader-light loader-large"></div>
    </div>
    <header class="top-bar">
        
        <ul class="profile"> 
            <li>
                <a href="#" class="btn-circle no-circle">
                    <i class="pe-7f-back"></i>
                </a>
            </li>
            <li>
                <a href="#" onclick="return false;" class="btn-circle btn-sm">
                    <i class="pe-7f-mail"></i>
                    <span class="badge badge--blue">8</span>
                </a>
            </li>
            <li>
                <a href="#" onclick="return false;" class="btn-circle btn-sm">
                    <i class="pe-7g-sets"></i>
                </a>
            </li>
            <li>
                <a href="#" onclick="return false;" class="btn-circle btn-sm active">
                    <i class="pe-7g-user"></i>
                </a>
            </li>
            <li class="mobile-nav">
                <a href="#" onclick="return false;" class="btn-circle btn-sm">
                    <i class="pe-7f-menu"></i>
                </a>
            </li>
        </ul>

        <div class="main-search">
            <input type="text" placeholder="Search ..." id="msearch">
            <label for="msearch">
                <i class="pe-7s-search"></i>
            </label>
            <button>
                <i class="pe-7g-arrow-circled pe-rotate-90"></i>
            </button>
        </div>
        
        <div class="main-brand">
            <div class="main-brand__container">
                <div class="main-logo"><img src="#"></div>
                <input type="checkbox" id="s-logo" class="sw" />
                <label class="swtc swtc--dark swtc--header" for="s-logo"></label> 
            </div>
        </div>
        
    </header> <!-- /top-bar -->


    <div class="wrapper">

        
            
    <aside class="sidebar">
            
            <div class="user-info">
                    <figure class="rounded-image profile__img">
                        <img class="media-object" src="img/profile.jpg" alt="user">
                    </figure>
                    <h2 class="user-info__name">Marian Lewis</h2>
                    <h3 class="user-info__role">Admin Manager</h3>
                    <ul class="user-info__numbers">
                        
                        
                        
                    </ul>
                </div> 

                <ul class="main-nav">
                    <?php foreach ($_SESSION["access"] as $key => $access) { ?>
                

                    <li class="main-nav--collapsible">
                        <a class="main-nav__link" href="#" >
                            <span class="main-nav__icon"><i class="pe-7f-monitor"></i></span>
                            <?php echo $access["top_menu_name"]; ?><span class="badge badge--line badge--blue">2</span>
                        </a>
                        <?php

                        echo '<ul class="main-nav__submenu">';
                         foreach ($access as $k => $val) {
                            if ($k != "top_menu_name") {
                                echo '<li><a href="' . ($val["page_name"]) . '">' . $val["menu_name"] . '</a></li>';
                                ?>
                                <?php
                            }
                        }
                        echo '</ul>';
                        ?>
                    </li>
                    <?php
                }
                ?>
                            









                
                </ul> <!-- /main-nav -->
            
        </aside> <!-- /sidebar -->
        
        <section class="content">
<!-- /main-header -->

    <!-- row -->

                <!-- row -->

 <!-- /row -->


                <div class="row">
                    
                    <div class="col-md-6">
                        <article class="widget">
                    
                            
                            <div class="widget__content">
                                <div class="tabs">
                                    <input type="radio" id="tab1" name="msgs_tabs" checked>
                                    
                                    <div class="clearfix"></div>
                                    
                                    <div class="tabs__content">
                                        
                                     <!-- /tabscontent1 -->


                                        
                            <!-- /tabscontent2 -->

<!-- /tabscontent3 -->
                                    </div> 
                                
                                </div> <!-- /tabs -->
                                

                                
                            </div> <!-- /widget__content -->

                        </article><!-- /widget -->
                    </div>

<style type="text/css">
    



.form-control {
    display: block;
    width: 100%;
    height: 34px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: rgba(201,203,210,1);
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
}


.btn-default {

    background-color: #758cac;
}

.has-error .checkbox, .has-error .checkbox-inline, .has-error .control-label, .has-error .help-block, .has-error .radio, .has-error .radio-inline, .has-error.checkbox label, .has-error.checkbox-inline label, .has-error.radio label, .has-error.radio-inline label {
    color: rgb(177, 19, 19);
    text-decoration-color: silver;
    background-color: silver;
    text-align: center;
    overflow: auto;
    width: auto;
    display: block;
}


</style>



                    
                    <form id="bghimire" action="update.php?id=<?php echo $id?>" method="post"> 

                    <div class="container well" style="margin-top: 1%; width: 100%; height:auto; background-color: rgba(74,89,122,0); border-color: silver;">
 
      <fieldset>
        <legend><h5>Module Information</legend></h5>
      </fieldset>
      

      <div class="form-group col-md-12">
      <div class="input-group">
    <div class="input-group-addon">
     <span class="glyphicon glyphicon-cog"></span> 
    </div>
        <input class="form-control" name="name"  class="stacked-input"  placeholder="Please enter your name" type="text" value="<?php echo !empty($name)?$name:'';?>">
      </div>
      </div>
      <div class="form-group col-md-6" <?php echo !empty($emailError)?'error':'';?>">
       <div class="input-group">
      <div class="input-group-addon">
     <span class="glyphicon glyphicon-cog"></span>
    </div>
    <input class="form-control" name="email"  class="stacked-input"  placeholder="Please enter your email" type="text" value="<?php echo !empty($email)?$email:'';?>">
      </div>
      </div>
      
      
      
      <div class="form-group col-md-6">
         <div class="input-group">
      <div class="input-group-addon">
     <span class="glyphicon glyphicon-cog"></span>
    </div>
        <input class="form-control" name="u_username"  class="stacked-input" placeholder="Please enter your username" type="text" value="<?php echo !empty($u_username)?$u_username:'';?>">
      </div>
      </div>
      
      
      <div class="form-group col-md-12">
      <div class="input-group">
      <div class="input-group-addon">
     <span class="glyphicon glyphicon-user" ></span>
      </div>
        <input class="form-control" name="u_password" class="stacked-input"  placeholder="Please enter your password" type="text" value="<?php echo !empty($u_password)?$u_password:'';?>">
      </div>
      </div>
      
      
      
      
      
      
     
   
      
      
      
      

        
     

    



<style type="text/css">
#bootstrapSelectForm .selectContainer .form-control-feedback {
    /* Adjust feedback icon position */
    right: -15px;
}
</style>


     

     

     

     
        
            <div class="form-group col-md-12">
            <button type="submit" class="btn btn-default" name="btn-login" id="btn-login">
            <span class="glyphicon glyphicon-log-in"></span> &nbsp; Create Module
            </button> 
            <div id="loader"></div>
            </div>  
        
         <div id="error" class="form-group col-md-12"> </div>
         <img src="loader.gif" id="gif" style="display: block; margin: 0 auto; width: 100px; visibility: hidden;">
      </div>
</div>
</div>
</form>



                </div> <!-- /row -->

<!-- /row -->


<!-- /row -->





        </section> <!-- /content -->

    </div>


     
    <script type="text/javascript" src="js/main.js"></script>
    
</body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.min.js"></script>
<script src ="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/js/bootstrapValidator.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script type="text/javascript">

$(document).ready(function() {
$('#bghimire').bootstrapValidator({
      
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
            
            
            
               modulegroupname: {
                
                validators: {
          notEmpty: {
                            message: 'Module Group  Name is required *'
                        },
    
                }
            },


             modulename: {
                
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






 modulepagename: {
                
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
                url: 'ajaxcreatemodule.php', 
                data: $("#bghimire").serialize(), 
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
