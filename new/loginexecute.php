<?php
session_start();
include 'connection.php';
if(isset($_POST['submit'])) {
echo $username = $_POST['username'];
echo $user_password = $_POST['user_password']   ;

$sql = ("SELECT * FROM system_users WHERE u_username = '$username' AND active");
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);


if($row['active'] > 1)
 {

    echo "Account Disabled.";
 }
// if password is valid start session and redirect to profile.php
else if (password_verify($user_password, $row['u_password']))
{
    $_SESSION['id'] = $row['id'];
    header('Location: dashboard.php');
    echo "success";
}
else
{
    
   echo 'login failed';
}
}
?>
