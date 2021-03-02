
<link rel="stylesheet" type="text/css" href="jquery.dataTables.min.css">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
 <script src="jquery-1.12.4.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


</head>
<table id="example" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email ID</th>
                <th>Username</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        
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
                             echo '<td width=auto>';
                               
                               echo '<a class="btn btn-success" href="update.php?id='.$row['u_userid'].'">Update</a>';
                               echo ' ';
                              echo '<a class="btn btn-danger" href="delete.php?id='.$row['u_userid'].'">Delete</a>';
                               echo '</td>';
                           
                               
                            echo '</tr>';
                  
                          
                           
                       
                           }
                           ?>
                          
           
            
        </tbody>
    </table>
    </html>
    
      <script type="text/javascript" src="jquery.dataTables.min.js"></script>

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