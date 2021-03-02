<?php
$servername = "localhost";
$username = "root";
$password = "";

$switchcode = $_POST['switchcode'];
$portid = $_POST['portid'];


try {
    $conn = new PDO("mysql:host=$servername;dbname=module", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }


$stmt = $conn->Query("SELECT * FROM `emp_info` WHERE `switchcode` = '$switchcode' AND `portid` = '$portid'");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

//echo $row['name'];
//echo $row['vlanid'];
   $someArray = [];

 array_push($someArray, ['name'   => $row['name'],'vlanid' => $row['vlanid'],'id' =>$row['Id']]);










}
$someJSON = json_encode($someArray);
  echo $someJSON;   
?>