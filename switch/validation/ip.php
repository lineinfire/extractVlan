<?php

    $isAvailable = true;

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







    //get the username  and password
    $ip = trim($_GET['emp_ip']);
    //$umail = trim($_POST['email']);

    //connect to database   
    //require_once '/php-includes/dbconfig.inc.php';

    $stmt = $conn->prepare("SELECT ipaddress FROM emp_info WHERE ipaddress=:ip");
    $stmt->execute(array(':ip'=>$ip));
    $row=$stmt->fetch(PDO::FETCH_ASSOC);


    if($row['ipaddress']==$ip) {
        $isAvailable = false; 
    }

    // Finally, return a JSON
    echo json_encode(array('valid' => $isAvailable));
?>
 