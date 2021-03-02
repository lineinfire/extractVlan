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
    $email = trim($_GET['email']);
    //$umail = trim($_POST['email']);

    //connect to database   
    //require_once '/php-includes/dbconfig.inc.php';

    $stmt = $conn->prepare("SELECT email FROM emp_info WHERE email=:email");
    $stmt->execute(array(':email'=>$email));
    $row=$stmt->fetch(PDO::FETCH_ASSOC);


    if($row['email']==$email) {
        $isAvailable = false; 
    }

    // Finally, return a JSON
    echo json_encode(array('valid' => $isAvailable));
?>
 