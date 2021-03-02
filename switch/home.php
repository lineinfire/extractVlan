<!DOCTYPE html>
<html lang="en">
    <head>
        <style>
     h5, .h5 {
    font-size: 10px;
    color: #fcfcfc;
    margin-bottom: 10px;
}

    </style>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Administration-Home</title>

        <link href="css/style.default.css" rel="stylesheet">

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
                            <img class="img-circle" src="images/photos/profile.png" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">Bishnu Ghimire </h4>
                            <small class="text-muted">Administrator</small>
                        </div>
                    </div><!-- media -->
                    
                    <h5 class="leftpanel-title">Switch Manager</h5>
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="home.php"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
                      
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
                                <li><a href="../Switch/pages/searchmac.php">Search By Interface</a></li>
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
                                <h4 style="margin-top: 10px;font-size: 14px;">Switch Info</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->
                    
                    <div class="contentpanel">
                        
                        <!-- CONTENT GOES HERE -->    
                    
                    </div><!-- contentpanel -->
                    
                </div>
            </div><!-- mainwrapper -->
        </section>


        <script src="js/jquery-1.11.1.min.js"></script>
        <script src="js/jquery-migrate-1.2.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/modernizr.min.js"></script>
        <script src="js/pace.min.js"></script>
        <script src="js/retina.min.js"></script>
        <script src="js/jquery.cookies.js"></script>

        <script src="js/custom.js"></script>

    </body>
</html>
