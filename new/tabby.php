<?php

require("config.php");
require_once("connection.php");
if (!isset($_SESSION["user_id"]) && !isset($_SESSION["rolecode"]) && !isset($_SESSION["username"]) || $_SESSION["user_id"] == "") {
    // not logged in send to login page
    redirect("index.php");
}



$status = FALSE;
if ( authorize($_SESSION["access"]["CHECKOUT"]["SHIPPING"]["create"]) || 
authorize($_SESSION["access"]["EMPMGMT"]["ADD EMPLOYEE"]["edit"]) || 
authorize($_SESSION["access"]["EMPMGMT"]["ADD EMPLOYEE"]["view"]) || 
authorize($_SESSION["access"]["EMPMGMT"]["ADD EMPLOYEE"]["delete"]) ) {
 $status = TRUE;
}

if ($status === FALSE) {
die("You dont have the permission to access this page");
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




}
.has-success .form-control {
    border-color: #153515;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
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
  <link rel="stylesheet" href="css/floraforms.css">
  <link rel="stylesheet" href="css/msgBoxLight.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
  
    <link rel="stylesheet" href="ui/jquery-ui.css" />
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <!-- Optional theme -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script type='text/javascript' src='js/jquery.msgBox.js'></script>
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




      .help-block {
    display: block;
    margin-top: 5px;
    margin-bottom: 10px;
    color: #d0e036;
}











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

            
   
        

        <div class="flora-wrap"  >
          <form method="post" action="#" class="floraforms" id="floraforms">
              <div class="flora-container wrap3" style="background-color: #6b7c94;">
                  <div class="frm-header" style="background-color: #6b7c94;">
                      <h4 style="color: silver;">Employee Registration</h4>
                    </div><!-- end .frm-header section -->
                    <div class="frm-body">
                    
                        <div class="frm-row">
                            <div class="elem-group colm colm6">
                                <label class="field">
                                    <input type="text" name="name" id="name" class="flo-input form-control" placeholder="Employee name">
                                </label>                            
                            </div><!-- end .colm .elem-group section -->
                            <div class="elem-group colm colm6">
                                <label class="field">
                                    <input type="text" name="address" id="address" class="flo-input form-control" placeholder="Address">
                                </label>                            
                            </div><!-- end .colm .elem-group section -->
                        </div><!-- end .frm-row section -->
                        
                        <div class="frm-row">
                            <div class="elem-group colm colm6">
                                <label class="field">
                                    <input type="email" name="email" id="email" class="flo-input form-control" placeholder="Email address">
                                </label>                            
                            </div><!-- end .colm .elem-group section -->
                            <div class="elem-group colm colm6">
                                <label class="field">
                                    <input type="text" name="telephone" id="telephone" class="flo-input form-control" placeholder="Telephone number">
                                </label>                            
                            </div><!-- end .colm .elem-group section -->
                        </div><!-- end .frm-row section -->                        
                        
                        <div class="frm-row">
                            <div class="elem-group colm colm6">
                                <label class="field">
                                    <input type="text" name="extension" id="extension" class="flo-input form-control" placeholder="Extension no">
                                </label>                            
                            </div><!-- end .colm .elem-group section -->
                            <div class="elem-group colm colm6">
                                <label class="field flo-select">
                                    <select name="department" id="department" class="form-control">
                                        <option value=""> Select department </option>
                                        <option value="Technical">Technical</option>
                                        <option value="Marketing">Operation &amp; Support</option>
                                        <option value="Business Development">Business Development</option>
                                        <option value="General">Account</option>
                                    </select>
                                    <i class="arrow double"></i>                             
                                </label>                             
                            </div><!-- end .colm .elem-group section -->
                        
               
              
              
              
             
        </div><!-- end .frm-row section -->
        <div class="frm-row">
         <div class="elem-group colm colm6">
                                <label class="field flo-select">
                                    <select name="switchip" id="switchip" class="form-control">
                                        <option value=""> Select switch  location </option>
                                        <?php

                @mysql_connect('localhost', 'root', '');
                mysql_select_db('multi-admin');

$sql = "SELECT switchlocation FROM empinfo";
$result = mysql_query($sql);


while ($row = mysql_fetch_array($result)) {
    echo "<option value='" . $row['switchlocation'] . "'>" . $row['switchlocation'] . "</option>";
}
echo "</select>";

?>
                                    </select>
                                    <i class="arrow double"></i>                             
                                </label>                             
                            </div>
               <div class="elem-group colm colm6">
                                <label class="field">
                                    <input type="text" name="portid" id="portid" class="flo-input form-control" placeholder="Port ID">
                                </label>                            
                            </div><!-- end .colm .elem-group section -->
          </div>
                <div class="frm-row">
                            <div class="elem-group colm colm6">
                                <label class="field">
                                    <input type="text" name="vlanid" id="vlanid" placeholder="Enter Vlan ID" class="flo-input form-control" list="port" />
                    <datalist id="vlanid">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>17</option>
                    <option>11</option>
                    <option>24</option>
                    <option>35</option>
                    <option>69</option>
                      </datalist>

                                </label>                            
                            </div><!-- end .colm .elem-group section -->
                  <div class="frm-row">
                            <div class="elem-group colm colm6">
                                <label class="field">
                                    <input type="text" name="macid" id="macid" class="flo-input form-control" placeholder="Mac ID">
                                </label>                            
                            </div><!-- end .colm .elem-group section -->
                           
                        </div><!-- end .frm-row section -->  
                               
                           
                           
                        
                           
                        </div><!-- end .frm-row section -->   

                     
            
                <div class="frm-row">
                            <div class="elem-group colm colm6">
                                <label class="field">
                                    <input type="text" name="ipaddress" id="ipaddress" class="flo-input form-control" placeholder="IP Address">
                                </label>                            
                            </div><!-- end .colm .elem-group section -->
                                <div class="frm-row">
                            <div class="elem-group colm colm6">
                                <label class="field">

                                     <input class="flo-input form-control" placeholder="mm/dd/yy" id="date" value="" />
                                </label>                            
                            </div><!-- end .colm .elem-group section -->
                           
                        </div><!-- end .frm-row section -->
                           
                        </div><!-- end .frm-row section -->  
                            
            
              
                        <div class="elem-group">
                            <label class="field">
                                <textarea class="flo-textarea form-control" name="message" id="message" placeholder="Enter message or comment"></textarea>
                                <span class="flo-hint"><strong>Hint:</strong> Don't be negative or off topic</span>   
                            </label>
                        </div><!-- end .elem-group section -->
                        
                       
                                                
                        <div class="response"></div><!-- end .response  section -->  
                        
                    </div><!-- end .frm-body section -->
                    <div class="frm-footer">
                      <button type="reset" class="flo-button">Cancel</button>
                        <button type="submit" id="submit" name="submit" data-btntext-sending="Sending..." class="flo-button btn-themed">Submit Form</button>
                    </div><!-- end .frm-footer section -->
                </div><!-- end .flora-container section -->
            </form>
                </div>
            </section>
            <!-- :form -->
        </div><!-- end .flora-wrap section -->
     
   
  

    
    
    


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

<div class="form-group col-md-6">
 <div class="input-group">
  <br>
  
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
<script type='text/javascript' src='js/jquery.msgBox.js'></script>

<script type="text/javascript">
$(document).ready(function() {
  $(".msgBox").position({

my: "center",
at:"center",
of:window


});
});
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#floraforms').bootstrapValidator({

      message: 'This value is not valid',
      feedbackIcons: {
        valid: 'glyphicon glyphicon-ok',
        invalid: 'glyphicon glyphicon-remove',
        validating: 'fa fa-refresh fa-spin'
      },
      fields: {
       name: {
         group: '.elem-group',
        validators: {
          notEmpty: {
            message: 'Employee Name is required'
          },
         
        }
      },
      
      
      
      address: {
        group: '.elem-group',
        validators: {
          notEmpty: {
            message: 'Employee Address is required *'
          },

        }
      },

       message: {
        group: '.elem-group',
        validators: {
          notEmpty: {
            message: 'message is required *'
          },

        }
      },










      email: {
        group: '.elem-group',
        validators: {
          notEmpty: {
            message: 'Email id is required *'
          },

              regexp: {
                            regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                            message: 'The value is not a valid email address'
                        },
                        remote: {
              
              message: 'The email id is already registered..',
              url: 'emailcheck.php',
              type: 'POST',
              async: true,
              delay:1000,
              onkeyup: false,
              dataType: "json",
              mode:"abort",
              contentType: "application/json; charset=utf-8",   
              
              
                
          
            },

        }
      },
      
      
      
      
      
      
      
      
      
      
      
      
      
      

     telephone: {
      group: '.elem-group',
        validators: {
          notEmpty: {
            message: 'contact number is required'
          },

        }
      },


       extension: {
      group: '.elem-group',
        validators: {
          notEmpty: {
            message: 'extension number is required'
          },

        }
      },

      department: {
        group: '.elem-group',

        validators: {
          notEmpty: {
            message: 'Please select department *'
          },

        }
      },

 vlanid: {
        group: '.elem-group',

        validators: {
          notEmpty: {
            message: 'Please enter the vlanid *'
          },

        }
      },


      switchip: {
        group: '.elem-group',

        validators: {
          notEmpty: {
            message: 'Please select the switch location *'
          },
          

        }
      },





      macid: {
        group: '.elem-group',
        validators: {
          notEmpty: {
            message: 'Mac id is required *'
          },

              regexp: {
                           regexp: /^([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})$/,
                            message: 'The value is not a valid mac address'
                        },
                        remote: {
              
              message: 'The mac id is already registered..',
              url: 'maccheck.php',
              type: 'POST',
              async: true,
              delay:1000,
              onkeyup: false,
              dataType: "json",
              mode:"abort",   
              
              
                
          
            },

        }
      },



 ipaddress: {
        group: '.elem-group',
        validators: {
          notEmpty: {
            message: 'Ip address is required *'
          },

              regexp: {
regexp: /^(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/,
                            message: 'The value is not a valid ip address'
                        },
                        remote: {
              
              message: 'The ip address is already registered..',
              url: 'ipcheck.php',
              type: 'POST',
              async: true,
              delay:1000,
              onkeyup: false,
              dataType: "json",
              mode:"abort",
                 
              
              
                
          
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
      portid: {
        group: '.elem-group',
        validators: {
          notEmpty: {
            message: 'Port id is required *'
          },
          regexp: {
               regexp: /^(2[0-4]|1[0-9]|[1-9])$/,

                message:'Please enter the vlaue between 1 to 24'
              },
              remote: {
             message: 'The port id is already assigned..',
            url: 'checkport.php',
              type: 'POST',
              async: true,
              delay:1000,
              onkeyup: false,
              dataType: "json",
              mode:"abort",
               data: {
              switchip: function() { return $("#switchip").val() }
        }
                 
              
              
                
          
            },

        }
      },
      vlanid: {
        group: '.elem-group',
        validators: {
          notEmpty: {
            message: 'Vlan id is required *'
          },
          regexp: {
               regexp: /^([1-9]{1,2}){1}(\.[0-9]{1,2})?$/,

                message:'Please enter the vlaue between 10 to 200'
              },
        }
      },

      














          }
        }) .on('success.form.bv', function(e) {


            $.msgBox({
title: "Are You Sure",
content: "Would you like a cup of coffee?",
type: "confirm",
position: {
 my: "center bottom",
 at: "center top",
 of: $("#submit")
},
buttons: [{ value: "Yes" }, { value: "No" }, { value: "Cancel"}],
success: function (result) {
if (result == "Yes") {

            // Prevent form submission
            e.preventDefault();
            // Get the form instance
            var $form = $(e.target);
            // Get the BootstrapValidator instance
            var bv = $form.data('bootstrapValidator');

            jQuery.ajax({
              type: "POST", 
              url: 'forminsert.php', 
              data: $('#floraforms').serialize(),
                success: function(response){

                $("#submit").click(function(){

                  $("#bghimire")[0].reset();


                });
                if(response == "success"){
            
                }
                
                else if(response == "MAC Registration Failed")
                {
                  
                 
                }

      }
    });
                

 
}
}
});


                 


          });
      });
    </script>


<script type="text/javascript">


/*
position: {
 my: "center bottom",
 at: "center top",
 of: $("#submitbutton"),
 within: $(".content")
}
*/

</script>




















    <script>
      $(document).ready(function(){
        $("#port").change(function(){
          var switchid =  $("select#switchid option:selected").attr('value');
		 
		  
          
        // 
        if (switchid != '') {
          // var stateOfSelect = $("#state").disabled;
          // alert(stateOfSelect);
          // $("#state").attr('disabled', true).trigger("liszt:updated");
          if ($("#port").is(':disabled'))
            $("#switchid").prop("disabled", false);
         // $("#oldmac").html("");
         
          $.ajax({
            type: "POST",
            url: "ajaxfetchmac.php",
          data: { switchid: $("#switchid").val(), port: $("#port").val()  },
            cache: false,
            async:true,
			success: function(data) {

              var array = data.split("|");

				      $("#id").val("");
              $("#oldmac").val(array[0]);
              $("#currentmac").val(array[1]);




















			  
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
    $("#date").datepicker({
    
    
    
  });
</script>

