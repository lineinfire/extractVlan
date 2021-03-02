<?php
session_start();
require_once("config.php");
require_once("connection.php");
$title = "Login";
$mode = $_REQUEST["mode"];
if($_POST) {
    $username = trim($_POST['username']);
    $pass = trim($_POST['password']);

    if ($username == "" || $pass == "") {

        $_SESSION["errorType"] = "danger";
        $_SESSION["errorMsg"] = "Enter manadatory fields";
    } else {
      
        $sql = "SELECT * FROM system_users WHERE u_username = :uname AND active ";

        try {
            $stmt = $DB->prepare($sql);

            // bind the values
            $stmt->bindValue(":uname", $username);
        

            // execute Query
            $stmt->execute();
            $results = $stmt->fetchAll();
            if($results[0]['active'] > 1)
            {
                echo "Account Disabled.";
            }

            else if ((count($results) > 0) && password_verify($pass, $results[0]['u_password'])) 
            {
                $_SESSION["user_id"] = $results[0]["u_userid"];
                $_SESSION["rolecode"] = $results[0]["u_rolecode"];
                $_SESSION["username"] = $results[0]["u_username"];
                echo "success";
            } else {
                $_SESSION["errorType"] = "info";
                $_SESSION["errorMsg"] = "username or password does not exist.";
                echo "failed";
            }
        } catch (Exception $ex) {

            $_SESSION["errorType"] = "danger";
            $_SESSION["errorMsg"] = $ex->getMessage();
        }
    }
    
}

?>