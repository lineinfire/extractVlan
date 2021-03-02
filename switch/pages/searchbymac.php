<!DOCTYPE html>
<html lang="en">
    <head>
        <style>
     h5, .h5 {
    font-size: 10px;
    color: #fcfcfc;
    margin-bottom: 10px;
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
    background: rgba(0,0,0,0.6) url(../assets/img/ajax-loader.gif) no-repeat center center;
    overflow: hidden;
}
.table-bordered {
    border: 1px solid #428bca;
}
table {  
    width: 640px; 
    border-collapse: collapse; 
    border-spacing: 0;
}
td, th { border: 1px solid #CCC; }  

#processing {
    position: fixed;
    width: 100%;
    height: 100%;
    text-align: center;
    vertical-align: middle;
    z-index: 1000;
    top: 0;
    left: 0;
    background: rgba(0,0,0,0.6) url(../images/loaders/processing.gif) no-repeat center center;
    overflow: hidden;
}
.has-success .form-control-feedback {
    color: #3c763d;
    margin-top: -20px;
    margin-right: 20px;
}
.has-error .form-control-feedback {
    color: #a94442;
    margin-top: -20px;
    margin-right: 20px;
}




    </style>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Administration-Home</title>

        <link href="../css/style.default.css" rel="stylesheet">


        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>
        
        <header>
            <div class="headerwrapper">
                <div class="header-left">
                    <h5 style=" font-size: 16px; margin-left: -9px; text-shadow: 2px 0 0 #fff, -2px 0 0 #fff, 0 2px 0 #fff, 0 -2px 0 #fff, 1px 1px #fff, -1px -1px 0 #fff, 1px -1px 0 #fff, -1px 1px 0 #fff;">Prabhu Management</h5>
                  
                    <div class="pull-right">
                        <a href="" class="menu-collapse">
                            <i class="fa fa-bars"></i>
                        </a>
                    </div>
                </div><!-- header-left -->
                
                <div class="header-right">
                    
                    <div class="pull-right">
                        
                        <form class="form form-search" action="search-results.html">
                            <input type="search" class="form-control" placeholder="Search" />
                        </form>
                        
                  
                        
                      
                        
                        <div class="btn-group btn-group-option">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                              <i class="fa fa-caret-down"></i>
                            </button>
                            <ul class="dropdown-menu pull-right" role="menu">
                              <li><a href="#"><i class="glyphicon glyphicon-user"></i> My Profile</a></li>
                              <li><a href="#"><i class="glyphicon glyphicon-star"></i> Activity Log</a></li>
                              <li><a href="#"><i class="glyphicon glyphicon-cog"></i> Account Settings</a></li>
                              <li><a href="#"><i class="glyphicon glyphicon-question-sign"></i> Help</a></li>
                              <li class="divider"></li>
                              <li><a href="#"><i class="glyphicon glyphicon-log-out"></i>Sign Out</a></li>
                            </ul>
                        </div><!-- btn-group -->
                        
                    </div><!-- pull-right -->
                    
                </div><!-- header-right -->
                
            </div><!-- headerwrapper -->
        </header>
        
        <section>
            <div class="mainwrapper">
                <div class="leftpanel">
                    <div class="media profile-left">
                        <a class="pull-left profile-thumb" href="#">
                            <img class="img-circle" src="../images/photos/profile.png" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">Bishnu Ghimire </h4>
                            <small class="text-muted">Administrator</small>
                        </div>
                    </div><!-- media -->
                    
                    <h5 class="leftpanel-title">Switch Manager</h5>
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="../home.php"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
                      
                        <li class="parent"><a href=""><i class="fa fa-suitcase"></i> <span>Port Management</span></a>
                            <ul class="children">
                                <li><a href="#">Get Switch Info</a></li>
                                <li><a href="#">Disable Interface</a></li>
                                <li><a href="#">Enable Interface</a></li>
                                <li><a href="#">Activate Suspended Port</a></li>
                                <li><a href="#">Assign Port Security</a></li>
                                <li><a href="#">Remove Port Security</a></li>
                                <li><a href="#">Port Speed</a></li>
                                <li><a href="#">Port Status</a></li>                                
                             
                            </ul>
                        </li>
                        <li class="parent"><a href=""><i class="fa fa-suitcase"></i> <span>Vlan Management</span></a>
                            <ul class="children">
                                <li><a href="#">Create Vlan</a></li>
                                <li><a href="#">Remove Vlan</a></li>
                                <li><a href="#">Vlan Assignment</a></li>
                                
                            </ul>
                        </li>

                               <li class="parent"><a href=""><i class="fa fa-suitcase"></i> <span>Trunk Management</span></a>
                            <ul class="children">
                                <li><a href="#">Update Trunk </a></li>
                                <li><a href="#">Remove Trunk</a></li>
                                
                                
                            </ul>
                        </li>
                               <li class="parent"><a href=""><i class="fa fa-search"></i> <span>Search MAC Records</span></a>
                            <ul class="children">
                                <li><a href="searchmac.php">Search By Interface</a></li>
                                <li><a href="#">Search By MAC</a></li>
                                
                                
                            </ul>
                        </li>             
                    
                </div><!-- leftpanel -->
                
                <div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    
                                    <li><a href="">Home</a></li>
                                    <li>Dashboard</li>
                                </ul>
                                <h4 style="margin-top: 10px;font-size: 14px;">MAC Address Records</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->
                    
                    <div class="contentpanel">
                          <div class="col-md-12">
                                <div class="panel-group" id="accordion2">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <p>Search MAC ID </p>
                                            </h4>
                                        </div>
                                      
                                            <div class="panel-body">
                                               
                                             <div class="container well" style="width: 100%; background-color: #fcfcfc;">
    <form id="searchbymac" method="post">
      
     <input type="hidden" id="id" name="id" value="">


     <div class="form-group col-md-6">
       <select class="form-control" id="switchcode" name="switchcode"> 
<option value="" selected disabled hidden><------Please Select Switch Registration------></option>

<?php

          
$servername = "localhost";
$username = "root";
$password = "";
try {
    $conn = new PDO("mysql:host=$servername;dbname=module", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
$stmt1 = $conn->Query("SELECT * FROM switchcodes");
while ($row = $stmt1->fetch(PDO::FETCH_ASSOC)) {



echo "<option value='" . $row['switchip'] . "'>" . $row['switchip'] . "</option>";
}

?>







       </select> 
     </div>

  
      <div class="form-group col-md-6">
        <input class="form-control" name="macid" id="macid" placeholder="Machine Access Code">
      </div>

       

  <div class="form-group col-md-12">
        <input class="btn btn-primary" id="submit" name="submit" type="submit" value="Submit Query">
      </div>


<br>
 <div class="form-group col-md-12">
        <div id="error"></div>
      </div>
 <div id="loading" style="display: none;"> </div>
  <div id="processing" style="display: none;"> </div>


    </form>
  </div>              














                                            </div>
                                        
                                    </div><!-- panel -->
                                    
                                
                                    
                              
                                    
                                </div><!-- panel-group -->
                            </div>
                        <!-- CONTENT GOES HERE -->    
                    
                    </div><!-- contentpanel -->
                    
                </div>
            </div><!-- mainwrapper -->
        </section>


        <script src="../js/jquery-1.11.1.min.js"></script>
        <script src="../js/jquery-migrate-1.2.1.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/modernizr.min.js"></script>
        <script src="../js/pace.min.js"></script>
        <script src="../js/retina.min.js"></script>
        <script src="../js/jquery.cookies.js"></script>

        <script src="../js/custom.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/js/bootstrapValidator.js"></script>
         
        <script src="../js/searchbymac.js" type="text/javascript"></script>
    </body>

</html>
     <script>
      $( document ).ajaxStart(function() {
  $( "#processing" ).show();
      });
           $( document ).ajaxStop(function() {
  $( "#processing" ).hide();
      });
    </script>