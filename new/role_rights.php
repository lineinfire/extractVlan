<?php
require_once("config.php");
if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
    // not logged in send to login page
  redirect("index.php");
}
$title = "Dashboard";
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
<style type="text/css">
body {


zoom: 80%;
}

</style>








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

    <form id="bghimire" method="post" action="ajax_rolerights.php"> 
     <div class="container well" style="margin-top: 3.8%; width: 98%; height:auto; background-color: rgba(52,81,107,0.82); color:#c9cbd2; border-color: silver;">
      
        <fieldset>
          <legend><h5>Assign Role and Rights</legend></h5>
        </fieldset>

        <div class="form-group col-md-12">
          <div class="input-group">
            <div class="input-group-addon">
             <span class="glyphicon glyphicon-cog"></span> 
           </div>
           <select class="form-control" placeholder="Switch IP" id="switchid" name="switchid"> <option class="form-control" value="" selected>Please Role Code</option><?php
            mysql_connect('localhost', 'root', '');
            mysql_select_db('multi-admin');
            $sql = "SELECT distinct `rr_rolecode` FROM `role_rights`";
            $result = mysql_query($sql);
            while ($row = mysql_fetch_array($result)) {
              echo "<option value='" . $row['rr_rolecode'] . "'>" . $row['rr_rolecode'] . "</option>";
            }
            echo "</select>";
            ?>
          </div>

        </div>
  
        <div class="form-group col-md-12">
          <div class="input-group">
            <div class="input-group-addon">
             <span class="glyphicon glyphicon-cog"></span> 
           </div>
           <select class="form-control" id="modulecode" required name="modulecode"> 
           </select>
         </div>

       </div>
       <div class="form-group col-md-12">
        <div class="input-group">
          <div class="input-group-addon">
           <span class="glyphicon glyphicon-cog"></span> 
         </div>
         <select class="form-control" id="pageid" required name="pageid"> 
         </select>
       </div>

     </div>
     <hr>
   </legend>





   <br /> <br /> 
   <hr>


   <fieldset>

     <br>
     <br>

   </fieldset>
   <div class="form-group">
    <div class="row" >
     <div class="col-xs-3" id="add">
       <p style="color:#0b1a3f;"><label><u><b>Add Information* </label></p></u></b>

       <input type="radio" name="select1" value="yes"> Yes<br>
       <input type="radio" name="select1" value="no" checked> No<br>
     </div>
     <div class="col-xs-3" id="delete">
       <p style="color:#0b1a3f;"><label><u><b>Delete Information* </label></p></u></b>

       <input type="radio" name="select2" value="yes" > Yes<br>
       <input type="radio" name="select2" value="no" checked> No<br>
     </div>
     <div class="col-xs-3">
      <p style="color:#0b1a3f;"><label><u><b>View Information * </label></p></u></b>
      <div id="view"></div>
      <input type="radio" name="select3" value="yes" > Yes<br>
      <input type="radio" name="select3" value="no" checked> No<br>
    </div>
    <div class="col-xs-3" id="edit">
      <p style="color:#0b1a3f;"><label><u><b>Edit Information* </label></p></u></b>
      <input type="radio" name="select4" value="yes" > Yes<br>
      <input type="radio" name="select4" value="no" checked> No<br>
    </div>

    
    
    


    <style type="text/css">
      #bootstrapSelectForm .selectContainer .form-control-feedback {
        /* Adjust feedback icon position */
        right: -15px;
      }
    </style>


  </legend>
</fieldset>
<br>
<br>
<hr>
<div class="form-group col-md-6">
 <div class="input-group">
  <br>
  <div class="form-group col-md-12">
    <button type="submit" class="btn btn-default" name="btn-login" id="btn-login">
      <span class="glyphicon glyphicon-log-in"></span> &nbsp; Assign Role
    </button> 
    <div id="loader"></div>
  </div> 
</fieldset>

<div id="error" class="form-group col-md-12"> </div>
</div>
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
      
      
      
      switchid: {

        validators: {
          notEmpty: {
            message: 'Module Group  Name is required *'
          },

        }
      },
      select1: {

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
              url: 'ajax_rolerights.php', 
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
                    $("#btn-login").html('</span> <img src="ajax-loader.gif" /> &nbsp; Assigning the role ...');

                  }, 2000);






                setTimeout(
                  function() 
                  {

                    $("#btn-login").html('<img src="ajax-loader.gif" /> &nbsp; Updating the database...');


                  }, 3000);

                $("#btn-login").html('<img src="ajax-loader.gif" /> &nbsp; Connecting to the database ...');

              },




              success: function(response){


                if(response == "Role Assigned Successfully"){
                  setTimeout(function() {
                    response="Role Assigned Successfully";

                    $("#btn-login").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Create User');
                    $("#error").html('<div class="alert alert-success"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');
                  }, 6000);
                }
                
                else if(response == "User Registration Failed")
                {
                  console.log(response);
                  setTimeout(function() {

                    $("#btn-login").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Assgin Role');
                    $("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');
                  }, 6000);
                }












        // put on console what server sent back...
      }
    });
          });
      });
    </script>
    <script>
      $(document).ready(function(){
        $("select#switchid").change(function(){
          var switchid =  $("select#switchid option:selected").attr('value');
        // alert(switchid);
        // 
        if (switchid != '') {
          // var stateOfSelect = $("#state").disabled;
          // alert(stateOfSelect);
          // $("#state").attr('disabled', true).trigger("liszt:updated");
          if ($("#modulecode").is(':disabled'))
            $("#modulecode").prop("disabled", false);
          $("#modulecode").html("");
          $("#pageid").html("");
          $.ajax({
            type: "POST",
            url: "fetch_state.php",
            data: "switchid="+switchid,
            cache: false,
            async:true,
            beforeSend: function () {
              $('#pageid').html('<img src="LoaderIcon.gif" alt="" width="24" height="24">');
            },
            success: function(html) {
              $("#modulecode").html(html);
            }
          });
        }
        else
        {
          $('.form-group').removeClass('has-error has-feedback');
          $('.form-group').removeClass('has-success has-feedback');
          $('.form-control-feedback').removeClass('glyphicon glyphicon-ok');
          $('.form-control-feedback').removeClass('glyphicon glyphicon-remove');
          $('#modulecode').prop('selectedIndex',0);
          // $("#state option:eq(0)").prop("selected", true); //set option of index 0 to selected
          $("#modulecode").prop('disabled', 1);
        }
      });
      });
    </script>
    <script>
      $(document).ready(function(){
        $("select#modulecode").change(function(){
          var modulecode =  $("select#modulecode option:selected").attr('value');
        // alert(switchid);
        // 
        if (modulecode != '') {
          // var stateOfSelect = $("#state").disabled;
          // alert(stateOfSelect);
          // $("#state").attr('disabled', true).trigger("liszt:updated");
          if ($("#pagid").is(':disabled'))
            $("#pageid").prop("disabled", false);
          $("#pageid").html("");
          $("#pageid").html("");
          $.ajax({
            type: "POST",
            url: "fetch_city.php",
            data: "modulecode="+modulecode,
            cache: false,
            async:true,
            beforeSend: function () {
              $('#pageid').html('<img src="LoaderIcon.gif" alt="" width="24" height="24">');
            },
            success: function(html) {
              $("#pageid").html(html);
            }
          });
        }
        else
        {
          $('.form-group').removeClass('has-error has-feedback');
          $('.form-group').removeClass('has-success has-feedback');
          $('.form-control-feedback').removeClass('glyphicon glyphicon-ok');
          $('.form-control-feedback').removeClass('glyphicon glyphicon-remove');
          $('#pageid').prop('selectedIndex',0);
          // $("#state option:eq(0)").prop("selected", true); //set option of index 0 to selected
          $("#pageid").prop('disabled', 1);
        }
      });
      });
    </script>