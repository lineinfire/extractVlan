

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



























<?php
include_once 'dbconfig.php';

$stmt = $db_con->prepare("SELECT * FROM system_users WHERE u_userid=:uid");

$row=$stmt->fetch(PDO::FETCH_ASSOC);



?>






<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Glazzed Admin Theme :: Statistics</title>
	
	<link rel="icon" sizes="192x192" href="img/touch-icon.png" /> 
	<link rel="apple-touch-icon" href="img/touch-icon-iphone.png" /> 
	<link rel="apple-touch-icon" sizes="76x76" href="img/touch-icon-ipad.png" /> 
	<link rel="apple-touch-icon" sizes="120x120" href="img/touch-icon-iphone-retina.png" />
	<link rel="apple-touch-icon" sizes="152x152" href="img/touch-icon-ipad-retina.png" />
	
	<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico" />

	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/main.min.css">
	<link rel="stylesheet" type="text/css" href="jquery.dataTables.min.css">
	

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
				<div class="main-logo"><img src="img/logo.png"></div>
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
						<li>
							<i class="pe-7f-user"></i>
							<p>26k+</p>
							<p>+14</p>
						</li>
						<li>
							<i class="pe-7f-paper-plane"></i>
							<p>1095+</p>
							<p>+56</p>
						</li>
						<li>
							<i class="pe-7g-watch"></i>
							<p>428</p>
							<p>+38</p>
						</li>
					</ul>
				</div> <!-- /user-info -->

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
			<header class="main-header">
				<div class="main-header__nav">
					<h1 class="main-header__title">
						<i class="pe-7f-note2"></i>
						<span>Tables &amp; forms</span>
					</h1>
					<ul class="main-header__breadcrumb">
						<li><a href="#" onclick="return false;">Home</a></li>
						<li class="active"><a href="#" onclick="return false;">Tables &amp; forms</a></li>
					</ul>
				</div>
				
			</header> <!-- /main-header -->


				<div class="row">
					
					<div class="col-md-12">
						<article class="widget">
							<header class="widget__header">
								<div class="widget__title">
									<i class="pe-7s-menu"></i><h3>Stripped &amp; Media Table</h3>
								</div>
								<div class="widget__config">
									<a href="#"><i class="pe-7f-refresh"></i></a>
									<a href="#"><i class="pe-7s-close"></i></a>
								</div>
							</header>
							
							<div class="widget__content table-responsive">
								
								<table id="example" class="display" cellspacing="0" width="100%">
							  	<thead>
							  		    <tr>
                      <th width="150">ID</th>
                      <th width="250">Name</th>
                      <th width="250">Email ID</th>
                      <th width="250">Username</th>
                      <th>Action</th>

                    </tr>
							  	</thead>
							  	<tbody>

							  	
							  		<tr class="spacer"></tr>

                      
                        
							  		
							  		 <?php
                 
$connect= new mysqli("localhost","root","","multi-admin") or die("ERROR:could not connect to the database!!!");
 
//select users data
$query = $connect->query("SELECT * FROM `system_users` ORDER BY u_userid DESC");
 foreach ($query as $row) {
 	echo '<tr>';
                            
                            echo '<td>'. $row['u_userid'] . '</td>';
                            echo '<td>'. $row['name'] . '</td>';
                            echo '<td>'. $row['email'] . '</td>';
                            echo '<td>'. $row['u_username'] . '</td>';
                            echo '<td width="auto">';
                            echo '<a class="btn btn-success" href="update.php?id='.$row['u_userid'].'">Update</a>';
                             echo ' ';
                             echo '<a class="btn btn-danger" href="delete.php?id='.$row['u_userid'].'">Delete</a>';

                              
                               
                               
                                echo '</td>';
                           
                               
                            
                   }
                  
                  ?>
							  	
							  			
							  	

							  		
							  	
							</tbody>
							</table>  	
							</div>
							</article>	
							  		
							  		
							 </tr>

							  	

							  	</tbody>
								</table>
								

								
							</div> <!-- /widget__content -->

						</article><!-- /widget -->
				
 <!-- /row -->
			
<!-- /row -->


			<footer class="footer-brand">
				<img src="img/logo_trim.png">
				<p>© 2014 Glazzed. All rights reserved</p>
			</footer>


		</section> <!-- /content -->

	</div>


	
	<script type="text/javascript" src="js/main.js"></script>
	<script type="text/javascript" src="jquery.dataTables.min.js"></script>
	
</body>
</html>

<script type="text/javascript">
	
	$(document).ready(function() {
    $('#example').DataTable( {
        columnDefs: [ {
            targets: [ 0 ],
            orderData: [ 0, 1 ]
        }, {
            targets: [ 1 ],
            orderData: [ 1, 0 ]
        }, {
            targets: [ 4 ],
            orderData: [ 4, 0 ]
        } ]
    } );
} );
</script>