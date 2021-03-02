<style>
  body {
    width: 100%;
    border-width: 100px;
  }
  label.checkbox-label input[type=checkbox]{
    position: relative;
    vertical-align: middle;
    bottom: 1px;
    font-size: 1000px;
  }
</style>
<?php
// //require_once("config.php");
// if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
// // not logged in send to login page
// //redirect("index.php");
// }
// if ( authorize($_SESSION["access"]["USER MANAGER"]["ADD USER"]["create"])) {
// $status = TRUE;
// }
// else {
// $status = TRUE;
// }
// if ($status === FALSE) {
// die("<link href='forbidden.css' rel='stylesheet' />
// <div class='wrap'>
//   <div class='logo'>
//     <h1>404</h1><br />
//     <p>Sorry, this page isn't available</p>
//     <p>The link you followed may be broken, or the page may have been removed for the secuurity purposes.  </p><br>
//     <hr>
//     <br>
//     <hr>
//     <br />
//   </div>
//   <div class='sub'>
//     <p>
//       <a href='dashboard.php'>Back to home</a> <a
//       href='javascript:window.history.back();'>Go back to the previous
//     page</a>
//   </p>
// </div>
// </div>
// ");
// }
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/awesome-bootstrap-checkbox/0.3.5/awesome-bootstrap-checkbox.min.css" />
<style type="text/css">
  /* Don't add a check icon to the radio */
  input[type="radio"].styled:checked+label:after {
    font-family: 'FontAwesome';
    content: '';    
  }
  .right-inner-addon {
      position: relative;
      margin-right: -25px;
  }
</style>
<style>
  h3 {
    text-align: center;
    color: green;
    text-indent: 50px;
  }
  .alert .alert-success{
    background-color: green;
  }
  .alert {
    width:40%;
    text-align: center;
    font-color: maroon;
    height: auto;
  }
</style>
<?php
// set page title
// $title = "Dashboard";
// require_once("config.php");
// if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
// // not logged in send to login page
// redirect("index.php");
// }
// //$status = FALSE;
// //if ( authorize($_SESSION["access"]["create"]) ||
// //authorize($_SESSION["access"]["edit"]) ||
// //authorize($_SESSION["access"]["view"]) ||
// //authorize($_SESSION["access"]["delete"]) ) {
// //$status = TRUE;
// //}
// //if ($status === FALSE) {
// //die("You dont have the permission to access this page");
// //}
// $stmt = $DB->prepare("SELECT * FROM system_users WHERE u_userid=:uid");
// $stmt->execute(array(":uid"=>$_SESSION['user_id']));
// $row=$stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link href="https://bootswatch.com/yeti/bootstrap.min.css" rel="stylesheet">
 
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.2/css/bootstrap-select.min.css" />
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">

        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Dashboard</li>
        </ol>
      </section>
      <!-- Main content -->
      
      
      <div class="container well" style="margin-top: 3.8%; width: 98%; height:auto; background-color: none; border-color: silver;">
        <form id="register-form" method="post" >
          <fieldset>
            <legend><h5>Assign Role and Rights</legend></h5>
          </fieldset>
          <br>
          <div class="form-group col-md-6">
            <div class="input-group right-inner-addon">
              <div class="input-group-addon">
                <span class="glyphicon glyphicon-cog"></span>
              </div>
              <select class="form-control" placeholder="Switch IP" id="switchid" name="switchid"> 
              <option class="form-control" value="" selected>Please Role Code</option>
                <?php
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
            <div class="form-group col-md-6">
              <div class="input-group right-inner-addon">
                <div class="input-group-addon">
                  <span class="glyphicon glyphicon-cog"></span>
                </div>
                <select class="form-control" id="state" required name="switchids">
                </select>
              </div>

            </div>
          </legend>
          <br /> <br />
          <hr>
          <div class="clearfix">
            <style type="text/css">
              #bootstrapSelectForm .selectContainer .form-control-feedback {
                 Adjust feedback icon position 
                right: -15px;
              }
            </style>
          </legend>
        </fieldset>
        <hr>
        <div class="form-group col-md-6">
          <div class="input-group">

            <div class="form-group col-md-12">
              <button type="submit" class="btn btn-default" name="btn-login" id="btn-login">
                <span class="glyphicon glyphicon-log-in"></span> &nbsp; Create Module
              </button>
              <div id="loader"></div>
            </div>
          </fieldset>

          <div id="error" class="form-group col-md-12"> </div>
        </div>
      </div>
    </form>
  </legend>
</fieldset>
</form>
</div>
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<!-- jQuery 2.2.3 -->
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
</body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.min.js"></script>
<script src ="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/js/bootstrapValidator.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.2/js/bootstrap-select.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#state').attr('disabled', true);
    $('#register-form').bootstrapValidator({
      excluded: ':disabled',
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
        state: {
          validators: {
            notEmpty: {
              message: 'Module Group  Name is required *'
            },
          }
        },
        'selection[]': {
          validators: {
            choice: {
              min: 1,
              max: 4,
              message: 'Please choose any 1 or more roles..'
            }
          }
        },
        drop2: {
          validators: {
            notEmpty: {
              message: 'Module Code is required'
            },
          }
        },
        switchid: {
          validators: {
            notEmpty: {
              message: 'Role Code is required *'
            },
          }
        },
        state: {
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
        role_rolecode: {
          validators: {
            callback: {
              message: 'Please select the role code',
              callback: function(value, validator, $field) {
                /* Get the selected options */
                var options = validator.getFieldElements('role_rolecode').val();
                return (options != null && options.length >= 0 && options.length <= 2);
              }
            }
          }
        },
        modulecode: {
          validators: {
            callback: {
              message: 'Please select the modulecode',
              callback: function(value, validator, $field) {
                /* Get the selected options */
                var options = validator.getFieldElements('modulecode').val();
                return (options != null && options.length >= 0 && options.length <= 2);
              }
            }
          }
        },
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
  url: 'ajaxasignrole.php',
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
<script>
  $(document).ready(function(){    
    $("#register-form").submit(function(){
      var get_data=$("#register-form").serialize();
      $.ajax({
        type: "POST",
        url: "inser_data.php",
        data: {"csc":get_data},
        cache: false,
        success: function(html) {
          alert(html);
        }
      });
      return false;
    });
    $("select#switchid").change(function(){
        var switchid =  $("select#switchid option:selected").attr('value');
        // alert(switchid);
        // 
        if (switchid != '') {
          // var stateOfSelect = $("#state").disabled;
          // alert(stateOfSelect);
          // $("#state").attr('disabled', true).trigger("liszt:updated");
          if ($("#state").is(':disabled'))
            $("#state").prop("disabled", false);
          $("#state").html("");
          $("#city").html("");
            $.ajax({
              type: "POST",
              url: "fetch_state.php",
              data: "switchid="+switchid,
              cache: false,
              async: true,
              beforeSend: function () {
                $('#state').html('<img src="loader.gif" alt="" width="24" height="24">');
              },
              success: function(html) {
                $("#state").html(html);
              }
            });
        }
        else
        {
          $('.form-group').removeClass('has-error has-feedback');
          $('.form-group').removeClass('has-success has-feedback');
          $('.form-control-feedback').removeClass('glyphicon glyphicon-ok');
          $('.form-control-feedback').removeClass('glyphicon glyphicon-remove');
          $('#state').prop('selectedIndex',0);
          // $("#state option:eq(0)").prop("selected", true); //set option of index 0 to selected
          $("#state").prop('disabled', 1);
        }
      });
  });
=======
<style>
  body {
    width: 100%;
    border-width: 100px;
  }
  label.checkbox-label input[type=checkbox]{
    position: relative;
    vertical-align: middle;
    bottom: 1px;
    font-size: 1000px;
  }
</style>
<?php
// //require_once("config.php");
// if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
// // not logged in send to login page
// //redirect("index.php");
// }
// if ( authorize($_SESSION["access"]["USER MANAGER"]["ADD USER"]["create"])) {
// $status = TRUE;
// }
// else {
// $status = TRUE;
// }
// if ($status === FALSE) {
// die("<link href='forbidden.css' rel='stylesheet' />
// <div class='wrap'>
//   <div class='logo'>
//     <h1>404</h1><br />
//     <p>Sorry, this page isn't available</p>
//     <p>The link you followed may be broken, or the page may have been removed for the secuurity purposes.  </p><br>
//     <hr>
//     <br>
//     <hr>
//     <br />
//   </div>
//   <div class='sub'>
//     <p>
//       <a href='dashboard.php'>Back to home</a> <a
//       href='javascript:window.history.back();'>Go back to the previous
//     page</a>
//   </p>
// </div>
// </div>
// ");
// }
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/awesome-bootstrap-checkbox/0.3.5/awesome-bootstrap-checkbox.min.css" />
<style type="text/css">
  /* Don't add a check icon to the radio */
  input[type="radio"].styled:checked+label:after {
    font-family: 'FontAwesome';
    content: '';
  }
</style>
<style>
  h3 {
    text-align: center;
    color: green;
    text-indent: 50px;
  }
  .alert .alert-success{
    background-color: green;
  }
  .alert {
    width:40%;
    text-align: center;
    font-color: maroon;
    height: auto;
  }
</style>
<?php
// set page title
// $title = "Dashboard";
// require_once("config.php");
// if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
// // not logged in send to login page
// redirect("index.php");
// }
// //$status = FALSE;
// //if ( authorize($_SESSION["access"]["create"]) ||
// //authorize($_SESSION["access"]["edit"]) ||
// //authorize($_SESSION["access"]["view"]) ||
// //authorize($_SESSION["access"]["delete"]) ) {
// //$status = TRUE;
// //}
// //if ($status === FALSE) {
// //die("You dont have the permission to access this page");
// //}
// $stmt = $DB->prepare("SELECT * FROM system_users WHERE u_userid=:uid");
// $stmt->execute(array(":uid"=>$_SESSION['user_id']));
// $row=$stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link href="https://bootswatch.com/yeti/bootstrap.min.css" rel="stylesheet">
 
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.2/css/bootstrap-select.min.css" />
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Dashboard</li>
        </ol>
      </section>
      <!-- Main content -->
      
      
      <div class="container well" style="margin-top: 3.8%; width: 98%; height:auto; background-color: none; border-color: silver;">
        <form id="register-form" method="post" >
          <fieldset>
            <legend><h5>Assign Role and Rights</legend></h5>
          </fieldset>
          <br>
          <div class="form-group col-md-6">
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
            <div class="form-group col-md-6">
              <div class="input-group">
                <div class="input-group-addon">
                  <span class="glyphicon glyphicon-cog"></span>
                </div>
                <select class="form-control" id="state" required name="switchids">
                </select>
              </div>
            </div>
          </legend>
          <br /> <br />
          <hr>
          <div class="clearfix">
            <style type="text/css">
              #bootstrapSelectForm .selectContainer .form-control-feedback {
                /* Adjust feedback icon position */
                right: -15px;
              }
            </style>
          </legend>
        </fieldset>
        <hr>
        <div class="form-group col-md-6">
          <div class="input-group">
            <div class="form-group col-md-12">
              <button type="submit" class="btn btn-default" name="btn-login" id="btn-login">
                <span class="glyphicon glyphicon-log-in"></span> &nbsp; Create Module
              </button>
              <div id="loader"></div>
            </div>
          </fieldset>
          <div id="error" class="form-group col-md-12"> </div>
        </div>
      </div>
    </form>
  </legend>
</fieldset>
</form>
</div>
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<!-- jQuery 2.2.3 -->
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
</body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.min.js"></script>
<script src ="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/js/bootstrapValidator.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.2/js/bootstrap-select.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#state').attr('disabled', true);
    $('#register-form').bootstrapValidator({
      excluded: ':disabled',
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
        state: {
          validators: {
            notEmpty: {
              message: 'Module Group  Name is required *'
            },
          }
        },
        'selection[]': {
          validators: {
            choice: {
              min: 1,
              max: 4,
              message: 'Please choose any 1 or more roles..'
            }
          }
        },
        drop2: {
          validators: {
            notEmpty: {
              message: 'Module Code is required'
            },
          }
        },
        switchid: {
          validators: {
            notEmpty: {
              message: 'Role Code is required *'
            },
          }
        },
        state: {
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
        role_rolecode: {
          validators: {
            callback: {
              message: 'Please select the role code',
              callback: function(value, validator, $field) {
                /* Get the selected options */
                var options = validator.getFieldElements('role_rolecode').val();
                return (options != null && options.length >= 0 && options.length <= 2);
              }
            }
          }
        },
        modulecode: {
          validators: {
            callback: {
              message: 'Please select the modulecode',
              callback: function(value, validator, $field) {
                /* Get the selected options */
                var options = validator.getFieldElements('modulecode').val();
                return (options != null && options.length >= 0 && options.length <= 2);
              }
            }
          }
        },
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
  url: 'ajaxasignrole.php',
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
<script>
  $(document).ready(function(){    
    $("#register-form").submit(function(){
      var get_data=$("#register-form").serialize();
      $.ajax({
        type: "POST",
        url: "inser_data.php",
        data: {"csc":get_data},
        cache: false,
        success: function(html) {
          alert(html);
        }
      });
      return false;
    });
    $("select#switchid").change(function(){
        var switchid =  $("select#switchid option:selected").attr('value');
        // alert(switchid);
        // 
        if (switchid != '') {
          // var stateOfSelect = $("#state").disabled;
          // alert(stateOfSelect);
          // $("#state").attr('disabled', true).trigger("liszt:updated");
          if ($("#state").is(':disabled'))
            $("#state").prop("disabled", false);
          $("#state").html("");
          $("#city").html("");
            $.ajax({
              type: "POST",
              url: "fetch_state.php",
              data: "switchid="+switchid,
              cache: false,
              async:true,
              beforeSend: function () {
                $('#state').html('<img src="loader.gif" alt="" width="24" height="24">');
              },
              success: function(html) {
                $("#state").html(html);
              }
            });
        }
        else
        {
          $('.form-group').removeClass('has-error has-feedback');
          $('.form-group').removeClass('has-success has-feedback');
          $('.form-control-feedback').removeClass('glyphicon glyphicon-ok');
          $('.form-control-feedback').removeClass('glyphicon glyphicon-remove');
          $('#state').prop('selectedIndex',0);
          // $("#state option:eq(0)").prop("selected", true); //set option of index 0 to selected
          $("#state").prop('disabled', 1);
        }
      });
  });

</script>