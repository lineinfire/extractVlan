<?php
echo "<body>";

	echo '<div id="loading">
		<div class="loader loader-light loader-large"></div>
	</div>

</body>
	';


	session_start();
	require_once 'dbconfig.php';

	if(isset($_POST['btn-login']))
	{
		//$user_name = $_POST['user_name'];
		$user_email = trim($_POST['user_email']);
		$user_password = trim($_POST['user_password']);
		
		$password = md5($user_password);
		
		try
		{	
		
			$stmt = $db_con->prepare("SELECT * FROM tbl_users WHERE user_email=:email");
			$stmt->execute(array(":email"=>$user_email));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$count = $stmt->rowCount();
			
			if($row['user_password']==$password){
				
				echo "ok"; // log in
				$_SESSION['user_session'] = $row['id'];
			}
			else{
				
				echo "email or password does not exist."; // wrong details 
			}
				
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}

?>