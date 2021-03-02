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


#register-form{height:400px;
font-size: 15px;
border-radius: 10px;
overflow-y:auto}
.form-control {
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 3px;
    /* padding: 10px; */
    height: auto;
    -moz-box-shadow: none;
    -webkit-box-shadow: none;
    box-shadow: none;
    font-size: 13px;
}

    </style>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Administration-Home</title>

        <link href="../css/style.default.css" rel="stylesheet">

        <link href="../css/select2.css" rel="stylesheet" />
        <link href="../css/style.datatables.css" rel="stylesheet">
        <link href="//cdn.datatables.net/responsive/1.0.1/css/dataTables.responsive.css" rel="stylesheet">


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
                                <li><a href="#">Search By Interface</a></li>
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
                                <h4 style="margin-top: 10px;font-size: 14px;">Active Registrations</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->
                    
                    <div class="contentpanel">
                          <div class="col-md-12">
                                <div class="panel-group" id="accordion2">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <p>Registered Nodes</p>
                                            </h4>
                                        </div>
                                      
                                            <div class="panel-body">
               
                                                <table id="basicTable" class="table table-striped table-bordered responsive">
                                <thead class="">
                                    <tr>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Ext</th>
                                        <th>Depart</th>
                                         <th>Switch</th>
                                          <th>Port</th>
                                           <th>IP</th>
                                           <th>Phone ID</th>
                                            <th>Vlan</th>
                                             <th>MAC</th>
                                    </tr>
                                </thead>
                         
                                <tbody>
                                    
                           
                            
                             
               
                                </tbody>
                            </table>












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
        <script src="../js/validation.js" type="text/javascript"></script>
          <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
           
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
   <script type="text/javascript">

$(document).ready(function(){
  var table =  $('#basicTable').DataTable({

        processing: false,
        serverSide: false,
        deferRender: false,
        responsive: true,   

            "order": [],
         "scrollX": true,  

            "ajax": {
                "url":"../pages/list.php",
                "dataSrc":"",
                "async":true,
             },

            "columns" : [  
            { "data": "name" },                        
                { "data": "address" },
                { "data": "email" },
                { "data": "mobile" },
                 { "data": "extno" },
                 { "data": "department" },
                  { "data": "switchcode" },
                  { "data": "portid" },
                  { "data": "ipaddress" },
                 { "data": "phoneip" },
                   { "data": "vlanid" },
                   { "data": "macaddress" },
         

            ],

        
        select: {
            style: 'os',
            selector: 'td:first-child'
        },

fnDrawCallback: function() {



$(".bghimire").off('click').click(function(e){

var macid = table.row($(this).closest('tr')).data()['mac'];
swal({
      title: 'Are you sure?',
      text: "You are about to terminate device connection!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Proceed with termination!',
      showLoaderOnConfirm: true,
        
      preConfirm: function() {
        return new Promise(function(resolve) {
             e.preventDefault()
           $.ajax({
            url: 'ajax/kickmac.php',
            type: 'POST',
               data: {mca:macid},
              
           })
           .done(function(response){
            swal('MAC has been successfully terminated from device.', response.message, response.status);

          
           })
           .fail(function(){
            swal('Oops...', 'Something went wrong with ajax !', 'error');
           });
        });
        },
      allowOutsideClick: false        
    }); 
});










}
}); 
setInterval( function () {
    table.ajax.reload();
}, 30000 );
 
});
</script>