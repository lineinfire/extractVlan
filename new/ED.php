



<?php
require_once("config.php");

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
$stmt = $DB->prepare("SELECT * FROM system_users WHERE id=:uid");
$stmt->execute(array(":uid"=>$_SESSION['user_id']));
$row=$stmt->fetch(PDO::FETCH_ASSOC);
?>









<?php

//For more Info: Please visit: http://www.discussdesk.com/bootstrap-datatable-with-add-edit-remove-option-in-php-mysql-ajax.htm

  // VARIABLES
  $aColumns = array('id', 'name', 'address', 'email', 'contact', 'u_username', 'u_password','u_rolecode');
  $sIndexColumn = "id";
  $sTable = "system_users";
  $gaSql['user'] = "root";
  $gaSql['password'] = "";
  $gaSql['db'] = "multi-admin";
  $gaSql['server'] = "localhost";


  // DATABASE CONNECTION
  function dbinit(&$gaSql) {
    // ERROR HANDLING
    function fatal_error($sErrorMessage = '') {
      header($_SERVER['SERVER_PROTOCOL'] .' 500 Internal Server Error');
      die($sErrorMessage);
    }

    // MYSQL CONNECT
    if ( !$gaSql['link'] = @mysql_connect($gaSql['server'], $gaSql['user'], $gaSql['password']) ) {
      fatal_error('Could not open connection to server');
    }

    // MYSQL DATABASE SELECT
    if ( !mysql_select_db($gaSql['db'], $gaSql['link']) ) {
      fatal_error('Could not select database');
    }
  }

  // AJAX EDIT FROM JQUERY
  if ( isset($_GET['edit']) && 0 < intval($_GET['edit']) ) {
    dbinit($gaSql);

    // SAVE DATA
    if ( isset($_POST) ) {
      $p = $_POST;
      foreach ( $p as &$val ) $val = mysql_real_escape_string($val);
      if ( !empty($p['editname']) && !empty($p['editaddress']) && !empty($p['editemail']) && !empty($p['editcontact']) && !empty($p['editusername']) && !empty($p['editpassword']) && !empty($p['editrolecode']) )


        echo '';
        @mysql_query(" UPDATE $sTable SET name = '" . $p['editname'] . "', address = '" . $p['editaddress'] . "', email = '" . $p['editemail'] . "', contact = '" . $p['editcontact'] . "', u_username = '" . $p['editusername'] . "', u_password = '" . $p['editpassword'] . "', u_rolecode = '" . $p['editrolecode'] . "' WHERE id = " . intval($_GET['edit']));
    }

    // GET DATA
    $query = mysql_query(" SELECT * FROM $sTable WHERE $sIndexColumn = " . intval($_GET['edit']), $gaSql['link']);
    die(json_encode(mysql_fetch_assoc($query)));
  }

  // AJAX ADD FROM JQUERY
  if ( isset($_GET['add']) && isset($_POST) ) {
    dbinit($gaSql);

    $p = $_POST;
    foreach ( $p as &$val ) $val = mysql_real_escape_string($val);
    if ( !empty($p['name']) && !empty($p['address']) && !empty($p['email']) && !empty($p['contact']) && !empty($p['username']) && !empty($p['password']) && !empty($p['rolecode']) ) {
      @mysql_query(" INSERT INTO $sTable (name, address, email, contact, u_username, u_password, u_rolecode) VALUES ('" . $p['name'] . "', '" . $p['address'] . "','" . $p['email'] . "','" . $p['contact'] . "','" . $p['username'] . "', '" . $p['password'] . "', '" . $p['rolecode'] . "')");
      $id = mysql_insert_id();
      $query = mysql_query(" SELECT * FROM $sTable WHERE $sIndexColumn = " . $id, $gaSql['link']);
      die(json_encode(mysql_fetch_assoc($query)));
    }
    location.reload();
  }

  // AJAX REMOVE FROM JQUERY
  if ( isset($_GET['remove']) && 0 < intval($_GET['remove']) ) {
    dbinit($gaSql);

    // REMOVE DATA
    @mysql_query(" DELETE FROM $sTable WHERE id = " . intval($_GET['remove']));
  }


  // AJAX FROM JQUERY
  if ( isset($_GET['ajax']) ) {
    dbinit($gaSql);

    // QUERY LIMIT
    $sLimit = "";
    if ( isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1' ) {
      $sLimit = "LIMIT " . intval($_GET['iDisplayStart']) . ", " . intval($_GET['iDisplayLength']);
    }

    // QUERY ORDER
    $sOrder = "";
    if ( isset($_GET['iSortCol_0']) ) {
      $sOrder = "ORDER BY ";
      for ( $i = 0; $i < intval($_GET['iSortingCols']); $i++ ) {
        if ( $_GET['bSortable_' . intval($_GET['iSortCol_' . $i])] == "true" ) {
          $sOrder .= $aColumns[intval($_GET['iSortCol_' . $i])] . " " . ( $_GET['sSortDir_' . $i] === 'asc' ? 'asc' : 'desc' ) . ", ";
        }
      }
      $sOrder = substr_replace($sOrder, "", -2);
      if ( $sOrder == "ORDER BY" ) $sOrder = "";
    }

    // QUERY SEARCH
    $sWhere = "";
    if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" ) {
      $sWhere = "WHERE (";
      for ( $i = 0; $i < count($aColumns); $i++ ) {
        if ( isset($_GET['bSearchable_' . $i]) && $_GET['bSearchable_' . $i] == "true" ) {
          $sWhere .= $aColumns[$i] . " LIKE '%" . mysql_real_escape_string($_GET['sSearch']) . "%' OR ";
        }
      }
      $sWhere = substr_replace($sWhere, "", -3);
      $sWhere .= ')';
    }

    // BUILD QUERY
    for ( $i = 0; $i < count($aColumns); $i++ ) {
      if ( isset($_GET['bSearchable_' . $i]) && $_GET['bSearchable_' . $i] == "true" && $_GET['sSearch_' . $i] != '' ) {
        if ( $sWhere == "" ) $sWhere = "WHERE ";
        else $sWhere .= " AND ";
        $sWhere .= $aColumns[$i] . " LIKE '%" . mysql_real_escape_string($_GET['sSearch_' . $i]) . "%' ";
      }
    }

    // FETCH
    $sQuery = " SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumns)) . " FROM $sTable $sWhere $sOrder $sLimit ";
    $rResult = mysql_query($sQuery, $gaSql['link']) or fatal_error('MySQL Error: ' . mysql_errno());
    $sQuery = " SELECT FOUND_ROWS() ";
    $rResultFilterTotal = mysql_query($sQuery, $gaSql['link']) or fatal_error('MySQL Error: ' . mysql_errno());
    $aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
    $iFilteredTotal = $aResultFilterTotal[0];
    $sQuery = " SELECT COUNT(" . $sIndexColumn . ") FROM $sTable ";
    $rResultTotal = mysql_query($sQuery, $gaSql['link']) or fatal_error('MySQL Error: ' . mysql_errno());
    $aResultTotal = mysql_fetch_array($rResultTotal);
    $iTotal = $aResultTotal[0];
    while ( $aRow = mysql_fetch_array($rResult) ) {
      $row = array();
      for ( $i = 0 ; $i < count($aColumns); $i++ ) {
        if ( $aColumns[$i] == "version" ) $row[] = ( $aRow[$aColumns[$i]] == "0" ) ? '-' : $aRow[$aColumns[$i]];
        else if ( $aColumns[$i] != ' ' ) $row[] = $aRow[$aColumns[$i]];
      }
      $output['aaData'][] = array_merge($row, array('<a data-id="row-' . $row[0] . '" href="javascript:editRow(' . $row[0] . ');" <class="btn btn-md btn-success">edit</a>&nbsp;<a href="javascript:removeRow(' . $row[0] . ');" class="btn btn-default btn-md" style="background-color: #c83a2a;border-color: #b33426; color: #ffffff;">remove</a>'));
    }

    // RETURN IN JSON
    die(json_encode($output));
  }

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
  <link rel="stylesheet" type="text/css" href="jquery.dataTables.min.css">

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <!-- Optional theme -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type="text/javascript" src="jquery.dataTables.min.js"></script>
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
     .alert-success {

        color:#eeeeee;
        background-color: #1f3b5a;

      }
      .alert {

        padding: 9;
      }

#example {

  background-color: silver;
}

    </style>

   
     <div class="container well" style="margin-top: 3.8%; width: 98%; height:auto; background-color: silver; color:#c9cbd2; border-color: silver;">
      
        <fieldset>
          <legend><h5>System Access Users Information</legend></h5>
        </fieldset>
<br>
      <script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-38304687-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>  
      
<!-- /container -->

      <div class="container-fluid">
    <button type="button" style="padding:10px; margin:0 50px 15px 0;" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#add-modal"><b>Add More Rows</b></button>
    <div class="row">
<div class="col-md-12 marginT20">

    <div class="table-responsive demo-x content">
    <table id="example" class="display" cellspacing="0" width="100%" style="font-size: 15px;">
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Address</th>
          <th>Email</th>
          <th>contact</th>
          <th>Username</th>
          <th>Role Code</th>
          <th style="background-image: none">Edit</th>
        </tr>
      </thead>
    </table>
    </div>

    </div>
    </div>
    </div>  
            



                

                
              </div> <!-- /widget__content -->

            </article><!-- /widget -->
          </div>


        </div>
      





           
        

      






<div id="status" style="text-align:center; font-size: 14px;">

    
    
    </div>


    <style type="text/css">
      #bootstrapSelectForm .selectContainer .form-control-feedback {
        /* Adjust feedback icon position */
        right: -15px;
      }
    </style>



<br>


<br>

<br>
 <div class="blink" id="blink">

   <br>
   <div id="modulegroupcode">
     <div class="form-group col-md-12">
          <div class="input-group">
            <div class="input-group-addon">
             <span class="glyphicon glyphicon-cog"></span> 
           </div>
           <select class="form-control" id="modulecode" required name="modulecode"> 
           </select>
         </div>

       </div>
       </div>
<hr>
  <br>

  <div id="error" class="form-group col-md-12"> </div>
</fieldset>


</div>


</div>
</form>
</div> <!-- /row -->
<!-- /row -->
<!-- /row -->
</section> <!-- /content -->
</div>

<script type="text/javascript" src="js/main.js"></script>
<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form class="form-horizontal" id="edit-form">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="edit-modal-label">Edit selected row</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="edit-id" value="" class="hidden">
                <div class="form-group">
                <label for="firstname" class="col-sm-2 control-label">Firstname</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Firstname" required>
                </div>
              </div>
              <div class="form-group">
                <label for="email" class="col-sm-2 control-label">E-mail</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" placeholder="E-mail address" required>
                </div>
              </div>
              <div class="form-group">
                <label for="mobile" class="col-sm-2 control-label">Mobile</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile" required>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-labelledby="add-modal-label">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form class="form-horizontal" id="add-form">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="add-modal-label">Add new row</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                <label for="add-firstname" class="col-sm-2 control-label">Firstname</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="add-firstname" name="firstname" placeholder="Firstname" required>
                </div>
              </div>
              <div class="form-group">
                <label for="add-email" class="col-sm-2 control-label">E-mail</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="add-email" name="email" placeholder="E-mail address" required>
                </div>
              </div>
              <div class="form-group">
                <label for="add-mobile" class="col-sm-2 control-label">Mobile</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="add-mobile" name="mobile" placeholder="Mobile" required>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
      </div>
    </div>

  
    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.10/js/jquery.dataTables.js"></script>
>
    <script type="text/javascript" language="javascript" class="init">
      $(document).ready(function() {

        // ATW
        if ( top.location.href != location.href ) top.location.href = location.href;

        // Initialize datatable
        $('#example').dataTable({
          "aProcessing": true,
          "aServerSide": true,
          "ajax": "datatable.php?ajax"
        });

        // Save edited row
        $("#edit-form").on("submit", function(event) {
          event.preventDefault();
          $.post("datatable.php?edit=" + $('#edit-id').val(), $(this).serialize(), function(data) {
            var obj = $.parseJSON(data);
            var tr = $('a[data-id="row-' + $('#edit-id').val() + '"]').parent().parent();
            $('td:eq(1)', tr).html(obj.name);
            $('td:eq(2)', tr).html(obj.address);
            $('td:eq(3)', tr).html(obj.email);
            $('td:eq(4)', tr).html(obj.contact);
            $('td:eq(5)', tr).html(obj.u_username);
            $('td:eq(6)', tr).html(obj.u_password);
            $('td:eq(7)', tr).html(obj.u_rolecode);
            $('#edit-modal').modal('hide');
          }).fail(function() { alert('Unable to save data, please try again later.'); });
        });

        // Add new row
        $("#add-form").on("submit", function(event) {
          event.preventDefault();
          $.post("datatable.php?add", $(this).serialize(), function(data) {
            var obj = $.parseJSON(data);
            $('#example tbody tr:last').after('<tr role="row"><td class="sorting_1">' + obj.id + '</td><td>' + obj.name + '</td><td>' + obj.address + '</td><td>' + obj.email + '</td><td>' + obj.contact + '</td><td>' + obj.u_username +'</td><td>' + obj.u_password + '</td><td>' + obj.u_rolecode + '</td><td><a data-id="row-' + obj.id + '" href="javascript:editRow(' + obj.id + ');" class="btn btn-default btn-sm"><img src="edit.png">edit</a>&nbsp;<a href="javascript:removeRow(' + obj.id + ');" class="btn btn-default btn-sm">remove</a></td></tr>');
            $('#add-modal').modal('hide');
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
          }).fail(function() { alert('Unable to save data, please try again later.'); });


        });

      });

      // Edit row
      function editRow(id) {
        if ( 'undefined' != typeof id ) {
          $.getJSON('datatable.php?edit=' + id, function(obj) {
            $('#edit-id').val(obj.id);
            $('#editname').val(obj.name);
            $('#editaddress').val(obj.address);
            $('#editemail').val(obj.email);
            $('#editcontact').val(obj.contact);
            $('#editusername').val(obj.u_username);
            $('#editpassword').val(obj.u_password);
            $('#editrolecode').val(obj.u_rolecode);

            $('#edit-modal').modal('show')
          }).fail(function() { alert('Unable to fetch data, please try again later.') });
        } else alert('Unknown row id.');
      }

      // Remove row
      function removeRow(id) {
        if ( 'undefined' != typeof id ) {
          $.get('datatable.php?remove=' + id, function() {
            $('a[data-id="row-' + id + '"]').parent().parent().remove();
          }).fail(function() { alert('Unable to fetch data, please try again later.') });
        } else alert('Unknown row id.');
      }
    </script>

    <script type="text/javascript">
      

$(".button").click(function () {
  $("#sForm").toggleClass("open");   
});

$(".controlTd").click(function () {
  $(this).children(".settingsIcons").toggleClass("display"); 
  $(this).children(".settingsIcon").toggleClass("openIcon"); 
});






    </script>