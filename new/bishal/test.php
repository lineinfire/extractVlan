<?php
include 'connection.php';
session_start();
$duration = 10;



if($_POST) {
$username = $_POST['username'];
$password = $_POST['password'];

$sql = ("SELECT * FROM system_users WHERE u_username = '$username' AND active");
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

if($row['active'] > 1)
 {

    echo "Account Disabled.";
 }


else if (password_verify($password, $row['u_password']))
{
    $_SESSION['id'] = array("start"=>time(),"duration"=>$duration,$row['id']);
    
    echo "success";

}
else
{
    
   echo 'false';
}
}
?>