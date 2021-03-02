<?php

require_once("config.php");
if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
    // not logged in send to login page
    redirect("index.php");
}

// set page title
$title = "Dashboard";

// if the rights are not set then add them in the current session
if (!isset($_SESSION["access"])) {

    try {

        $sql = "SELECT mod_modulegroupcode, mod_modulegroupname FROM module "
                . " WHERE 1 GROUP BY `mod_modulegroupcode` "
                . " ORDER BY `mod_modulegrouporder` ASC, `mod_moduleorder` ASC  ";


        $stmt = $DB->prepare($sql);
        $stmt->execute();
        $commonModules = $stmt->fetchAll();

        $sql = "SELECT mod_modulegroupcode, mod_modulegroupname, mod_modulepagename,  mod_modulecode, mod_modulename FROM module "
                . " WHERE 1 "
                . " ORDER BY `mod_modulegrouporder` ASC, `mod_moduleorder` ASC  ";

        $stmt = $DB->prepare($sql);
        $stmt->execute();
        $allModules = $stmt->fetchAll();

        $sql = "SELECT rr_modulecode, rr_create,  rr_edit, rr_delete, rr_view FROM role_rights "
                . " WHERE  rr_rolecode = :rc "
                . " ORDER BY `rr_modulecode` ASC  ";

        $stmt = $DB->prepare($sql);
        $stmt->bindValue(":rc", $_SESSION["rolecode"]);
        
        
        $stmt->execute();
        $userRights = $stmt->fetchAll();

        $_SESSION["access"] = set_rights($allModules, $userRights, $commonModules);

    } catch (Exception $ex) {

        echo $ex->getMessage();
    }
}

$stmt = $DB->prepare("SELECT * FROM system_users WHERE u_userid=:uid");
$stmt->execute(array(":uid"=>$_SESSION['user_id']));
$row=$stmt->fetch(PDO::FETCH_ASSOC);



?>


<?php
    require 'database.php';
 
    $u_userid = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: edit_user.php");
    }
     
    if ( !empty($_POST)) {
        // keep track validation errors
        $nameError = null;
        $emailError = null;
        $u_usernameError = null;
        $u_passwordError = null;
         
        // keep track post values
        $name = $_POST['name'];
        $email = $_POST['email'];
        $u_username = $_POST['u_username'];
         $u_password = $_POST['u_password'];
         
        // validate input
        $valid = true;
        if (empty($name)) {
            $nameError = 'Please enter Name';
            $valid = false;
        }
         
        if (empty($email)) {
            $emailError = 'Please enter Email Address';
            $valid = false;
        } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
            $emailError = 'Please enter a valid Email Address';
            $valid = false;
        }
         
        if (empty($u_username)) {
            $u_usernameError = 'Please enter username';
            $valid = false;
        }
        if (empty($u_password)) {
            $u_passwordError = 'Please enter password';
            $valid = false;
        }
         
        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE system_users  set name = ?, email = ?, u_username =?, u_password = ? WHERE u_userid = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($name,$email,$username,$password,$id));
            Database::disconnect();
            header("Location: html.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM system_users where u_userid = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $name = $data['name'];
        $email = $data['email'];
        $u_username = $data['u_username'];
        $u_password = $data['u_password'];
        Database::disconnect();
    }
?>



<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Edit Information</h4>
      </div>
      <div class="modal-body">
        <form action="update.php ?id=<?php echo $id; ?>" method="post">
          <div class="form-group">
            <label for="name" class="control-label">Name:</label>
            <input type="text" class="form-control" id="name" value="<?php echo !empty($name)?$name:'';?>">
          </div>
           <div class="form-group">
            <label for="name" class="control-label">Username:</label>
            <input type="text" class="form-control" id="u_username" value="<?php echo !empty($name)?$name:'';?>">
          </div>
            <div class="form-group">
            <label for="name" class="control-label">Password:</label>
            <input type="text" class="form-control" id="u_password" value="<?php echo !empty($name)?$name:'';?>">
          </div>
            <div class="form-group">
            <label for="name" class="control-label">E-mail:</label>
            <input type="text" class="form-control" id="email" value="<?php echo !empty($name)?$name:'';?>">
          </div>
           
          
          
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary">Update Information</button>
      </div>
    </div>
  </div>
</div>