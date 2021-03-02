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
     $switchcode = trim($_GET['switchcode']);
    $emp_port = trim($_GET['emp_port']);
    //$umail = trim($_POST['email']);

    //connect to database   
    //require_once '/php-includes/dbconfig.inc.php';

    $stmt = $conn->prepare("SELECT * FROM emp_info WHERE switchcode=:switchcode AND portid=:emp_port");
    $stmt->execute(array(':switchcode'=>$switchcode,':emp_port'=>$emp_port));
    $row=$stmt->fetch(PDO::FETCH_ASSOC);


    if($row['portid']==$emp_port) {
        $isAvailable = false; 
    }

    // Finally, return a JSON
    echo json_encode(array('valid' => $isAvailable));
?>
 