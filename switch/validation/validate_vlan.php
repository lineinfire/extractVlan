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
    $newvlanid = trim($_GET['newvlanid']);
    //$umail = trim($_POST['email']);

    //connect to database   
    //require_once '/php-includes/dbconfig.inc.php';

    $stmt = $conn->prepare("SELECT * FROM vlans WHERE switch_ip=:switchcode AND vlanid=:newvlanid");
    $stmt->execute(array(':switchcode'=>$switchcode,':newvlanid'=>$newvlanid));
    $row=$stmt->fetch(PDO::FETCH_ASSOC);


    if($row['vlanid']==$newvlanid) {
        $isAvailable = false; 
    }

    // Finally, return a JSON
    echo json_encode(array('valid' => $isAvailable));
?>
 