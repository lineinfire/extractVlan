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
    $phoneip = trim($_GET['phoneip']);
    //$umail = trim($_POST['email']);

    //connect to database   
    //require_once '/php-includes/dbconfig.inc.php';

    $stmt = $conn->prepare("SELECT phoneip FROM emp_info WHERE phoneip=:phoneip");
    $stmt->execute(array(':phoneip'=>$phoneip));
    $row=$stmt->fetch(PDO::FETCH_ASSOC);


    if($row['phoneip']==$phoneip) {
        $isAvailable = false; 
    }

    // Finally, return a JSON
    echo json_encode(array('valid' => $isAvailable));
?>
 