<?php
	//include connection file 
	include_once("connection.php");
	$sql = "SELECT * FROM `persons`";
	$queryRecords = mysqli_query($conn, $sql) 
		or die("error to fetch employees data");
?>
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/4.2.0/normalize.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
        <!--<link rel="stylesheet" href="css/main.css"> -->
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
		<div id="msg" class="alert"></div>        
		<!-- Add your site or application content here -->
        <table id="employee_grid" class="table table-condensed table-hover table-striped bootgrid-table" width="60%" cellspacing="0">
		   <thead>
		      <tr>
		         <th>Name</th>
		         <th>Email</th>
		         <th>Contact</th>
		      </tr>
		   </thead>
		   <tbody id="_editable_table">
		      <?php foreach($queryRecords as $res) :?>
		      <tr data-row-id="<?php echo $res['id'];?>">
		         <td class="editable-col" contenteditable="true" col-index='0' oldVal ="<?php echo $res['name'];?>"><?php echo $res['name'];?></td>
		         <td class="editable-col" contenteditable="true" col-index='1' oldVal ="<?php echo $res['email'];?>"><?php echo $res['email'];?></td>
		         <td class="editable-col" contenteditable="true" col-index='2' oldVal ="<?php echo $res['contacts'];?>"><?php echo $res['contacts'];?></td>
		      </tr>
		    <?php endforeach;?>
		   </tbody>
		</table>

        <script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.12.4.min.js"><\/script>')</script>
		<script type="text/javascript">
			$(document).ready(function(){
			  $('td.editable-col').on('focusout', function() {
			    data = {};
			    data['val'] = $(this).text();
			    data['id'] = $(this).parent('tr').attr('data-row-id');
			    data['index'] = $(this).attr('col-index');
			      if($(this).attr('oldVal') === data['val'])
			    return false;
			    
			    $.ajax({   
			          
						type: "POST",  
						url: "server.php",  
						cache:false,  
						data: data,
						dataType: "json",       
						success: function(response)  
						{   
							//$("#loading").hide();
							if(response.status) {
						  		$("#msg").removeClass('alert-danger');
						  		$("#msg").addClass('alert-success').html(response.msg);
							} else 
							{
							  $("#msg").removeClass('alert-success');
							  $("#msg").addClass('alert-danger').html(response.msg);
							}
						}   
			        });
			 	 });
			});
		</script>
        <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
        <script>
            window.ga=function(){ga.q.push(arguments)};ga.q=[];ga.l=+new Date;
            ga('create','UA-XXXXX-Y','auto');ga('send','pageview')
        </script>
        <script src="https://www.google-analytics.com/analytics.js" async defer></script>
    </body>
</html>